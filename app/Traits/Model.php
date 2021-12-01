<?php

namespace App\Traits;

trait Model
{
    public static function bootModel() {
        static::saving(function($model) {

            $data = $model->toArray();
            $validate = $model->validate($data);

            if ($validate->fails()) {
                throw new \Exception(json_encode($validate->errors()));
            }

            // Gerando slug caso coluna exista
            if (in_array('slug', $model->getFillable()) AND !$model->slug) {
                $model->slug = \Str::slug($model->name);
            }

            return $model;
        });
    }
    
    public function validate($data=[]) {
        return \Validator::make($data, []);
    }

    public function store($data=[]) {
        $data = array_merge($this->toArray(), $data);
        foreach($data as $key=>$value) {
            if (is_array($value)) {
                $data[$key] = json_encode($value);
            }
        }

        $table_name = $this->getTable();
        $table_pk = $this->getKeyName();
        $id = isset($data[$table_pk])? $data[$table_pk]: false;

        if ($validator = $this->validate($data) AND $validator->fails()) {
            throw new \Exception(json_encode($validator->errors()));
        }

        if ($id AND $save=self::find($id)) {
            $save->fill($data)->save();
        }
        else {
            $save = self::create($data);
        }

        return $save;
    }


    public function clone() {
        // 
    }

    public function import($format, $content) {
        // 
    }

    public function scopeExport($query) {
        $format = request('format', 'json');
        $class = app('App\Formats\\'. \Str::of($format)->studly());
        $filename = $class->filename();
        $content = $class->export($query);

        return \Response::make($content, 200, [
            'Content-type' => $class->mime(),
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    // TODO: Remover apenas se existir condições where
    public function scopeRemove($query) {
        if (\Schema::hasColumn($this->getTable(), 'deleted_at')) {
            return $query->get()->transform(function($item) {
                $item->deleted_at = date('Y-m-d H:i:s');
                $item->save();
                return $item;
            });
        }

        return $query->delete();
    }


    public function scopeSelectExcept($query, $fields=[]) {
        $select = [];
        foreach($this->fillable as $col) {
            if (in_array($col, $fields)) continue;
            $select[] = $col;
        }
        return $query->select($select);
    }
    

    public function searchParams() {
        return [];
    }


    public function scopeSearch($query, $params=null) {
        $params = $params? $params: request()->all();
        $params = array_merge([
            'q' => '',
            'page' => 1,
            'perpage' => 20,
            'orderby' => 'updated_at',
            'order' => 'desc',
            'deleted' => '',
        ], $this->searchParams(), $params);

        foreach($params as $field=>$value) {
            if (! $value) continue;
            if (! in_array($field, $this->fillable)) continue;

            $operator = isset($params["{$field}_op"])? $params["{$field}_op"]: false;

            if (is_array($value)) {
                $query->whereIn($field, $value);
            }
            else if ($operator=='lt') {
                $query->where($field, '<', $value);
            }
            else if ($operator=='lte') {
                $query->where($field, '<=', $value);
            }
            else if ($operator=='gt') {
                $query->where($field, '>', $value);
            }
            else if ($operator=='gte') {
                $query->where($field, '>=', $value);
            }
            else if ($operator=='neq') {
                $query->where($field, '!=', $value);
            }
            else if ($operator=='like') {
                $query->where($field, 'like', "%{$value}%");
            }
            else if ($operator=='not_like') {
                $query->where($field, 'not like', "%{$value}%");
            }
            else if ($operator=='between') {
                $query->whereBetween($field, $value);
            }
            else if ($operator=='not_between') {
                $query->whereNotBetween($field, $value);
            }
            else {
                $query->where($field, $value);
            }
        }


        // ?orderby=id&order=desc
        $query->orderBy($params['orderby'], $params['order']);

        // ?q=term+search
        if ($params['q']) {
            $terms = preg_split('/[^a-zA-Z0-9]/', $params['q']);
            $whereLikes = [];
            foreach($terms as $q) {
                foreach($this->fillable as $field) {
                    $whereLikes[] = [$field, 'like', "%{$q}%"];
                }
            }
            $query = $query->where(function($q) use($whereLikes) {
                foreach($whereLikes as $w) {
                    $q->orWhere($w[0], $w[1], $w[2]);
                }
            });
        }

        // ?deleted=1
        if (!$params['deleted'] AND in_array('deleted_at', $this->fillable)) {
            $query->where(function($q) {
                $q->whereNull('deleted_at');
                $q->orWhere('deleted_at', '');
            });
        }

        return $query;
    }
}
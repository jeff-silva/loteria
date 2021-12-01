<?php

namespace App\Traits;

trait Mail {

    static function getSubject() {
        return 'no subject';
    }

    static function getTemplate() {
        return 'no template';
    }

    static function getParamsMerge() {
        return [];
    }

    static function getParams() {
        $parent = array_keys(get_class_vars(get_parent_class(get_class())));
        $self = array_keys(get_class_vars(get_class()));
        $params = array_diff($self, $parent);
        
        $return = [];
        foreach((new \ReflectionClass(__class__))->getConstructor()->getParameters() as $param) {
            if ($type = $param->getType()) {
                $model = app($type->getName());
                foreach($model->getFillable() as $field) {
                    $return["\${$param->name}->{$field}"] = "Campo {$field}";
                }
            }
        }

        $return = array_merge($return, self::getParamsMerge());

        // ksort($return);
        return array_map(function($label, $name) {
            return [
                'id' => $name,
                'label' => $label,
                'source' => "{{ $name }}",
            ];
        }, $return, array_keys($return));
    }

    public function getParamsValues() {
        $parent = array_keys(get_class_vars(get_parent_class(get_class())));
        $self = array_keys(get_class_vars(get_class()));
        $params = array_diff($self, $parent);

        foreach($params as $i=>$param) {
            $params[$param] = $this->$param;
            unset($params[$i]);
        }
        
        return $params;
    }

    public function bladeCompile($html, $data=[]) {
        $html = \Blade::compileString($html);
        ob_start() and extract($data, EXTR_SKIP);
        try { eval('?>'.$html); }
        catch (\Exception $e) { ob_get_clean(); throw $e; }
        return ob_get_clean();
    }

    public function sendTo($emails) {
        $emails = is_array($emails)? $emails: [$emails];
        $name = (new \ReflectionClass($this))->getShortName();
        
        $data = $this->getParamsValues();
        $subject = $this->bladeCompile(self::getSubject(), $data);
        $template = $this->bladeCompile(self::getTemplate(), $data);

        \Mail::send([], [], function ($message) use ($emails, $subject, $template) {
            $message->to($emails)->subject($subject)->setBody($template, 'text/html');
        });
    }
}
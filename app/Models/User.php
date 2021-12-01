<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use \App\Traits\Model;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
		'id',
		'name',
		'email',
		'email_verified_at',
		'password',
		'address_id',
		'remember_token',
		'created_at',
		'updated_at'
	];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function booted() {
        self::created(function($model) {
            (new \App\Mail\UserWelcome($model))->sendTo($model->email);
        });
    }

    public function passwordResetStart() {
        if (! $this->id) return;
        $this->remember_token = uniqid();
        $this->save();

        (new \App\Mail\UserPasswordReset($this))->sendTo($this->email);

        return $this;
    }

    public function validate($data=[]) {
        $rules = [
            'name' => ['required'],
            'email' => ['required'],
        ];

        // update
        if (isset($data['id']) AND !empty($data['id'])) {
            // 
        }

        // insert
        else {
            $rules['email'][] = 'unique:users,email';
            $rules['password'] = ['required'];
        }

        return \Validator::make($data, $rules);
    }

    public function getVerifyLink() {
        return \URL::to("/verification/xxx/");
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function setPasswordAttribute($value) {
		if (! $value) return;
		if (! \Hash::needsRehash($value)) return;
		return $this->attributes['password'] = \Hash::make($value);
	}

    public function getPhotoAttribute($value) {
        return $value? $value: config('user.photo_default');
    }

	public function oauthProviders() {
		return $this->hasMany(\App\Models\User::class, 'user_id', 'id');
	}

	public function address() {
		return $this->belongsTo(\App\Models\User::class, 'address_id', 'id');
	}

	public function usersNotifications() {
		return $this->hasMany(\App\Models\User::class, 'user_id', 'id');
	}
}
<?php

namespace App\Mail;

class UserPasswordReset extends \Illuminate\Mail\Mailable
{
    use \App\Traits\Mail;

    public $user = false;

    public function __construct(\App\Models\User $user) {
        $this->user = $user;
    }

    static function getSubject() {
        return 'Alteração de senha';
    }

    static function getTemplate() {
        return 'Uma requisição para alterar senha foi gerada. <br>
        Caso não tenha sido você, ignore este e-mail. <br><br>
        Seu código para alteração de senha é: <br>
        <div style="white-space: pre; letter-spacing: 3px; background: #eee; padding: 10px; display: block;">{{ $user->remember_token }}</div>';
    }
}
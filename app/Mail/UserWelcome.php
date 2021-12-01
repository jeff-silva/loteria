<?php

namespace App\Mail;

class UserWelcome extends \Illuminate\Mail\Mailable
{
    use \App\Traits\Mail;

    public $user = false;

    public function __construct(\App\Models\User $user) {
        $this->user = $user;
    }

    static function getSubject() {
        return 'Olá {{ $user->name }}';
    }

    static function getTemplate() {
        return 'Seja bem vindo(a). <br>
        Por favor, verifique seu e-mail
        <a href="{{ $user->getVerifyLink() }}">clicando aqui</a>.';
    }

    static function getParamsMerge() {
        return [
            '$user->getVerifyLink()' => 'Link de verificação',
        ];
    }
}
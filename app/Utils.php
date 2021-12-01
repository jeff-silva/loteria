<?php

namespace App;

class Utils {
    
    static function email($to, $subject, $body) {
        return \Mail::send([], [], function ($message) use ($to, $subject, $body) {
            $body = config('mail.header', '') . $body . config('mail.footer', '');
            return $message->to($to)->subject($subject)->setBody($body, 'text/html');
        });
    }

}
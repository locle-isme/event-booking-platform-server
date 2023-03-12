<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;

class SMTPMailHelper extends MailHelper
{
    const SMTP = 'smtp';

    public function __construct($options)
    {
        $settings = [
            'driver' => static::SMTP,
            'host' => $options['host'],
            'port' => $options['post'] ?: 587,
            'from' => [
                'address' => $options['from']['address'],
                'name' => $options['from']['name'],
            ],
            'encryption' => $options['encryption'] ?: 'tls',
            'username' => $options['username'],
            'password' => $options['password'],
        ];
        Config::set('mail', $settings);
    }
}

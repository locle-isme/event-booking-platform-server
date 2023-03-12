<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class MailHelper
{
    const DEFAULT_TEMPLATE_MAIL_VIEW = 'mail_template.default';

    public function send($user, $view = '', $data = [], $options = [])
    {
        try {
            $toEmail = $user['email'];
            $fullName = @$user['first_name'] . " " . @$user['last_name'];
            $fullName = trim($fullName);
            $toName = $fullName ?: @$user['name'];
            if (empty($nameUser) || empty($toEmail)) {
                return 0;
            }
            if (empty($view)) {
                $view = static::DEFAULT_TEMPLATE_MAIL_VIEW;
            }
            Mail::send($view, [
                'user' => $user,
                'data' => $data,
            ], function ($m) use ($options, $toName, $toEmail) {
                $fromEmail = @$options['from_email'] ?: '';
                $fromName = @$options['from_name'] ?: '';
                $m->from($fromEmail, $fromName);
                $m->to($toEmail, $toName);
                if (!empty($options['attach']['name']) && !empty($options['attach']['path'])) {
                    $fileName = $options['attach']['name'];
                    $filePath = $options['attach']['name'];
                    $m->attachData($filePath, $fileName);
                }
                return $m;
            });
            return 1;
        } catch (\Throwable $e) {
            LogHelper::write($e, 'SEND MAIL FAILED');
            return 0;
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: evan
 * Date: 04.01.19
 * Time: 14:47
 */

namespace App\Services\Logs;


class LogProcessor
{
    public function __invoke(array $record)
    {
        $record['extra'] = [
            'user_id' => auth()->user() ? auth()->user()->id : NULL,
            'origin' => request()->headers->get('origin'),
            'ip' => request()->server('REMOTE_ADDR'),
            'user_agent' => request()->server('HTTP_USER_AGENT')
        ];
        return $record;
    }
}
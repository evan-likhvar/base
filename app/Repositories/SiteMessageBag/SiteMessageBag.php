<?php
/**
 * Created by PhpStorm.
 * User: evan
 * Date: 28.08.18
 * Time: 10:14
 */

namespace App\Repositories\SiteMessageBag;


use Illuminate\Support\MessageBag;

class SiteMessageBag extends MessageBag
{
    public function addArray(string $key, array $messages): SiteMessageBag
    {
        foreach ($messages as $k => $message) {
            if (isset($this->messages[$key][$k]))
                $k = $k . count($this->messages[$key]);
            $this->messages[$key][$k] = $message;
        }
        return $this;
    }
}

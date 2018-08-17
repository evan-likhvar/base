<?php

namespace App\Repositories\Registry;


class SessionRegistry
{
    public function get(string $key = null)
    {
        if (!$key)
            dd(session()->all());

        if (!empty (session()->get($key))) {
            return session()->get($key);
        }

        return null;
    }

    public function set(string $key, $value)
    {
        session()->put($key , $value);
    }
}
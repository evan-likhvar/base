<?php

namespace App\Events\Logs;

use Illuminate\Queue\SerializesModels;

class LogMonologEvent
{
    use SerializesModels;
    /**
     * @var
     */
    public $records;

    /**
     * @param $model
     */
    public function __construct(array $records)
    {
        $this->records = $records;
    }
}
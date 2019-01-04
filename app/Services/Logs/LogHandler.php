<?php

namespace App\Services\Logs;

use App\Events\Logs\LogMonologEvent;
use App\Models\Log;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class LogHandler extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG)
    {
        parent::__construct($level);
    }

    protected function write(array $record)
    {

        //dd($record);


        // Simple store implementation
        $log = new Log();
        $log->fill($record['formatted']);
        $log->save();

// Queue implementation
        //event(new LogMonologEvent($record));
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter()
    {
        return new LogFormatter();
    }
}
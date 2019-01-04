<?php
/**
 * Created by PhpStorm.
 * User: evan
 * Date: 04.01.19
 * Time: 14:40
 */

namespace App\Services\Logs;

use Monolog\Logger;


class LogMonolog
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {

        //dd($config);

        $logger = new Logger('custom');
        $logger->pushHandler(new LogHandler());
        $logger->pushProcessor(new LogProcessor());


        //dd($logger);

        return $logger;
    }
}
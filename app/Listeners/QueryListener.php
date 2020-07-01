<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Queue\InteractsWithQueue;
use Log;
class QueryListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QueryExecuted  $event
     * @return void
     */
    public function handle(QueryExecuted $event)
    {
        // dump($event->sql);
        $sql = str_replace("?", "'%s'", $event->sql);
        // dump($sql);
        // dump($event->bindings);
        $log = vsprintf($sql, $event->bindings);
        // dump($log);
        Log::channel('dblog')->info($log);
    }
}

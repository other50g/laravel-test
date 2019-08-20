<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Events\SampleEvent;

class SampleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int スリープ時間
     */
    protected $sleep;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($time = 5)
    {
        //
        $this->sleep = $time;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        sleep($this->sleep);

        event(new SampleEvent('スリープ処理が完了しました。'));
    }
}

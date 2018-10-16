<?php

namespace App\Console\Commands;

use Amqp;
use App\Events\ExampleEvent;
use Illuminate\Console\Command;

class AmqpConsumeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amqp:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume queues';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    Amqp::consume('test-queue', function ($message, $resolver) {

		    broadcast(new ExampleEvent(json_decode($message->body)));

		    $resolver->acknowledge($message);

	    }, [
		    'persistent' => true
	    ]);
    }
}

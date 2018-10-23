<?php

namespace App\Console\Commands;

use Bschmitt\Amqp\Message;
use Bschmitt\Amqp\Publisher;
use Faker\Factory;
use Illuminate\Console\Command;

class DummyQueueEntries extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'amqp:post-dummy-entries';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Post some dummy entries to the queue';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 * @throws \Bschmitt\Amqp\Exception\Configuration
	 */
	public function handle() {
		/* @var Publisher $publisher */
		$publisher = app()->make('Bschmitt\Amqp\Publisher');
		$publisher
			->mergeProperties(['queue' => 'test-queue'])
			->setup();
		$faker = Factory::create( 'en_gb' );
		for ( $i = 0; $i < 1000; $i ++ ) {
			$payload = [
				'message' => $i
			];
			$message = new Message(json_encode($payload), ['content_type' => 'text/plain', 'delivery_mode' => 2]);
			$publisher->publish( '', $message);
		}
	}
}

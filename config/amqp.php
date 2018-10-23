<?php
return [
	/*
	|--------------------------------------------------------------------------
	| Define which configuration should be used
	|--------------------------------------------------------------------------
	*/
	'use'        => 'production',
	/*
	|--------------------------------------------------------------------------
	| AMQP properties separated by key
	|--------------------------------------------------------------------------
	*/
	'properties' => [
		'production' => [
			'host'                 => 'rabbitmq',
			'port'                 => 5672,
			'username'             => 'guest',
			'password'             => 'guest',
			'vhost'                => '/',

			'exchange'             => 'amq.topic',
			'exchange_type'        => 'topic',
			'consumer_tag'         => 'laravel',
			'exchange_passive'     => false,
			'exchange_durable'     => true,
			'exchange_auto_delete' => false,
			'exchange_internal'    => false,
			'exchange_nowait'      => false,
			'exchange_properties'  => [],

			'queue_force_declare'  => false,
			'queue_passive'        => false,
			'queue_durable'        => true,
			'queue_exclusive'      => false,
			'queue_auto_delete'    => false,
			'queue_nowait'         => false,
			'queue_properties'     => [ 'x-ha-policy' => [ 'S', 'all' ] ],

			'consumer_tag'         => 'laravel',
			'consumer_no_local'    => false,
			'consumer_no_ack'      => false,
			'consumer_exclusive'   => false,
			'consumer_nowait'      => false,
			'timeout'              => 0,
			'persistent'           => false,
		],
	],
];

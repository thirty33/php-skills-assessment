<?php

// config for FmTod/Quotes
return [
    'quotes_api_middlewares' => [
		'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
        'throttle:default',
        'can:user-favorites'
	],
	'quotes_rate_limit' => 30,
	'quotes_api_prefix' => 'v1' 
];

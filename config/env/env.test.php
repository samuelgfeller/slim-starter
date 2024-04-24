<?php

// Enable display_error_details for testing as this will throw an ErrorException for notices and warnings
$settings['error']['display_error_details'] = true;

// Database for integration testing must include the word "test"
$settings['db']['database'] = 'slim_starter_test';

// Add example.com domain to allowed origin to test CORS in API call
$settings['api']['allowed_origin'] = 'https://example.com/';

// Enable test mode for the logger
$settings['logger']['test'] = true;

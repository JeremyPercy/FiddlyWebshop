<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

// Load config
require_once 'config/config.php';

// load helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/cookie_helper.php';
require_once 'helpers/upload_helper.php';


// Vendors
	require '../vendor/autoload.php';


// Autoload Core Libraries
spl_autoload_register(function ($className) {
	$filePath = 'libraries/'. $className . '.php';
	if (file_exists($filePath) && is_readable($filePath)) {
		require_once 'libraries/' . $className . '.php';
	}
});

//
require_once 'helpers/translation_helper.php';
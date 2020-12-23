<?php

	function t_($key) {

		$translate = new Translate;
		$key = $translate->translate($key);

		return $key;
	}
<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

	// simple page redirect
	function redirect($page){
		header('location: ' . URLROOT . '/' . $page);
	}

function redirectWithId($page, $id){
  header('location: ' . URLROOT . '/' . $page . '/' . $id);
}

function getUrlParts() {
	if (isset($_GET['url'])) {
		$url = rtrim($_GET['url'], '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode('/', $url);
		return $url;
	}
}
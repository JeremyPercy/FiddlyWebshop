<?php

// Getting shopping cart data from the cookies
	function cookiesData() {
		if (isset($_COOKIE['shopping_cart'])) {
			$cookie_data = stripslashes($_COOKIE['shopping_cart']);
			$cart_items = json_decode($cookie_data, true);

			return $cart_items;
		} else {
			return false;
		}
	}

	// Count total items for button shopping cart
	function countTotalItems() {
		$total = 0;
		$cart_items = cookiesData();
		if ($cart_items) {
			foreach ($cart_items as $keys => $values) {
				$total = $total + ($values["quantity"]);
			}
		}
		return $total;
	}
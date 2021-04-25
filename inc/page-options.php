<?php

class PageOptions {

	$options = []
	$display_page_title = get_field( "display_page_title" );

	public function addOption($option) {
		array_push($options, $option);
	}

	public function displayOptions() {
		return $options;
	}

}


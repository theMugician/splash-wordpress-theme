<?php
	$nonce = 'splash_pricing_plan_nonce';
	$fields = [
		'splash_pricing_plan_title',
		'splash_pricing_plan_button_text',
		'splash_pricing_plan_button_link',
		'splash_pricing_plan_button_specs'
	];

  $splash_pricing_plan_meta_box = new Splash_MetaBoxTemplate(
  	$nonce,
  	$fields
  );
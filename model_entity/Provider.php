<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Provider extends Entity {
	protected $_accessible = [
		'user_provider_id' => true,
		'country'          => true,
		'state'            => true,
		'city'             => true,
		'nearby'           => true,
		'companyname'      => true,
		'adhar_image'      => true,
		'pan_image'        => true,

	];
	// ...
}

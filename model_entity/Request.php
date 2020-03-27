<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Request extends Entity {
	protected $_accessible = [
		'pickup_date'      => true,
		'user_customer_id' => true,
		'fare_id'          => true,
		'truck_id'         => true,
		'pickup_location'  => true,
		'drop_location'    => true,
		'weight'           => true

	];
	// ...
}

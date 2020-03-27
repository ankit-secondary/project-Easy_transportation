<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Report extends Entity {
	protected $_accessible = [
		'user_id'     => true,
		'email'       => true,
		'report_type' => true,
		'message'     => true,
		'created'     => true

	];
	// ...
}

<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity {
	protected $_accessible = [
		'yourname'      => true,
		'username'      => true,
		'password'      => true,
		'email'         => true,
		'mobileno'      => true,
		'profile_image' => true,
		'role'          => true,

	];
	// ...

	protected function _setPassword(string $password):?string {
		if (strlen($password) > 0) {
			return (new DefaultPasswordHasher)->hash($password);
		}
	}
	/*public function can($action, $resource) {
	return $this->authorization->can($this, $action, $resource);
	}

	/**
	 * Authorization\IdentityInterface method
	 */
	/*public function applyScope($action, $resource) {
	return $this->authorization->applyScope($this, $action, $resource);
	}

	/**
	 * Authorization\IdentityInterface method
	 */
	/*public function getOriginalData() {
	return $this;
	}

	/**
	 * Setter to be used by the middleware.
	 */
	/*public function setAuthorization(AuthorizationServiceInterface $service) {
$this->authorization = $service;

return $this;
}*/

}
<?php
declare(strict_types = 1);

namespace App\Model\Table;

use cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {

	public function initialize(array $config):void {

		parent::initialize($config);
		$this->setTable('users');
		$this->setDisplayField('username');
		$this->setPrimaryKey('id');
		//$this->addBehaviour('Timestamp');
		$this->hasMany('requests', [
				'foreignKey' => 'user_customer_id',
			]);
		$this->hasMany('providers', [
				'foreignKey' => 'user_provider_id',
			]);
	}

	public function validationDefault(Validator $validator):Validator {
		$validator = new validator();

		$validator
			->integer('id')
			->allowEmptyString('id', null, 'create');

		$validator
			->scalar('yourname')
			->maxLength('yourname', 50)
			->requirePresence('yourname', 'create')
			->notEmptyString('yourname', 'name field required')
			->add('yourname', [
				'length'   => [
					'rule'    => ['minLength', 03],
					'message' => 'name should be atleast 3 characters'
				]
			]);

		$validator
			->scalar('username')
			->maxLength('username', 100)
			->requirePresence('username', 'create')
			->notEmptyString('username', 'username field required');
		//$validator->add('username', 'custom', ['rule' => 'customRule',
		//		'provider'                                  => 'custom',
		//		'message'                                   => 'username is not unique'
		//	]);
		//->add($rules->isUnique(['username'],'username has been used'));

		$validator

			->scalar('password')
			->maxLength('password', 100)
			->requirePresence('password', 'create')
			->notEmptyString('password', 'password field required')
			->add('password', [
				'length'   => [
					'rule'    => ['minLength', 6],
					'message' => 'minimum length of password should be 6'
				]
			]);

		$validator

			->scalar('email')
			->maxLength('email', 100)
			->requirePresence('email', 'create')
			->notEmptyString('email', 'email field required')
			->add('email', 'vaidFormat', [
				'rule'    => 'email',
				'message' => ' email must be in valid format']);
		//->add($rules->isUnique(['email'],'email-id taken'));

		$validator

			->scalar('mobileno')
			->maxLength('mobileno', 100)
			->requirepresence('mobileno', 'create')
			->notEmptyString('mobileno')
			->add('mobileno', [
				'length' => [
					'rule'  =>
					['minLength', 10],
					['maxLength', 10],
					'message' => 'mobile no. should of 10 digit'
				]
			]);

		$validator

			->scalar('profile_image')
			->requirepresence('profile_image', 'create')
			->notEmptyFile('profile_image');

		$validator

			->scalar('role')
			->requirePresence('role', 'create')
			->notEmptyString('role', 'select your role');

		return $validator;

	}
	public function buildRules(RulesChecker $rules):RulesChecker {
		$rules->add($rules->isUnique(['email']));
		$rules->add($rules->isUnique(['username']));
		return $rules;
	}

}
?>
<?php
declare(strict_types = 1);

namespace App\Model\Table;

use cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AdminTable extends Table {

	public function initialize(array $config):void {

		parent::initialize($config);
		$this->setTable('admin');
		$this->setDisplayField('name');
		$this->setPrimaryKey('id');
		//$this->addBehaviour('Timestamp');
	}
	public function validationDefault(Validator $validator):Validator {
		$validator = new validator();

		$validator
			->integer('id')
			->allowEmptyString('id', null, 'create');

		$validator
			->scalar('name')
			->maxLength('name', 50)
			->requirePresence('name', 'create')
			->notEmptyString('name', 'name field required')
			->add('name', [
				'length'   => [
					'rule'    => ['minLength', 03],
					'message' => 'name should be atleast 3 characters'
				]
			]);

		$validator
			->scalar('username')
			->maxLength('username', 100)
			->requirePresence('username', 'create')
			->notEmptyString('username', 'username field required')
			->add('username', [
				'length'   => [
					'rule'    => ['minLength', 8],
					'message' => 'username should be atleast 08 characters'
				]
			]);

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

		return $validator;

	}

	public function buildRules(RulesChecker $rules):RulesChecker {
		$rules->add($rules->isUnique(['username']));
		return $rules;

	}
}

?>
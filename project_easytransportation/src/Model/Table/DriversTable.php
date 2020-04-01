<?php
declare(strict_types = 1);

namespace App\Model\Table;

use cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class DriversTable extends Table {

	public function initialize(array $config):void {

		parent::initialize($config);
		$this->setTable('drivers');
		$this->setDisplayField('id');
		$this->setPrimaryKey('id');
		//$this->addBehaviour('Timestamp');

		$this->belongsTo('Providers', [
				'foreignKey' => 'provider_id',
				'joinType'   => 'INNER']);
	}
	public function validationDefault(Validator $validator):Validator {
		$validator = new validator();

		$validator
			->integer('id')
			->allowEmptyString('id', null, 'create');

		$validator
			->integer('provider_id')
			->maxLength('provider_id', 11)
			->requirePresence('provider_id', 'create')
			->notEmptyString('provider_id', 'field required');

		$validator
			->scalar('name')
			->maxLength('name', 50)
			->requirePresence('name', 'create')
			->notEmptyString('name', 'field required');

		$validator
			->scalar('mobileno')
			->maxLength('mobileno', 50)
			->requirePresence('mobileno', 'create')
			->notEmptyString('mobileno', 'field required')
			->add('mobileno', [
				'length' => [
					'rule'  =>
					['minLength', 10],
					['maxLength', 10],
					'message' => 'mobile no. should of 10 digit'
				]
			]);

		$validator

			->scalar('state')
			->maxLength('state', 50)
			->requirePresence('state', 'create')
			->notEmptyString('state', 'state field required');

		$validator

			->scalar('city')
			->maxLength('city', 50)
			->requirePresence('city', 'create')
			->notEmptyString('city', 'city field required');

		$validator

			->scalar('truck_no')
			->maxLength('truck_no', 100)
			->requirepresence('truck_no', 'create')
			->notEmptyString('truck_no', ' field required');

		$validator

			->scalar('adhar_image')
			->requirePresence('adhar_image', 'create')
			->notEmptyFile('adhar_image', ' field required');

		$validator

			->scalar('dl_image')
			->requirePresence('dl_image', 'create')
			->notEmptyFile('dl_image', ' field required');

		$validator

			->scalar('pan_image')
			->requirePresence('pan_image', 'create')
			->notEmptyFile('pan_image', ' field required');

		$validator

			->scalar('profile_image')
			->requirePresence('profile_image', 'create')
			->notEmptyFile('profile_image', ' field required');

		return $validator;

	}
	public function buildRules(RulesChecker $rules):RulesChecker {
		$rules->add($rules->existsIn(['provider_id'], 'Providers'));

		return $rules;
	}
}
?>
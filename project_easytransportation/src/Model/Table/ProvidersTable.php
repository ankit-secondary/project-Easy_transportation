<?php
declare(strict_types = 1);

namespace App\Model\Table;

use cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProvidersTable extends Table {

	public function initialize(array $config):void {

		parent::initialize($config);
		$this->setTable('providers');
		$this->setDisplayField('companyname');
		$this->setPrimaryKey('id');
		//$this->addBehaviour('Timestamp');
		$this->hasMany('drivers', [
				'foreignKey' => 'provider_id',
			]);

		$this->hasMany('Trucks', [
				'foreignKey' => 'provider_id',
			]);

		$this->belongsTo('Users', [
				'foreignKey' => 'user_provider_id',
				'joinType'   => 'INNER']);
	}
	public function validationDefault(Validator $validator):Validator {
		$validator = new validator();

		$validator
			->integer('id')
			->allowEmptyString('id', null, 'create');

		$validator
			->integer('user_provider_id')
			->maxLength('user_provider_id', 11)
			->requirePresence('user_provider_id', 'create')
			->notEmptyString('user_provider_id', 'field required');

		$validator
			->scalar('country')
			->maxLength('country', 100)
			->requirePresence('country', 'create')
			->notEmptyString('country', 'countary field required');

		$validator

			->scalar('state')
			->maxLength('state', 100)
			->requirePresence('state', 'create')
			->notEmptyString('state', 'state field required');

		$validator

			->scalar('city')
			->maxLength('city', 100)
			->requirePresence('city', 'create')
			->notEmptyString('city', 'city field required');

		$validator

			->scalar('nearby')
			->maxLength('nearby', 100)
			->requirepresence('nearby', 'create')
			->notEmptyString('nearby', 'nearby field required');

		$validator

			->scalar('companyname')
			->requirePresence('companyname', 'create')
			->notEmptyString('companyname', 'company_name field required');

		$validator

			->scalar('adhar_image')
			->requirePresence('adhar_image', 'create')
			->notEmptyFile('adhar_image', ' field required');

		$validator

			->scalar('pan_image')
			->requirePresence('pan_image', 'create')
			->notEmptyFile('pan_image', ' field required');

		return $validator;

	}
	public function buildRules(RulesChecker $rules):RulesChecker {
		$rules->add($rules->existsIn(['user_provider_id'], 'Users'));
		$rules->add($rules->isUnique(['user_provider_id']));

		return $rules;
	}
}
?>
<?php
declare(strict_types = 1);

namespace App\Model\Table;

use cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RequestsTable extends Table {

	public function initialize(array $config):void {

		parent::initialize($config);
		$this->setTable('requests');
		$this->setDisplayField('user_customer_id');
		$this->setPrimaryKey('id');
		//$this->addBehaviour('Timestamp');
		$this->hasMany('service_details', [
				'foreignKey' => 'request_id',
			]);
		$this->hasMany('reports', [
				'foreignKey' => 'request_id',
			]);
		$this->belongsTo('users', [
				'foreignKey' => 'user_customer_id',
				'joinType'   => 'INNER']);
		$this->belongsTo('trucks', [
				'foreignKey' => 'truck_id',
				'joinType'   => 'INNER']);

	}
	public function validationDefault(Validator $validator):Validator {

		$validator
			->integer('id')
			->allowEmptyString('id', null, 'create');

		$validator
			->date('pickup_date')
			->requirePresence('pickup_date', 'create')
			->notEmptyString('pickup_date', 'date field should not empty');
		$validator

			->integer('user_customer_id')
			->maxLength('user_customer_id', 11)
			->requirepresence('user_customer_id', 'create')
			->notEmptyString('user_customer_id');

		$validator

			->integer('truck_id')
			->maxLength('truck_id', 11)
			->requirepresence('truck_id', 'create')
			->notEmptyString('truck_id');

		$validator

			->scalar('pickup_location')
			->maxLength('pickup_location', 100)
			->requirePresence('pickup_location', 'create')
			->notEmptyString('pickup_location');

		$validator

			->scalar('drop_location')
			->maxLength('drop_location', 100)
			->requirePresence('drop_location', 'create')
			->notEmptyString('drop_location');

		$validator

			->integer('weight')
			->maxLength('weight', 11)
			->requirePresence('weight', 'create')
			->notEmptyString('weight');

		return $validator;

	}
	public function buildRules(RulesChecker $rules):RulesChecker {
		$rules->add($rules->existsIn(['user_customer_id'], 'Users'));

		return $rules;
	}
}
?>
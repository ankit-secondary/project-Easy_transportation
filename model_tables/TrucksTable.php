<?php
declare(strict_types = 1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class TrucksTable extends Table {

	public function initialize(array $config):void {

		parent::initialize($config);
		$this->setTable('trucks');
		$this->setDisplayField('trucks');
		$this->setPrimaryKey('id');
		//$this->addBehaviour('Timestamp');
		$this->hasMany('requests', [
				'foreignKey' => 'truck_id',
			]);
		$this->hasMany('fares', [
				'foreignKey' => 'truck_id',
			]);
	}
	public function validationDefault(Validator $validator):Validator {

		$validator
			->integer('id')
			->allowEmptyString('id', null, 'create');

		$validator
			->scalar('trucks')
			->maxLength('trucks', 100)
			->requirePresence('trucks', 'create')
			->notEmptyString('trucks');

		return $validator;

	}

	//public function buildRules(RulesChecker $rules):RulesChecker {
	//	$rules->add($rules->existsIn(['user_customer_id'], 'Users'));

	//	return $rules;
	//}
}
?>
<?php
declare(strict_types = 1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FaresTable extends Table {

	public function initialize(array $config):void {

		parent::initialize($config);
		$this->setTable('fares');
		$this->setDisplayField('fare');
		$this->setPrimaryKey('id');
		//$this->addBehaviour('Timestamp');
		$this->hasMany('requests', [
				'foreignKey' => 'truck_id',
			]);
		$this->belongsTo('trucks', [
				'foreignKey' => 'truck_id',
				'joinTYPE'   => 'INNER',
			]);
	}
	public function validationDefault(Validator $validator):Validator {

		$validator
			->integer('id')
			->allowEmptyString('id', null, 'create');

		//public function buildRules(RulesChecker $rules):RulesChecker {
		//	$rules->add($rules->existsIn(['user_customer_id'], 'Users'));

		//	return $rules;
		//}
	}
}
?>
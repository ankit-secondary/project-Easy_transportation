<?php
declare(strict_types = 1);

namespace App\Model\Table;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TrucksTable extends Table {

	public function initialize(array $config):void {

		parent::initialize($config);
		$this->setTable('trucks');
		$this->setDisplayField('trucks');
		$this->setPrimaryKey('id');
		//$this->addBehaviour('Timestamp');

		$this->belongsTo('providers', ['foreignKey' => 'provider_id',
				'joinType'                                => 'INNER']);
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

		$validator
			->integer('provider_id')
			->maxLength('provider_id', 11)
			->requirePresence('provider_id', 'create')
			->notEmptyString('provider_id');

		$validator
			->scalar('capacity_in_ton')
			->maxLength('capacity_in_ton', 20)
			->requirePresence('capacity_in_ton', 'create')
			->notEmptyString('capacity_in_ton');

		return $validator;

	}

	public function buildRules(RulesChecker $rules):RulesChecker {
		$rules->add($rules->existsIn(['provider_id'], 'Providers'));

		return $rules;
	}
}
?>
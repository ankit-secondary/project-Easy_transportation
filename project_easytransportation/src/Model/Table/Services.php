<?php
declare(strict_types = 1);

namespace App\Model\Table;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ServicesTable extends Table {

	public function initialize(array $config):void {

		parent::initialize($config);
		$this->setTable('services');
		$this->setDisplayField('id');
		$this->setPrimaryKey('id');
		//$this->addBehaviour('Timestamp');

		$this->belongsTo('providers', ['foreignKey' => 'provider_id',
				'joinType'                                => 'INNER']);

		$this->belongsTo('requests', ['foreignKey' => 'request_id',
				'joinType'                               => 'INNER']);

	}
	public function validationDefault(Validator $validator):Validator {

		$validator
			->integer('id')
			->allowEmptyString('id', null, 'create');

		$validator
			->integer('request_id')
			->maxLength('request_id', 100)
			->requirePresence('request_id', 'create')
			->notEmptyString('request_id');

		$validator
			->integer('provider_id')
			->maxLength('provider_id', 11)
			->requirePresence('provider_id', 'create')
			->notEmptyString('provider_id');

		$validator
			->scalar('approx_time')
			->maxLength('approx_time', 20)
			->requirePresence('approx_time', 'create')
			->notEmptyString('approx_time');

		$validator
			->scalar('money_to_pay')
			->maxLength('money_to_pay', 20)
			->requirePresence('money_to_pay', 'create')
			->notEmptyString('money_to_pay');

		$validator
			->scalar('service_status')
			->requirePresence('service_status', 'create')
			->notEmptyString('service_status');

		return $validator;

	}

	public function buildRules(RulesChecker $rules):RulesChecker {
		$rules->add($rules->existsIn(['provider_id'], 'Providers'));
		$rules->add($rules->existsIn(['request_id'], 'Requests'));

		return $rules;
	}
}
?>
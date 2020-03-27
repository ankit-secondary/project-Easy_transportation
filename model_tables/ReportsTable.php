<?php
declare(strict_types = 1);

namespace App\Model\Table;

use cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ReportsTable extends Table {

	public function initialize(array $config):void {

		parent::initialize($config);
		$this->setTable('reports');
		$this->setDisplayField('email');
		$this->setPrimaryKey('id');
		//$this->addBehaviour('Timestamp');
		$this->belongsTo('users', [
				'foreignKey' => 'user_id',
				'joinType'   => 'INNER']);

	}
	public function validationDefault(Validator $validator):Validator {

		$validator
			->integer('id')
			->allowEmptyString('id', null, 'create');

		$validator
			->integer('user_id')
			->maxLength('user_id', 100)
			->requirePresence('user_id', 'create')
			->notEmptyString('user_id');

		$validator
			->scalar('email')
			->maxLength('email', 100)
			->requirePresence('email', 'create')
			->notEmptyString('email');

		$validator
			->scalar('report_type')
			->maxLength('report_type', 100)
			->requirePresence('report_type', 'create')
			->notEmptyString('report_type');

		$validator
			->scalar('message')
			->maxLength('message', 100)
			->requirePresence('message', 'create')
			->notEmptyString('message');

		return $validator;

	}

	public function buildRules(RulesChecker $rules):RulesChecker {
		$rules->add($rules->existsIn(['user_id'], 'Users'));
		return $rules;
	}
}
?>
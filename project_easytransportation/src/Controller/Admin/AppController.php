<?php
declare(strict_types = 1);

namespace App\controller\Admin;

use Cake\Controller\Controller;
use cake\Event\Eventinterface;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */

class AppController extends Controller {
	/**
	 * Initialization hook method.
	 *
	 * Use this method to add common initialization code like loading components.
	 *
	 * e.g. `$this->loadComponent('FormProtection');`
	 *
	 * @return void
	 */
	public function initialize():void {
		parent::initialize();

		$this->loadComponent('RequestHandler');
		$this->loadComponent('Flash');
		$this->loadComponent('Authentication.Authentication');
		$this->loadComponent('Authorization.Authorization', ['skipAuthorization' => [
					'login', 'admindash', 'logout', 'adminprofile', 'users', 'reports', 'requests', 'providers']
			]);
		/*
		 * Enable the following component for recommended CakePHP form protection settings.
		 * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
		 */
		//$this->loadComponent('FormProtection');

	}

	public function beforeFilter(\Cake\Event\EventInterface $event) {
		parent::beforeFilter($event);
		$this->Authentication->addUnauthenticatedActions(['']);
	}

}

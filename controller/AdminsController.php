<?php

declare(strict_types = 1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use cake\Event\EventInterface;

class AdminsController extends AppController {
	public function initialize():void {
		parent::initialize();
		//$this->loadComponent('paginator');
		$this->loadComponent('Flash');

	}
	public function beforeFilter(Eventinterface $event) {
		parent::beforeFilter($event);
		$this->Authentication->addUnauthenticatedActions(['login']);
	}

	public function signup() {
		$this->viewBuilder()->setLayout('adminLayout');

		$this->loadModel('Admin');

		$admin = $this->Admin->newEmptyEntity();

		if ($this->request->is('post')) {

			$admin = $this->Admin->patchEntity($admin, $this->request->getData());
			if ($this->Admin->save($admin)) {

				$this->Flash->success(__('The user has been Registered'));
				$role = $this->request->getdata('role');

				return $this->redirect(['Controller' => 'Admins', 'action' => 'login']);
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}

		}
		$this->set(compact('admin'));

	}
	public function login() {

		$this->viewBuilder()->setlayout('adminLayout');
		$this->request->allowMethod(['get', 'post']);
		$this->loadModel('Admin');
		$result = $this->Authentication->getResult($admin = null);
		// regardless of POST or GET, redirect if user is logged in

		if ($result->isValid($admin)) {
			// redirect to /Userss after login success
		$redirect = $this->request->getQuery('redirect', ['prefix'=>'admin',
				'controller' => 'Admins',
					'action'     => 'admindash'
				]);

			return $this->redirect($redirect);
		}
		// display error if user submitted and authentication failed
		if ($this->request->is('post') && !$result->isValid()) {
			$this->Flash->error(__('Invalid username or password'));
		}

	}
	public function admindash() {
		$this->viewBuilder()->setLayout('adminLayout');
		echo "hi ankit";

	}

}
?>
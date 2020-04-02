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

		$this->viewBuilder()->setlayout('loginadminLayout');
		$this->request->allowMethod(['get', 'post']);
		$this->loadModel('Users');
		$result = $this->Authentication->getResult($user = null);

		$user = $result->getData();

		$key = 'role';

		$role = $user[$key];

		//pr($role);
		//die();

		// regardless of POST or GET, redirect if user is logged in

		if ($result->isValid($user)) {

			if ($role == 2) {

				// redirect to /Userss after login success
				$redirect = $this->request->getQuery('redirect', [
						'controller' => 'Admins',
						'action'     => 'admindash'
					]);

				return $this->redirect($redirect);
			}
		}
		// display error if user submitted and authentication failed
		if ($this->request->is('post') && !$result->isValid()) {
			$this->Flash->error(__('Invalid username or password'));
		}

	}
	public function admindash() {

		$this->viewBuilder()->setLayout('adminLayout');
		$this->loadModel('Users');
		$result = $this->Authentication->getResult($user = null);

		$user = $result->getData();
		$this->set(compact('user'));

	}

	public function users() {
		$this->viewBuilder()->setLayout('adminLayout');
		$this->loadModel('Users');
		$result = $this->Authentication->getResult($user = null);

		$user = $result->getData();
		$this->set(compact('user'));

		$users = $this->paginate($this->Users);
		$this->set(compact('users'));

	}

	public function reports() {
		$this->viewBuilder()->setLayout('adminLayout');
		$this->loadModel('Users');
		$this->loadModel('Reports');
		$result = $this->Authentication->getResult($user = null);

		$user = $result->getData();
		$this->set(compact('user'));

		$reports = $this->paginate($this->Reports);
		$this->set(compact('reports'));

	}

	public function requests() {
		$this->viewBuilder()->setLayout('adminLayout');
		$this->loadModel('Users');
		$this->loadModel('Requests');
		$result = $this->Authentication->getResult($user = null);

		$user = $result->getData();
		$this->set(compact('user'));

		$requests = $this->paginate($this->Requests);
		$this->set(compact('requests'));

	}

	public function providers() {
		$this->viewBuilder()->setLayout('adminLayout');
		$this->loadModel('Users');
		$this->loadModel('Providers');
		$result = $this->Authentication->getResult($user = null);

		$user = $result->getData();
		$this->set(compact('user'));

		$providers = $this->paginate($this->Providers);
		$this->set(compact('providers'));

	}

	public function adminprofile() {

		$this->loadModel('Users');
		$this->viewBuilder()->setLayout('adminLayout');
		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));
	}

	public function logout() {
		$result = $this->Authentication->getResult();
		// regardless of POST or GET, redirect if user is logged in
		if ($result->isValid()) {
			$this->Authentication->logout();
			return $this->redirect(['controller' => 'Admins', 'action' => 'login']);
		}
	}

}
?>
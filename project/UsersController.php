<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Model\Requests;
use cake\Event\EventInterface;

class UsersController extends AppController {
	public function initialize():void {
		parent::initialize();
		//$this->loadComponent('paginator');
		$this->loadComponent('Flash');

	}
	public function beforeFilter(Eventinterface $event) {
		parent::beforeFilter($event);
		$this->Authentication->addUnauthenticatedActions(['login']);

	}
	public function userdash() {
		$this->viewBuilder()->setLayout('userLayout');
		//$user = $this->request('');

	}
	public function providers() {
		$this->viewBuilder()->setLayout('userLayout');

		$this->loadModel('Providers');
		$this->loadModel('Users');

		$users = $this->Providers->Users->find('list', ['limit' => 200]);

		$this->set(compact('users'));

		$provider = $this->Providers->newEmptyEntity();

		if ($this->request->is('post')) {

			if (!empty($this->request->getData('adhar_image')) || !empty($this

						->request->getData('pan_image')) || !empty($this->request->

					getData('profile_image'))) {

				$file1 = $this->request->getData('adhar_image')->
				getClientFilename('adhar_image');

				$file2 = $this->request->getData('pan_image')->
				getClientFilename('pan_image');

				$file3 = $this->request->getData('profile_image')->getClientFilename('profile_image');

				$file_name1 = date("dmYHis").preg_replace('/\s/', '', $file1);
				$file_name2 = date("dmYHis").preg_replace('/\s/', '', $file2);
				$file_name3 = date("dmYHis").preg_replace('/\s/', '', $file3);

				$tmpPath1 = $this->request->getData('adhar_image')->getStream('adhar_image')->getMetadata('uri');

				$tmpPath2 = $this->request->getData('pan_image')->getStream('pan_image')->getMetadata('uri');

				$tmpPath3 = $this->request->getData('profile_image')->getStream('profile_image')->getMetadata('uri');

				move_uploaded_file($tmpPath1, WWW_ROOT."img/".$file_name1);
				move_uploaded_file($tmpPath2, WWW_ROOT."img/".$file_name2);
				move_uploaded_file($tmpPath3, WWW_ROOT."img/".$file_name3);
			}

			$provider = $this->Providers->patchEntity($provider, $this->request->getData());

			$provider['adhar_image']   = $file_name1;
			$provider['pan_image']     = $file_name2;
			$provider['profile_image'] = $file_name3;

			if ($this->providers->save($provider)) {
				$this->Flash->success(__('The information added successfully'));

				return $this->redirect(['action' => 'providerdash']);

			} else {

				$this->Flash->error(__('could not be saved. Please, try again.'));

			}
		}
		$this->set(compact('provider'));
	}
	public function home() {
		$this->viewBuilder()->setLayout('userLayout');

	}
	public function register() {

		$this->viewBuilder()->setLayout("userLayout");

		$user = $this->Users->newEmptyEntity();

		if ($this->request->is('post')) {

			$user = $this->Users->patchEntity($user, $this->request->getData());
			if ($this->Users->save($user)) {

				$this->Flash->success(__('The user has been Registered'));
				$role = $this->request->getdata('role');
				if ($role == 0) {
					return $this->redirect(['action' => 'requests']);
				} else {
					return $this->redirect(['action' => 'providers']);
				}

				//return $this->redirect(['action' => 'request']);
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}

		}
		$this->set(compact('user'));
	}
	public function requests() {
		$this->viewBuilder()->setLayout('userLayout');
		$this->loadModel('Users');
		$this->loadModel('Requests');
		$this->loadModel('Trucks');

		$users  = $this->Requests->Users->find('list', ['limit'  => 200]);
		$trucks = $this->Requests->Trucks->find('list', ['limit' => 200]);

		$this->set(compact('users'));
		$this->set(compact('trucks'));

		$request = $this->Requests->newEmptyEntity();
		if ($this->request->is('post')) {
			$request = $this->Requests->patchEntity($request, $this->request->getData());

			if ($this->Requests->save($request)) {

				$this->Flash->success(__('successfully submited your request'));
				return $this->redirect(['action' => 'userdash']);

			} else {
				$this->Flash->error(__('The request could not completed'));
			}

		}
		$this->set(compact('request'));
	}
	public function providerdash() {
		$this->viewBuilder()->setLayout('userLayout');
	}
	public function login() {
		$this->viewBuilder()->setLayout("userLayout");
		$this->request->allowMethod(['get', 'post']);
		$result = $this->Authentication->getResult($user = null);
		// regardless of POST or GET, redirect if user is logged in

		if ($result->isValid($user)) {
			// redirect to /Userss after login success
			$redirect = $this->request->getQuery('redirect', [
					'controller' => 'Users',
					'action'     => 'userdash'
				]);

			return $this->redirect($redirect);
		}
		// display error if user submitted and authentication failed
		if ($this->request->is('post') && !$result->isValid()) {
			$this->Flash->error(__('Invalid username or password'));
		}
	}

	public function logout() {
		$result = $this->Authentication->getResult();
		// regardless of POST or GET, redirect if user is logged in
		if ($result->isValid()) {
			$this->Authentication->logout();
			return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}
	}
}
?>

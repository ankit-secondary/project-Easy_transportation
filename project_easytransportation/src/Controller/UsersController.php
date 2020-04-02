<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Model\Requests;
use cake\Event\EventInterface;
use cake\ORM\TableRegistry;

class UsersController extends AppController {
	public function initialize():void {
		parent::initialize();
		///	$this->loadComponent('Authorization.Authorization');
		//$this->loadComponent('paginator');
		$this->loadComponent('Flash');
		// Get the identity from the request

	}
	public function beforeFilter(Eventinterface $event) {
		parent::beforeFilter($event);
		$this->Authentication->addUnauthenticatedActions(['login']);

	}

	//user dashboard will open through this method

	public function customerdash() {
		$this->viewBuilder()->setLayout('customerLayout');
		$this->loadModel('Requests');
		$this->loadModel('Trucks');
		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));
		$id = $user['id'];

		//$this->set(compact('request'));
	}
	public function userprofile() {
		$this->loadModel('Requests');
		$this->loadModel('Providers');
		
		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));
		$id    = $user['id'];
		$role=$user['role'];
		if($role==0)
		{
			$this->viewBuilder()->setLayout('customerLayout');
		}
		if($role==1){
			$this->viewBuilder()->setLayout('providerLayout');
		}
		if($role==2)
		{
			$this->viewBuilder()->setLayout('adminLayout');
		}


		$query = $this->Users->findById($id)->contain(['Requests']);
		foreach ($query as $user) {
			$requestdetail = $user->requests;
			$this->set(compact('requestdetail'));
		}
		$query = $this->Users->findById($id)->contain(['Providers']);
		foreach ($query as $user) {
			$providerdetail = $user->providers;
			$this->set(compact('providerdetail'));
		}
	}
	public function edituser() {
		$this->viewBuilder()->setLayout("default");
		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		if ($this->request->is(['patch', 'post', 'put'])) {

			if (!empty($this->request->getData('profile_image'))) {

				$file      = $this->request->getData('profile_image')->getClientFilename('profile_image');
				$file_name = date("dmYHis").preg_replace('/\s/', '', $file);
				// die;
				$tmpPath = $this->request->getData('profile_image')->getStream('profile_image')->getMetadata('uri');

				move_uploaded_file($tmpPath, WWW_ROOT."img/".$file_name);
			}
			$user                  = $this->Users->patchEntity($user, $this->request->getData());
			$user['profile_image'] = $file_name;
			if ($this->Users->save($user)) {
				$this->Flash->success(__('successfully edited profile'));

				return $this->redirect(['action' => 'userprofile']);
			}
			$this->Flash->error(__('profile could not be edited. Please, try again.'));
		}
		$this->set(compact('user'));
		//$parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
		//$this->set(compact('category', 'parentCategories'));
	}

	public function reports() {
		
		$this->loadModel('Reports');
		$this->loadModel('Users');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));
		$role   = $user['role'];
        $id =$user['id'];

		$users = $this->Reports->Users->find('list', ['limit' => 100])->where(['id'=>$id]);
		$this->set(compact('users'));
if($role==0)
{
	$this->viewBuilder()->setLayout('customerLayout');
}
if($role==1){
	$this->viewBuilder()->setLayout('providerLayout');
}

		$id     = $user['id'];
		$email  = $user['email'];

		$report = $this->Reports->newEmptyEntity();

		if ($this->request->is('post')) {

			$user_id  = $this->request->getData('user_id');
			$email_id = $this->request->getData('email');

			if ($user_id == $id && $email == $email_id) {

				$report = $this->Reports->patchEntity($report, $this->request->getData());

				if ($this->Reports->save($report)) {

					$this->Flash->success(__('successfully submited !! wait for response'));
					if ($role == 0) {
						return $this->redirect(['action' => 'customerdash']);
					}if ($role == 1) {

						return $this->redirect(['action' => 'providerdash']);

					}

				} else {
					$this->Flash->error(__('The request could not completed'));
				}
			} else {
				echo "username or email does not match your profile";
			}

		}

		$this->set(compact('report'));
	}

	// method is for providers details page

	public function providers() {
		
		$this->loadModel('Providers');
		$this->loadModel('Users');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$id=$user['id'];
		$this->set(compact('user'));

		$this->viewBuilder()->setLayout('providerLayout');

		$users = $this->Providers->Users->find('list', ['limit' => 1])->where(['id'=>$id]);

		$this->set(compact('users'));

		$provider = $this->Providers->newEmptyEntity();

		if ($this->request->is('post')) {

			if (!empty($this->request->getData('adhar_image')) || !empty($this

						->request->getData('pan_image'))) {

				$file1 = $this->request->getData('adhar_image')->
				getClientFilename('adhar_image');

				$file2 = $this->request->getData('pan_image')->
				getClientFilename('pan_image');

				$file_name1 = date("dmYHis").preg_replace('/\s/', '', $file1);
				$file_name2 = date("dmYHis").preg_replace('/\s/', '', $file2);

				$tmpPath1 = $this->request->getData('adhar_image')->getStream('adhar_image')->getMetadata('uri');

				$tmpPath2 = $this->request->getData('pan_image')->getStream('pan_image')->getMetadata('uri');

				move_uploaded_file($tmpPath1, WWW_ROOT."img/".$file_name1);
				move_uploaded_file($tmpPath2, WWW_ROOT."img/".$file_name2);

			}

			$provider = $this->Providers->patchEntity($provider, $this->request->getData());

			$provider['adhar_image'] = $file_name1;
			$provider['pan_image']   = $file_name2;

			if ($this->Providers->save($provider)) {

				$this->Flash->success(__('The information added successfully'));

				return $this->redirect(['Controller' => 'Users', 'action' => 'providerarea']);

			} else {

				$this->Flash->error(__('could not be saved. Please, try again.'));

			}
		}
		$this->set(compact('provider'));
	}
public function providerarea()
{

	$this->viewBuilder()->setLayout('providerLayout');
	$this->loadModel('Areas');
	$this->loadModel('Users');
	$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$id=$user['id'];
		$this->set(compact('user'));

		$users = $this->Areas->Users->find('list', ['limit' => 200])->where(['id'=>$id]);

		$this->set(compact('users'));
		$area=$this->Areas->newEmptyEntity();
		if($this->request->is('post'))
		{

			$area = $this->Areas->patchEntity($area, $this->request->getData());
		

	if ($this->Areas->save($area)) {

				$this->Flash->success(__('The information added successfully'));

				return $this->redirect(['Controller' => 'Users', 'action' => 'providerdash']);

			} else {

				$this->Flash->error(__('could not be saved. Please, try again.'));

			}
		}
		$this->set(compact('area'));

	}

	public function driver() {
		$this->viewBuilder()->setLayout('providerLayout');

		$this->loadModel('Providers');
		$this->loadModel('Drivers');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));

		$providers = $this->Drivers->Providers->find('list', ['limit' => 200]);

		$this->set(compact('providers'));

		$driver = $this->Drivers->newEmptyEntity();

		if ($this->request->is('post')) {

			if (!empty($this->request->getData('adhar_image')) || !empty($this

						->request->getData('dl_image'))
				 || !empty($this

						->request->getData('pan_image')) || !empty($this

						->request->getData('profile_image'))) {

				$file1 = $this->request->getData('adhar_image')->
				getClientFilename('adhar_image');

				$file2 = $this->request->getData('dl_image')->
				getClientFilename('dl_image');

				$file3 = $this->request->getData('pan_image')->
				getClientFilename('pan_image');

				$file4 = $this->request->getData('profile_image')->
				getClientFilename('profile_image');

				$file_name1 = date("dmYHis").preg_replace('/\s/', '', $file1);
				$file_name2 = date("dmYHis").preg_replace('/\s/', '', $file2);
				$file_name3 = date("dmYHis").preg_replace('/\s/', '', $file3);
				$file_name4 = date("dmYHis").preg_replace('/\s/', '', $file4);

				$tmpPath1 = $this->request->getData('adhar_image')->getStream('adhar_image')->getMetadata('uri');
				$tmpPath2 = $this->request->getData('dl_image')->getStream('dl_image')->getMetadata('uri');

				$tmpPath3 = $this->request->getData('pan_image')->getStream('pan_image')->getMetadata('uri');

				$tmpPath4 = $this->request->getData('profile_image')->getStream('profile_image')->getMetadata('uri');

				move_uploaded_file($tmpPath1, WWW_ROOT."img/".$file_name1);
				move_uploaded_file($tmpPath2, WWW_ROOT."img/".$file_name2);
				move_uploaded_file($tmpPath2, WWW_ROOT."img/".$file_name2);
				move_uploaded_file($tmpPath2, WWW_ROOT."img/".$file_name2);

			}

			$driver = $this->Drivers->patchEntity($driver, $this->request->getData());

			$driver['adhar_image']   = $file_name1;
			$driver['dl_image']      = $file_name2;
			$driver['pan_image']     = $file_name3;
			$driver['profile_image'] = $file_name4;

			if ($this->Drivers->save($driver)) {

				$this->Flash->success(__('The information added successfully'));

				return $this->redirect(['Controller' => 'Users', 'action' => 'providerdash']);

			} else {

				$this->Flash->error(__('could not be saved. Please, try again.'));

			}
		}
		$this->set(compact('driver'));

	}

	public function trucks() {
		$this->viewBuilder()->setLayout('providerLayout');
		$this->loadModel('Providers');
		$this->loadModel('Trucks');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$id=$user['id'];
		$this->set(compact('user'));

		$providers = $this->Trucks->Providers->find('list', ['limit' => 1])->where(['user_provider_id'=>$id]);
		$this->set(compact('providers'));

		$truck = $this->Trucks->newEmptyEntity();
		if ($this->request->is('post')) {

			$truck = $this->Trucks->patchEntity($truck, $this->request->getData());

			if ($this->Trucks->save($truck)) {
				$this->Flash->success(__('truck info added succesfully'));

				return $this->redirect(['Controller' => 'Users', 'action' => 'providerdash']);

			} else {
				$this->Flash->error(__('please try again'));
			}
		}

		$this->set(compact('truck'));
	}

	// method is for welcome page for users

	public function home() {
		$this->viewBuilder()->setLayout('userLayout');

	}

	// method is for the registration of users

	public function register() {

		$this->viewBuilder()->setLayout("userLayout");

		$user = $this->Users->newEmptyEntity();

		if ($this->request->is('post')) {

			if (!empty($this->request->getData('profile_image'))) {
				$file      = $this->request->getData('profile_image')->getClientFilename('profile_image');
				$file_name = date("dmYHis").preg_replace('/\s/', '', $file);
				// die;
				$tmpPath = $this->request->getData('profile_image')->getStream('profile_image')->getMetadata('uri');

				move_uploaded_file($tmpPath, WWW_ROOT."img/".$file_name);
			}

			$user = $this->Users->patchEntity($user, $this->request->getData());

			$user['profile_image'] = $file_name;

			if ($this->Users->save($user)) {

				$this->Flash->success(__('The user has been Registered'));
				$role = $this->request->getData('role');

				//check the role submitted by user and will redirect accordingly

				if ($role == 0) {
					return $this->redirect(['controller' => 'Users', 'action' => 'customerdash']);

				}if ($role == 1) {
					return $this->redirect(['action' => 'providers']);

				}
				if ($role == 2) {
					return $this->redirect(['action' => 'admindash']);
				}
			}

			//return $this->redirect(['action' => 'request']);
			 else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}

		}
		$this->set(compact('user'));
	}

	//method is for the customer request of delivery

	public function requests() {
		$this->viewBuilder()->setLayout('customerLayout');

		$this->loadModel('Users');
		$this->loadModel('Requests');
		$this->loadModel('Trucks');
		$this->loadModel('Areas');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$id=$user['id'];
		$this->set(compact('user'));

		$users  = $this->Requests->Users->find('list', ['limit'  => 1])->where(['id'=>$id]);
		$trucks = $this->Requests->Trucks->find('list', ['limit' => 200]);

		$areas = $this->Requests->Areas->find('list', ['limit' => 200]);

		$this->set(compact('users'));

		$this->set(compact('trucks'));

		$this->set(compact('areas'));

		$request = $this->Requests->newEmptyEntity();
		if ($this->request->is('post')) {

			$requests         = $this->request->getData();
			$user_customer_id = $requests['user_customer_id'];

			$request = $this->Requests->patchEntity($request, $this->request->getData());

			if ($this->Requests->save($request)) {

				$this->Flash->success(__('successfully submited your request'));
				return $this->redirect(['action' => 'customerdash']);

			} else {
				$this->Flash->error(__('The request could not completed'));
			}
		}

		$this->set(compact('request'));
	}
	public function requestdetail() {
		$this->viewBuilder()->setLayout('customerLayout');

		$this->loadModel('Requests');
		$this->loadModel('Trucks');
		$this->loadModel('Areas');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));
		$id       = $user['id'];
		$requests = TableRegistry::getTableLocator()->get('Requests');
		//$request  = $Requests->find()->where(['Requests.user_customer_id' => $id]);
		$query = $this->Users->findById($id)->contain(['Requests']);

		$area = $this->paginate($this->Areas);
		$this->set(compact('area'));

		$truck = $this->paginate($this->Trucks);
		$this->set(compact('truck'));

		foreach ($query as $user) {
			$requestdetail = $user->requests;
			$this->set(compact('requestdetail'));
		}

	}
	public function providerhasrequest() {

		$this->viewBuilder()->setLayout('providerLayout');
		$this->loadModel('Requests');
		$this->loadModel('Trucks');
		$this->loadModel('Providers');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();

		$id = $user['id'];

		$this->set(compact('user'));

		$query = $this->Providers->findByUser_provider_id($id)->contain(['Trucks']);

		foreach ($query as $provider) {

			$trucks = $provider->trucks;
			$this->set(compact('trucks'));

		}
	}

	//method is for provider profile page

	public function providerdash() {

		$this->viewBuilder()->setLayout('providerLayout');
		$this->loadModel('Users');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));
	}
	public function driverdetails() {
		$this->loadModel('Providers');
		$this->loadModel('Drivers');
		$this->viewBuilder()->setLayout('providerLayout');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));

		$id = $user['id'];

		$query = $this->Providers->findByUser_provider_id($id)->contain(['Drivers']);

		foreach ($query as $provider) {

			$driverdetail = $provider->drivers;
			$this->set(compact('driverdetail'));
		}
	}
	public function truckdetail() {

		$this->viewBuilder()->setLayout('providerLayout');
		$this->loadModel('Trucks');
		$this->loadModel('Providers');
		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$id     = $user['id'];

		$this->set(compact('user'));

		$query    = $this->Providers->findByUser_provider_id($id)->contain(['Trucks']);
		$provider = $this->Providers->find()->where(['user_provider_id' => $id]);
		$this->set(compact('provider'));

		foreach ($query as $provider) {

			$truckdetail = $provider->trucks;
			$this->set(compact('truckdetail'));
		}

	}

	//method is for the user's login page

	public function login() {

		$this->viewBuilder()->setLayout("userLayout");

		$this->request->allowMethod(['get', 'post']);
		//$user = $this->request->getAttribute('identity');

		// Apply permission conditions to a query so only
		// the records the current user has access to are returned.
		//$query = $user->applyScope('customerdash', $query);

		$result = $this->Authentication->getResult($user = null);

		$user = $result->getdata();

		$key = 'role';

		$role = $user[$key];

		// regdless of POST or GET, redirect if user is logged in

		if ($result->isValid($user)) {

			if ($role == 0) {
				// redirect to /Userss after login success
				$redirect = $this->request->getQuery('redirect', [
						'Controller' => 'users',
						'action'     => 'customerdash']);
				return $this->redirect($redirect);
			}

			if ($role == 1) {
				$redirect = $this->request->getQuery('redirect', [
						'Controller' => 'users',
						'action'     => 'providerdash']);
				return $this->redirect($redirect);
			}

			if ($role == 2) {
				$redirect = $this->request->getQuery('redirect', [
						'Controller' => 'Admins',
						'action'     => 'admindash'
					]);
				return $this->redirect($redirect);
			}

		}

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

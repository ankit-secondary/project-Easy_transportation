<?php
declare(strict_types = 1);

namespace App\Controller;
use App\Model\Requests;
use cake\Event\EventInterface;
use cake\Mailer\Mailer;
use cake\ORM\TableRegistry;
use cake\Utility\Security;

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
		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$role   = $user['role'];
		//if ($role == 0) {
		//	$this->Authorization->authorize($user, 'providerdash');
		//}
		$this->viewBuilder()->setLayout('customerLayout');
		$this->loadModel('Requests');
		$this->loadModel('Trucks');
		$this->set(compact('user'));
		$id = $user['id'];

		//$this->set(compact('request'));
	}

	public function chatindex() {
		$this->loadModel('Providers');
		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));
		if ($user['role'] == 0) {
			$this->viewBuilder()->setLayout('customerLayout');
			$providers = $this->paginate($this->Providers);
			$this->set(compact('providers'));
			$users = $this->paginate($this->Users);
			$this->set(compact('users'));
		}

	}
	public function userprofile() {
		$this->loadModel('Requests');
		$this->loadModel('Providers');
		$this->loadModel('Areas');
		$this->loadModel('Fares');
		$this->loadModel('Trucks');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));
		$id   = $user['id'];
		$role = $user['role'];
		if ($role == 0) {
			$this->viewBuilder()->setLayout('customerLayout');
		}
		if ($role == 1) {
			$this->viewBuilder()->setLayout('providerLayout');
		}
		if ($role == 2) {
			$this->viewBuilder()->setLayout('adminLayout');
		}
		$area = $this->paginate($this->Areas);
		$this->set(compact('area'));
		$truck = $this->paginate($this->Trucks);
		$this->set(compact('truck'));
		$fare = $this->paginate($this->Fares);
		$this->set(compact('fare'));

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

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();

		$role = $user['role'];

		if ($role == 0) {
			$this->viewBuilder()->setLayout("customerLayout");
		}

		if ($role == 1) {
			$this->viewBuilder()->setLayout("providerLayout");
		}

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
		$role = $user['role'];
		$id   = $user['id'];

		$users = $this->Reports->Users->find('list', ['limit' => 100])->where(['id' => $id]);
		$this->set(compact('users'));
		if ($role == 0) {
			$this->viewBuilder()->setLayout('customerLayout');
		}
		if ($role == 1) {
			$this->viewBuilder()->setLayout('providerLayout');
		}

		$id    = $user['id'];
		$email = $user['email'];

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
		$id     = $user['id'];
		$this->set(compact('user'));

		$this->viewBuilder()->setLayout('providerLayout');

		$users = $this->Providers->Users->find('list', ['limit' => 1])->where(['id' => $id]);

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
	public function providerarea() {

		$this->viewBuilder()->setLayout('providerLayout');
		$this->loadModel('Areas');
		$this->loadModel('Users');
		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$id     = $user['id'];
		$this->set(compact('user'));

		$users = $this->Areas->Users->find('list', ['limit' => 200])->where(['id' => $id]);

		$this->set(compact('users'));
		$area = $this->Areas->newEmptyEntity();
		if ($this->request->is('post')) {

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
		$id        = $user['id'];
		$providers = $this->Drivers->Providers->find('list', ['limit' => 1])->where(['user_provider_id' => $id]);

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
		$id     = $user['id'];
		$this->set(compact('user'));

		$providers = $this->Trucks->Providers->find('list', ['limit' => 1])->where(['user_provider_id' => $id]);
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
		$this->loadModel('Contacts');
		$this->viewBuilder()->setLayout('userLayout');
		$contact = $this->Contacts->newEmptyEntity();
		if ($this->request->is('post')) {
			$contact = $this->Contacts->patchEntity($contact, $this->request->getData());
			if ($this->Contacts->save($contact)) {
				$this->Flash->success(__('successfully submited your message'));
				return $this->redirect(['action' => 'home']);
			} else {
				$this->Flash->error(__('could not be saved please try again'));
			}
		}
		$this->set(compact('contact'));
	}
	public function search() {
		$this->viewBuilder()->setLayout('userLayout');
		$this->loadModel('Fares');
		$this->loadModel('Areas');
		$this->loadModel('Trucks');

		if (isset($_GET['search'])) {
			$dropto = $_GET['dropto'];
			$fare   = TableRegistry::get('Fares');
			$fares  = $fare->find('all')->
			where(['dropto' => $dropto]);

		}

		$area = $this->paginate($this->Areas);
		$this->set(compact('area'));

		$truck = $this->paginate($this->Trucks);

		$this->set(compact('truck'));

		$this->set(compact('fares'));

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
		$this->loadModel('Areas');
		$this->loadModel('Fares');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$id     = $user['id'];
		$this->set(compact('user'));

		$users = $this->Requests->Users->find('list', ['limit' => 1])->where(['id' => $id]);

		$areas = $this->Requests->Areas->find('list', ['limit' => 200]);

		$allfare = $this->paginate($this->Fares);
		$this->set(compact('allfare'));

		$this->set(compact('users'));

		$this->set(compact('areas'));

		$request = $this->Requests->newEmptyEntity();
		if ($this->request->is('post')) {

			$pickup_date      = $this->request->getdata('pickup_date');
			$user_customer_id = $this->request->getdata('user_customer_id');
			$truck_size       = $this->request->getdata('truck_size');
			$pickup_location  = $this->request->getdata('pickup_location');
			$drop_location    = $this->request->getdata('drop_location');
			$weight_in_ton    = $this->request->getdata('weight_in_ton');

			$fare  = TableRegistry::get('Fares');
			$query = $fare->find()->select(['fare', 'approx_time'])->
			where(['pickupat'                  => $pickup_location, 'dropto'                  => $drop_location, '
	                         truck_size' => $truck_size]);

			$areas  = TableRegistry::get('Areas');
			$query1 = $areas->find()->select(['user_provider_id'])->
			where(['id' => $pickup_location]);

			foreach ($query1 as $areas) {
				$providerid = $areas->user_provider_id;
			}

			foreach ($query as $fare) {

				$faredetail = $fare->fare;
				$approxtime = $fare->approx_time;
				$this->set(compact('faredetail'));
				$this->set(compact('approxtime'));
			}

			if (!empty($faredetail)) {

				//$request_table = TableRegistry::get('Requests');
				//$request1 = $request_table->newEmptyEntity();
				$request->pickup_date      = $pickup_date;
				$request->user_customer_id = $user_customer_id;
				$request->truck_size       = $truck_size;
				$request->pickup_location  = $pickup_location;
				$request->drop_location    = $drop_location;
				$request->weight_in_ton    = $weight_in_ton;
				$request->cost             = $faredetail;
				$request->approx_time      = $approxtime;
				$request->user_provider_id = $providerid;
				//$request = $this->Requests->patchEntity($request, $this->request->getData());

				if ($this->Requests->save($request)) {

					$this->Flash->success(__('successfully submited your request'));
					return $this->redirect(['action' => 'customerdash']);

				} else {
					$this->Flash->error(__('The request could not completed'));
				}
			} else {
				$this->Flash->error(__(' unreach drop location sorry for inconvinence'));
			}
		}

		$this->set(compact('request'));
	}
	public function requestdetail() {
		$this->viewBuilder()->setLayout('customerLayout');

		$this->loadModel('Requests');
		$this->loadModel('Areas');
		$this->loadModel('Fares');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));
		$id       = $user['id'];
		$requests = TableRegistry::getTableLocator()->get('Requests');
		//$request  = $Requests->find()->where(['Requests.user_customer_id' => $id]);
		$query = $this->Users->findById($id)->contain(['Requests']);

		$area = $this->paginate($this->Areas);
		$this->set(compact('area'));

		$fare = $this->paginate($this->Fares);
		$this->set(compact('fare'));

		foreach ($query as $user) {
			$requestdetail = $user->requests;
			$this->set(compact('requestdetail'));
		}
	}
	public function providerhasrequest() {

		$this->viewBuilder()->setLayout('providerLayout');
		$this->loadModel('Users');
		$this->loadModel('Requests');
		$this->loadModel('Areas');
		$this->loadModel('Fares');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();

		$id = $user['id'];

		$this->set(compact('user'));

		$users = $this->paginate($this->Users);
		$this->set(compact('users'));
		$areas = $this->paginate($this->Areas);
		$this->set(compact('areas'));
		$fares = $this->paginate($this->Fares);
		$this->set(compact('fares'));
		$requesttable = TableRegistry::get('Requests');

		$area = $this->Areas->findByUser_provider_id($id)->contain(['Requests']);

		foreach ($area as $areas) {
			$providersrequest = $areas->requests;
		}
		$this->set(compact('providersrequest'));
	}

	public function viewrequest($id) {
		$this->loadModel('Requests');
		$this->loadModel('Areas');
		$this->viewBuilder()->setLayout('default');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));

		$request          = $this->Requests->get($id);
		$user_customer_id = $request['user_customer_id'];
		$users            = $this->Users->find()->select(['email', 'mobileno', 'yourname'])->where(['id' => $user_customer_id]);
		$this->set(compact('users'));

		$this->set(compact('users'));

		$this->set(compact('request', $request));

		$areas = $this->paginate($this->Areas);

		$this->set(compact('areas'));

	}

	public function deleterequest($id = null) {
		$this->loadModel('Requests');
		$this->request->allowMethod(['post', 'delete']);
		$request = $this->Requests->get($id);
		if ($this->Requests->delete($request)) {
			$this->Flash->success(__('Request has been deleted.'));
		} else {
			$this->Flash->error(__('Request could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'providerdash']);

	}

	public function serviceassign($id) {

		$this->loadModel('Services');
		$this->loadModel('Providers');
		$this->loadModel('Requests');
		$this->loadModel('Drivers');
		$this->loadModel('Trucks');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$userid = $user['id'];
		$query1 = $this->Providers->findByUser_provider_id($userid);
		foreach ($query1 as $providers) {
			$providerid = $providers->id;
		}
		$drivertable = TableRegistry::get('Drivers');
		$drivers     = $drivertable->find('list', ['limit' => 200])->where(['provider_id' => $providerid]);

		foreach ($drivers as $driver) {

		}

		if (empty($driver)) {
			return $this->redirect(['action' => 'driver']);
		}

		$this->set(compact('drivers'));

		$trucks = $this->Trucks->find('list', ['limit' => 200])->where(['provider_id' => $providerid]);
		foreach ($trucks as $truck) {
		}
		if (empty($truck)) {
			return $this->redirect(['action' => 'trucks']);
		}

		$this->set(compact('trucks'));

		$this->viewBuilder()->setLayout('default');

		$service = $this->Services->newEmptyEntity();

		if ($this->request->is('post')) {
			$truckid  = $this->request->getData('truck_id');
			$driverid = $this->request->getData('driver_id');
			$status   = $this->request->getData('status');

			$requesttable = TableRegistry::get('Requests');
			$servicetable = TableRegistry::get('Services');

			$query = $requesttable->find('all')->where(['id' => $id]);
			foreach ($query as $requests) {
				$fare       = $requests->cost;
				$approxtime = $requests->approx_time;
				$this->set(compact('requests'));
			}
			$query1 = $servicetable->find()->select('id')->where(['request_id' => $id]);
			foreach ($query1 as $serviceid) {
				$service_id = $serviceid->id;

			}

			if (empty($service_id)) {
				$service->request_id     = $id;
				$service->truck_id       = $truckid;
				$service->provider_id    = $providerid;
				$service->driver_id      = $driverid;
				$service->approx_time    = $approxtime;
				$service->money_to_pay   = $fare;
				$service->service_status = $status;

				if ($this->Services->save($service)) {
					$requests->status = 1;
					$this->Requests->save($requests);
					$this->Flash->success('successfully assigned');

					return $this->redirect(['controller' => 'Users', 'action' => 'providerdash']);
				} else {
					$this->Flash->error(__('please try again'));
				}

			} else {
				$this->Flash->error(__('Already assigned service to this request'));
				return $this->redirect(['controller' => 'Users', 'action' => 'providerdash']);
			}

		}
		$this->set(compact('service'));

	}

	public function servicedetail() {
		$this->loadModel('Requests');
		$this->loadModel('Services');
		$this->loadModel('Drivers');
		$this->loadModel('Providers');
		$providers = $this->paginate($this->Providers);
		$this->set(compact('providers'));
		$requests = $this->paginate($this->Requests);
		$this->set(compact('requests'));

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));

		$role = $user['role'];
		$id   = $user['id'];

		$services = TableRegistry::getTableLocator()->get('Services');

		if ($role == 0) {
			$this->viewBuilder()->setLayout('customerLayout');

			$query = $this->Requests->findByUser_customer_id($id)->contain(['Services']);

			foreach ($query as $customer) {
				$customerservice = $customer->services;

				$this->set(compact('customerservice'));
			}
			if (!empty($customerservice)) {
				foreach ($customerservice as $customer) {
					$driverid = $customer->driver_id;
				}
				$driverdetails = $this->Drivers->find()->where(['id' => $driverid]);

				$this->set(compact('driverdetails'));
			}

		}

		if ($role == 1) {
			$this->viewBuilder()->setLayout('providerLayout');

			$query = $this->Providers->findByUser_provider_id($id)->contain(['Services']);

			foreach ($query as $provider) {
				$providerservice = $provider->services;
				$this->set(compact('providerservice'));
			}

			if (!empty($providerservice)) {

				foreach ($providerservice as $provider) {
					$driverid = $provider->driver_id;

				}

				$driverdetail = $this->Drivers->find()->where(['id' => $driverid]);

				$this->set(compact('driverdetail'));
			}

		}
	}

	//method is for provider profile page

	public function providerdash() {

		$this->loadModel('Requests');
		$this->loadModel('Areas');
		$this->viewBuilder()->setLayout('providerLayout');
		$this->loadModel('Users');
		$this->loadModel('Providers');
		$this->loadModel('Services');

		$result = $this->Authentication->getResult($user = null);
		$user   = $result->getData();
		$this->set(compact('user'));
		$id       = $user['id'];
		$requests = $this->Requests->find()->where(['user_provider_id' => $id]);
		$count    = 0;
		foreach ($requests as $request) {
			$count++;
		}
		$this->set(compact('count'));

		$provider = $this->Providers->find()->select('id')->where(['user_provider_id' => $id]);

		foreach ($provider as $providers) {
			$providerid = $providers->id;
		}

		if (!empty($providerid)) {

			$service = $this->Services->find()->where(['provider_id' => $providerid]);

			$counter        = 0;
			$deliveredcount = 0;

			foreach ($service as $services) {
				if ($services->service_status == 0 || $services->service_status == 1) {
					$counter++;

				}
				if ($services->service_status == 2) {
					$deliveredcount++;

				}

			}
			$this->set(compact('counter'));
			$this->set(compact('deliveredcount'));
		} else {
			return $this->redirect(['action' => 'providers']);
		}

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

		$role = $user['role'];

		// regdless of POST or GET, redirect if user is logged in
		if ($role == 0) {

			if ($result->isValid($user)) {
				$user->status = 1;
				$this->Users->save($user);
				// redirect to /Userss after login success
				$redirect = $this->request->getQuery('redirect', [
						'Controller' => 'users',
						'action'     => 'customerdash']);
				return $this->redirect($redirect);
			}
		}

		if ($role == 1) {

			if ($result->isValid($user)) {
				$user->status = 1;
				$this->Users->save($user);
				$redirect = $this->request->getQuery('redirect', [
						'Controller' => 'users',
						'action'     => 'providerdash']);
				return $this->redirect($redirect);
			}
		}

		if ($this->request->is('post') && !$result->isValid()) {
			$this->Flash->error(__('Invalid username or password'));
		}
	}

	public function forgotpassword() {
		//$this->viewBuilder()->setLayout('userLayout');
		$this->loadModel('Users');
		if ($this->request->is('post')) {
			$myemail = $this->request->getData('email');
			$mytoken = Security::hash(Security::randomBytes(25));

			$user = $this->Users->find('all')->where(['email' => $myemail])->first();
			if (!empty($user)) {

				//$user->password = 'secret';

				$user->token = $mytoken;

				if ($this->Users->save($user)) {
					$this->Flash->success('reset password link has been sent to your email('.$myemail.').please check you mail');

					/*$email = new Email('default');
					$email->transport('mail');
					$email->emailFormat('html');
					$email->from('fbg.ankit@gmail.com');
					$email->subject('please reset your password');
					$email->to($myemail);
					$email->send('Hii'.$myemail.'<br>click link to reset password<br><a href="http://localhost:8765/users/resetpassword/'.$mytoken.'">Reset password</a>');*/
					$mailer = new Mailer('default');
					$mailer->setFrom(['gideon.fbg@gmail.com'])->setTo($myemail);

					$mailer->setSubject('reset password');
					$mailer->deliver('Hii '.$myemail.' click link to reset password " http://localhost:8765/users/resetpassword/'.$mytoken);
				}

			}

			if (empty($user)) {
				echo 'invalid email address';

			}

		}
	}

	public function resetpassword($token) {
		$this->loadModel('Users');
		$this->viewBuilder()->setLayout('userLayout');

		if ($this->request->is('post')) {
			//$email=$this->request->getData('email');
			$mypass = $this->request->getData('password');
			//$token          = Security::hash(Security::randomBytes(25));
			$usertable = TableRegistry::get('Users');
			$user      = $usertable->find('all')->where(['token' => $token])->first();
			//$user           = $this->Users->findByToken($token);
			$user->password = $mypass;

			if ($usertable->save($user)) {
				$this->Flash->success('password successfully change');

				return $this->redirect(['action' => 'login']);
			}
		}
	}
	public function logout() {
		$result = $this->Authentication->getResult();
		$user   = $result->getdata();
		// regardless of POST or GET, redirect if user is logged in
		if ($result->isValid()) {
			$user->status = 0;
			$this->Users->save($user);
			$this->Authentication->logout();
			return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}
	}
}
?>

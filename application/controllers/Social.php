<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Social extends MY_Controller {

	protected $libraries = array('hybridauth');

	public function index()
	{
		// Send to the view all permitted services as a user profile if authenticated
		$data['providers'] = $this->hybridauth->getProviders();
		foreach($data['providers'] as $provider=>$d) {
			if ($d['connected'] == 1) {
				$data['providers'][$provider]['user_profile'] = $this->hybridauth->authenticate($provider)->getUserProfile();
			}
		}
		$this->load->view('hauth/home', $data);
	}

	public function login($provider)
	{
		log_message('debug', "controllers.HAuth.login($provider) called");

		try
		{
			log_message('debug', 'controllers.HAuth.login: loading hybridauth');


			if ($this->hybridauth->providerEnabled($provider))
			{
				log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
				$service = $this->hybridauth->authenticate($provider);

				if ($service->isUserConnected())
				{
					log_message('debug', 'controller.HAuth.login: user authenticated.');
					// Redirect back to the index to show the profile
					redirect('social/', 'refresh');
				}
				else // Cannot authenticate user
					{
					show_error('Cannot authenticate user');
				}
			}
			else // This service is not enabled.
				{
				log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
			case 0 : $error = 'Unspecified error.'; break;
			case 1 : $error = 'HybridAuth configuration error.'; break;
			case 2 : $error = 'Provider not properly configured.'; break;
			case 3 : $error = 'Unknown or disabled provider.'; break;
			case 4 : $error = 'Missing provider application credentials.'; break;
			case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				//redirect();
				if (isset($service))
				{
					log_message('debug', 'controllers.HAuth.login: logging out from service.');
					$service->logout();
				}
				show_error('User has cancelled the authentication or the provider refused the connection.');
				break;
			case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				break;
			case 7 : $error = 'User not connected to the provider.';
				break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}

	public function logout($provider = "")
	{

		log_message('debug', "controllers.HAuth.logout($provider) called");

		try
		{
			if ($provider == "") {

				log_message('debug', "controllers.HAuth.logout() called, no provider specified. Logging out of all services.");
				$data['service'] = "all";
				$this->hybridauth->logoutAllProviders();
			} else {
				if ($this->hybridauth->providerEnabled($provider)) {
					log_message('debug', "controllers.HAuth.logout: service $provider enabled, trying to check if user is authenticated.");
					$service = $this->hybridauth->authenticate($provider);

					if ($service->isUserConnected()) {
						log_message('debug', 'controller.HAuth.logout: user is authenticated, logging out.');
						$service->logout();
						$data['service'] = $provider;
					} else { // Cannot authenticate user
						show_error('User not authenticated, success.');
						$data['service'] = $provider;
					}

				} else { // This service is not enabled.

					log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
					show_404($_SERVER['REQUEST_URI']);
				}
			}
			// Redirect back to the main page. We're done with logout
			redirect('social/', 'refresh');

		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
			case 0 : $error = 'Unspecified error.'; break;
			case 1 : $error = 'Hybriauth configuration error.'; break;
			case 2 : $error = 'Provider not properly configured.'; break;
			case 3 : $error = 'Unknown or disabled provider.'; break;
			case 4 : $error = 'Missing provider application credentials.'; break;
			case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				//redirect();
				if (isset($service))
				{
					log_message('debug', 'controllers.HAuth.login: logging out from service.');
					$service->logout();
				}
				show_error('User has cancelled the authentication or the provider refused the connection.');
				break;
			case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				break;
			case 7 : $error = 'User not connected to the provider.';
				break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}

	// Little json api and variable output testing function. Make it easy with JS to verify a session.  ;)
	public function status($provider = "")
	{
		try
		{
			if ($provider == "") {
				log_message('debug', "controllers.HAuth.status($provider) called, no provider specified. Providing details on all connected services.");
				$connected = $this->hybridauth->getConnectedProviders();

				if (count($connected) == 0) {
					$data['status'] = "User not authenticated.";
				} else {
					$connected = $this->hybridauth->getConnectedProviders();
					foreach($connected as $provider) {
						if ($this->hybridauth->providerEnabled($provider)) {
							log_message('debug', "controllers.HAuth.status: service $provider enabled, trying to check if user is authenticated.");
							$service = $this->hybridauth->authenticate($provider);
							if ($service->isUserConnected()) {
								log_message('debug', 'controller.HAuth.status: user is authenticated to $provider, providing profile.');
								$data['status'][$provider] = (array)$this->hybridauth->getAdapter($provider)->getUserProfile();
							} else { // Cannot authenticate user
								$data['status'][$provider] = "User not authenticated.";
							}
						} else { // This service is not enabled.
							log_message('error', 'controllers.HAuth.status: This provider is not enabled ('.$provider.')');
							$data['status'][$provider] = "provider not enabled.";
						}
					}
				}
			} else {
				if ($this->hybridauth->providerEnabled($provider)) {
					log_message('debug', "controllers.HAuth.status: service $provider enabled, trying to check if user is authenticated.");
					$service = $this->hybridauth->authenticate($provider);
					if ($service->isUserConnected()) {
						log_message('debug', 'controller.HAuth.status: user is authenticated to $provider, providing profile.');
						$data['status'][$provider] = (array)$this->hybridauth->getAdapter($provider)->getUserProfile();
					} else { // Cannot authenticate user
						$data['status'] = "User not authenticated.";
					}
				} else { // This service is not enabled.
					log_message('error', 'controllers.HAuth.status: This provider is not enabled ('.$provider.')');
					$data['status'] = "provider not enabled.";
				}
			}
			$this->load->view('hauth/status', $data);
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
			case 0 : $error = 'Unspecified error.'; break;
			case 1 : $error = 'Hybriauth configuration error.'; break;
			case 2 : $error = 'Provider not properly configured.'; break;
			case 3 : $error = 'Unknown or disabled provider.'; break;
			case 4 : $error = 'Missing provider application credentials.'; break;
			case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				//redirect();
				if (isset($service))
				{
					log_message('debug', 'controllers.HAuth.login: logging out from service.');
					$service->logout();
				}
				show_error('User has cancelled the authentication or the provider refused the connection.');
				break;
			case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				break;
			case 7 : $error = 'User not connected to the provider.';
				break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}

	public function endpoint()
	{
		require_once APPPATH . 'third_party/hybridauth/index.php';
	}
}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */

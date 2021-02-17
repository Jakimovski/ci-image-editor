<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
	public function index()
	{
		echo '<h2>Users</h2>';
	}

	public function login()
	{
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			$rules = [

				'email' => 'required|valid_email',
				'password' => [
					'rules' => 'required|min_length[8]|max_length[255]|validateUser[email,password]|verifyUser[email,validated]',
					'errors' => [
						'validateUser' => 'Invalid email or password.',
						'verifyUser' => 'Account not verified. Check your email for verification link.',
					]
				],
			];

			if ($this->validate($rules)) {
				$model = new UserModel();
				$userData = $model->where('email', $this->request->getVar('email'))
					->first();


				$this->setUserSession($userData);
				return redirect()->to('/dashboard');
			} else {
				$data['validation'] = $this->validator;
			}
		}

		return view('users/login', $data);
	}

	private function setUserSession($user)
	{
		$data = [
			'id' => $user['id'],
			'first_name' => $user['first_name'],
			'last_name' => $user['last_name'],
			'email' => $user['email'],
			'isLoggedIn' => true,
			'validated' => $user['verified'],
		];
		session()->set($data);
	}

	public function register()
	{
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'first_name' => [
					'label' => 'first name',
					'rules' => 'required|min_length[2]|max_length[30]',
				],
				'last_name' => [
					'label' => 'last name',
					'rules' => 'required|min_length[2]|max_length[30]',
				],
				'email' => 'required|valid_email|is_unique[users.email]',
				'password' => 'required|min_length[8]|max_length[255]',
				'password_confirm' => [
					'label' => 'confirm password',
					'rules' => 'matches[password]',
				],
			];

			if ($this->validate($rules)) {
				//TODO: store the user into DB
				$model = new UserModel();
				$verificationCode = hash('sha256', $this->request->getVar('email') . date('Y-m-d H:i:s'));
				$emailAddress = $this->request->getVar('email');
				$firstName = $this->request->getVar('first_name');
				$lastName = $this->request->getVar('last_name');
				$userData = [
					'first_name' => $firstName,
					'last_name' => $lastName,
					'email' => $emailAddress,
					'password' => $this->request->getVar('password'),
					'verification_code' => $verificationCode,
				];



				//TODO: send validation email to the user
				$subject = 'Image Editor - Email Verification';
				$verificationUrl = base_url() . '/user/verify/' . $verificationCode;
				$message = "Hello $firstName,<br><br>
							Thank you for signing up on Image Editor.<br>
							Please use the link bellow to verify your account.<br>
							<a href='" . $verificationUrl . "' target='_blank'>Verify Account.</a><br><br>
							Sincerely,<br>
							Image Editor team.";

				$email = \Config\Services::email();
				$email->setTo($emailAddress);
				$email->setFrom('ci.image.editor@gmail.com');
				$email->setSubject($subject);
				$email->setMessage($message);

				$session = session();
				if ($email->send()) {
					$model->save($userData);
					$session->setFlashdata('success', 'Account created successfuly. Check your email for verification link.');
					return redirect()->to('/user/login');
				} else {
					$session->setFlashdata('error', 'An error occurred while creating the account. Please try again.');
					return redirect()->to('/user/register');
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}



		return view('users/register', $data);
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}

	public function verifyUser($verificationCode)
	{

		$model = new UserModel();


		$user = $model->where('verification_code', $verificationCode)
			->first();
		if ($user) {
			$user['verified'] = 1;
			$model->save($user);
			$session = session();
			$session->setFlashdata('success', 'Account verified.');
			return redirect()->to('/user/login');
		} else {
			return redirect()->to('/');
		}
	}
}

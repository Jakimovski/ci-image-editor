<?php

namespace App\Controllers;

use App\Models\UserModel;

class Validator extends BaseController
{
	public function username_check()
	{
		if ($this->request->getMethod() == 'post') {
			$model = new UserModel();
			$username = $this->request->getVar('user_name');
			$firstname = strtolower($this->request->getVar('first_name'));
			$lastname = strtolower($this->request->getVar('last_name'));
			$isTaken = $model->where('username', $username)
				->first();

			if (strlen($username) < 1) {
				echo '';
			} else if (!$isTaken) {
				echo '<span class="text-success">The username is available.</span>';
			} else {
				$newUsername = '';

				$isTakenFirstName = $model->where('username', $firstname)
					->first();
				$isTakenLastName = $model->where('username', $lastname)
					->first();
				$isTakenFirstLast = $model->where('username', $firstname . $lastname)
					->first();
				$isTakenLastFirst = $model->where('username', $lastname . $firstname)
					->first();
				$isTakenFirstDotLast = $model->where('username', $firstname . '.' . $lastname)
					->first();
				$isTakenLastDotFirst = $model->where('username', $lastname . '.' . $firstname)
					->first();
				$isTakenFirstDashLast = $model->where('username', $firstname . '-' . $lastname)
					->first();
				$isTakenLastDashFirst = $model->where('username', $lastname . '-' . $firstname)
					->first();
				$isTakenFirstUnderscoreLast = $model->where('username', $firstname . '_' . $lastname)
					->first();
				$isTakenLastUnderscoreFirst = $model->where('username', $lastname . '_' . $firstname)
					->first();

				if (!$isTakenFirstName && strlen($firstname) > 1) {
					$newUsername = $firstname;
				} else if (!$isTakenLastName && strlen($lastname) > 1) {
					$newUsername = $lastname;
				} else if (!$isTakenFirstLast && strlen($firstname) > 1 && strlen($lastname) > 1) {
					$newUsername = $firstname . $lastname;
				} else if (!$isTakenLastFirst && strlen($firstname) > 1 && strlen($lastname) > 1) {
					$newUsername = $lastname . $firstname;
				} else if (!$isTakenFirstDotLast && strlen($firstname) > 1 && strlen($lastname) > 1) {
					$newUsername = $firstname . '.' . $lastname;
				} else if (!$isTakenLastDotFirst && strlen($firstname) > 1 && strlen($lastname) > 1) {
					$newUsername = $lastname . '.' . $firstname;
				} else if (!$isTakenFirstDashLast && strlen($firstname) > 1 && strlen($lastname) > 1) {
					$newUsername = $firstname . '-' . $lastname;
				} else if (!$isTakenLastDashFirst && strlen($firstname) > 1 && strlen($lastname) > 1) {
					$newUsername = $lastname . '-' . $firstname;
				} else if (!$isTakenFirstUnderscoreLast && strlen($firstname) > 1 && strlen($lastname) > 1) {
					$newUsername = $firstname . '_' . $lastname;
				} else if (!$isTakenLastUnderscoreFirst && strlen($firstname) > 1 && strlen($lastname) > 1) {
					$newUsername = $lastname . '_' . $firstname;
				} else {
					$i = 1;
					while (true) {
						$newUsername = $username . $i;
						$isTaken = $model->where('username', $newUsername)
							->first();
						if (!$isTaken) {
							break;
						}
						$i++;
					}
				}

				echo '<span class="text-danger">The username \'' . $username . '\' is not available. Recommended username: ' . $newUsername . '</span>';
			}
		}
	}
	public function email_check()
	{
		if ($this->request->getMethod() == 'post') {
			$model = new UserModel();
			$isTaken = $model->where('email', $this->request->getVar('email_address'))
				->first();

			if (!$isTaken) {
				echo '';
			} else {
				echo '<span class="text-danger">This email address is already in use.</span>';
			}
		}
	}
}

<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'company' => 'required|max:255',
			'address' => 'required|max:255',
			'zip_code' => 'required|max:255',
			'city' => 'required|max:255',
			'bank' => 'required|max:255',
			'iban' => 'required|max:255',
			'phone' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'company' => $data['company'],
			'address' => $data['address'],
			'zip_code' => $data['zip_code'],
			'city' => $data['city'],
			'bank' => $data['bank'],
			'iban' => $data['iban'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'password' => bcrypt($data['password']),
		]);
	}

}

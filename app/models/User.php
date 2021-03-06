<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');



	public function students()
	{
		return $this->belongsToMany('User', 'relationships', 'mentor_id', 'student_id');
	}


	public function mentors()
	{
		return $this->belongsToMany('User', 'relationships', 'student_id', 'mentor_id');
	}

	public static $rules = array(
		'username'    => 'required|max:20',
		'password'    => 'required',
		'confirm_password'    => 'required',
		'first_name'  => 'required|max:20',
		'last_name'   => 'max:20',
		'email'		  => 'required|email',
		'github_name' => 'required',
		'bio'         => 'required',
		'img_url'	  => 'required',
		'interests'	  => 'required'
	);
	public static $loginRules = array(
		'username' => 'required',
		'password' => 'required',
		);

	public static $loginRegistrationRules = array(
		'username'  => 'required|max:15',
		'password'  => 'required',
		'email'	    => 'email',
	);

	// parameter must be user object
	public static function checkIfMentor($user){
		if ($user->is_mentor == 1){
			return true;
		} else {
			return false;
		}
	}
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

}

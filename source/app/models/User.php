<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Chrisbjr\ApiGuard\Models\ApiKey;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable = array('username', 'email', 'quota_used');

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

	/**
	* Get the unique identifier for the user.
	*
	* @return mixed
	*/
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	* Get the password for the user.
	*
	* @return string
	*/
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	* Get the e-mail address where password reminders are sent.
	*
	* @return string
	*/
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	* Gets the pending email changes for a user
	*
	* @return EmailChange
	*/
	public function emailChanges()
	{
		return EmailChange::firstOrCreate(['user_id' => $this->getKey()]);
	}

	/**
	* Get all files uploaded by this user
	*
	* @return UploadedFile
	*/
	public function links()
	{
		return $this->hasMany('Link')->orderBy('created_at', 'desc');
	}

	/**
	* Get all files uploaded by this user
	*
	* @return UploadedFile
	*/
	public function linksByPage($limit = 10)
	{
		return $this->links()->paginate($limit);
	}

	/**
	* Get the api key that belongs to user
	*
	* @return ApiKey
	*/
	public function apiKey()
	{
		$apiKey = ApiKey::where('user_id', '=', $this->getKey())->first();
		if (isset($apiKey))
		{
			return $apiKey;
		}
		else
		{
			$apiKey = new ApiKey;
			$apiKey->key = $apiKey->generateKey();
			$apiKey->user_id = $this->getKey();
			$apiKey->level = 10;
			$apiKey->ignore_limits = 0; //False
			$apiKey->save();
			return $apiKey;
		}
	}

}

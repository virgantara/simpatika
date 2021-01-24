<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	const ERROR_USER_INACTIVE = 3;
	const ERROR_EMAIL_INVALID = 4;
	const ERROR_EMAIL_NOT_EXIST = 5;
	const ERROR_UUID_INVALID = 6;

	public $email;
	public $loginMode;
	public $uuid;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

	public function __construct($username, $password, $loginMode=1,$email='',$uuid='')
    {
        parent::__construct($username, $password);
        $this->loginMode = $loginMode;
        $this->email=$email;
        $this->uuid = $uuid;
    }


	public function authenticate()
	{

		switch($this->loginMode)
		{
			case 1:
				$user = User::model()->findByAttributes(array('username' => $this->username));
			
				if(is_null($user))
				{

					$this->errorCode=self::ERROR_USERNAME_INVALID;

				}
				else if($user->password!==$this->password)
				{
					
					$this->errorCode=self::ERROR_PASSWORD_INVALID;

				}
				else if($user->status != 10){

					$this->errorCode=self::ERROR_USER_INACTIVE;
					
				}
				else{
					
					$this->errorCode=self::ERROR_NONE;
					$this->setState('isLogin',true);
					$this->setState('username', $user->username);
					$this->setState('level', $user->level);
					$this->setState('prodi',$user->kode_prodi);
					$this->setState('uuid',$user->uuid);
				
					
				}
			break;
			case 2:
				$user = User::model()->findByAttributes(array('email' => $this->email));
			
				if(is_null($user))
				{

					$this->errorCode=self::ERROR_EMAIL_NOT_EXIST;

				}

				else if($user->email!==$this->email)
				{
					
					$this->errorCode=self::ERROR_EMAIL_INVALID;

				}

				else if($user->status != 10){

					$this->errorCode=self::ERROR_USER_INACTIVE;
					
				}
				else{

					$this->errorCode=self::ERROR_NONE;
					$this->setState('isLogin',true);
					$this->setState('username', $user->username);
					$this->setState('level', $user->level);
					$this->setState('prodi',$user->kode_prodi);
					$this->setState('uuid',$user->uuid);
				
				}
			break;
			case 3:
				$user = User::model()->findByAttributes(array('uuid' => $this->uuid));
			
				if(is_null($user))
				{

					$this->errorCode=self::ERROR_UUID_INVALID;

				}

				else if($user->uuid!==$this->uuid)
				{
					
					$this->errorCode=self::ERROR_UUID_INVALID;

				}

				else if($user->status != 10){

					$this->errorCode=self::ERROR_USER_INACTIVE;
					
				}
				else{

					$this->errorCode=self::ERROR_NONE;
					$this->setState('isLogin',true);
					$this->setState('uuid',$user->uuid);
					$this->setState('email',$user->email);
					$this->setState('username', $user->username);
					$this->setState('level', $user->level);
					$this->setState('prodi',$user->kode_prodi);
				
				
				}
			break;
		}
		


		return !$this->errorCode;
	}
}
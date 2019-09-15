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

	public $email;
	public $loginMode;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

	public function __construct($username, $password, $loginMode=1,$email='')
    {
        parent::__construct($username, $password);
        $this->loginMode = $loginMode;
        $this->email=$email;
    }


	public function authenticateGoogle()
	{
		


		return !$this->errorCode;
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
				
				
				}
			break;
		}
		


		return !$this->errorCode;
	}
}
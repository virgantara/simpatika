<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	const ERROR_USER_INACTIVE = 3;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->findByAttributes(array('username' => $this->username));
			
		if(is_null($user))
		{

			$this->errorCode=self::ERROR_USERNAME_INVALID;

		}
		else if($user->password!==$this->password)
		{
			
			$this->errorCode=self::ERROR_PASSWORD_INVALID;

		}
		else if($user->status != 1){

			$this->errorCode=self::ERROR_USER_INACTIVE;
			
		}
		else{

			$this->errorCode=self::ERROR_NONE;
			$this->setState('isLogin',true);
			$this->setState('username', $user->username);
			$this->setState('level', $user->level);
			$this->setState('prodi',$user->kode_prodi);
		
		
		}


		return !$this->errorCode;
	}
}
<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	const ERROR_USER_UNACTIVATED = 101;
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
		/*
				$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
		*/
		$user = User::model()->find('email=:uid' ,array(':uid'=>$this->username));
		// user not found
		if($user===null)$this->errorCode=self::ERROR_USERNAME_INVALID; 
		// wrong password
		else if(md5($this->password) !== $user->password)$this->errorCode=self::ERROR_PASSWORD_INVALID; 
		// unactivated
		else if (!$user->is_activated) $this->errorCode = self::ERROR_USER_UNACTIVATED;
		else{
			$this->_id=$user->id;
			$this->setState("_id", $user->id);
			$this->username = $user->email; 
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
		//return $this->errorCode==self::ERROR NONE;
	}

	public function getId()
    {
        return $this->_id;
    }
}
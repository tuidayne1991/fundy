<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $userid;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('userid, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		/*
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
		*/
		if (!$this->hasErrors()) {
            // we only want to authenticate when no input errors
			$identity=new UserIdentity($this->userid,$this->password);
			$identity->authenticate();
			switch($identity->errorCode) {
				case UserIdentity::ERROR_NONE:
					$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
					Yii::app()->user->login($identity,$duration);
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
				    $message = <<<HTML
				    <b>Hmm, we don't recognize that email/phone number. Please try again.</b>
				    <br/><br/>
				    You can login using any email or mobile phone number associated with your account. Make sure that it is typed correctly.
HTML;
					$this->addError('userid',$message);
					break;
                case UserIdentity::ERROR_USER_UNACTIVATED:
                    $message = <<<HTML
				    <b>Hmm, your account has not been activated. Please check your email and click on the activation link that we sent you.</b>
				    <br/><br/>
				    If you did not receive our activation email, please first check your spam inbox. You can also click on the following link <a href="/site/resendActivateEmail/username/{$this->userid}">Resend Activation Email</a>, and we'll resend you the activation link again!
HTML;
                    $this->addError('userid' , $message) ;
                    break;
				default: // UserIdentity::ERROR_PASSWORD_INVALID
				$message = <<<HTML
				    <b>Hmm, that's not the right password. Please try again or <a href="/user/reset">request a new one.</a></b>
				    <br/><br/>
				    The password and email address you entered don't match. Remember that Choxue passwords are case sensitive, so check your CAPS lock key.
HTML;
					$this->addError('password',$message);
					break;
			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->userid,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
	
}

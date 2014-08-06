<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
     * User Model
     *
     * @var table
     */
	protected $table = 'users';

	/**
     * User Model - Primary Key
     *
     * @var primaryKey
     */
	protected $primaryKey = 'id';

	/**
     * User Model - Fillable
     *
     * @var fillable
     */
	protected $fillable = array(
		'firstname',
		'lastname',
		'username',
		'email',
		'password',
		'password_temp',
		'code',
		'active',
		'big_three',
		'height',
		'weight',
		'wilks_rating',
		'gender'
	);

	/**
     * User Model - Validation Rules
     *
     * @var rules
     */
	public static $rules = array(
		'firstname'			=> 'required|alpha|min:2|max:12',
		'lastname'			=> 'required|alpha|min:2|max:12',
		'username'			=> 'required|min:3|max:15|unique:users',
		'email'				=> 'required|email|unique:users',
		'password'			=> 'required|min:6',
		'password_confirm'=> 'required|same:password',
		'big_three'			=> 'numeric',
		'height'			   => 'numeric',
		'weight'			   => 'numeric',
		'gender'			   => 'alpha',
		'picture'			=> 'image'
	);

	/**
	 * Set Relationship to Post Model
	 *
	 * @return mixed
	 */
	public function posts()
	{
		return $this->has_many('Post');
	}

    /**
     * Get the date the user was created.
     *
     * @return string
     */
    public function joined()
    {
        return String::date("M d 'y", $this->created_at);
    }

    /**
     * Converts inches into feet/inches format
     *
     * @param  $height      [Original height]
     * @return $f_height    [Formatted height]
     */
    public function formatHeight($height)
    {
        if ($height > 36)
        {
            $feet = (int)($height / 12);
            $inches = (int)($height % 12);
            $f_height = $feet . "' " . $inches . '"';
        }
        else {
            $f_height = ' ';
        }

        return $f_height;
    }

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

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
    * Get the token value for the "remember me" session.
    *
    * @return string
    */
   public function getRememberToken()
   {
      return $this->remember_token;
   }

   /**
    * Set the token value for the "remember me" session.
    *
    * @param  string  $value
    * @return void
    */
   public function setRememberToken($value)
   {
      $this->remember_token = $value;
   }

   /**
    * Get the column name for the "remember me" token.
    *
    * @return string
    */
   public function getRememberTokenName()
   {
      return 'remember_token';
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

}

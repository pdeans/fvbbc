<?php


class UsersController extends BaseController {

    /**
     * Constructor - UsersController
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=>array('getProfile')));
    }


    /** ------------------------------------------
     *  Wilks Rating Calculators
     *  ------------------------------------------
     */

    /**
     * Wilks Rating Calculator for Males
     *
     * @param  $total_lifted [Total weight lifted], $body_weight [Body weight]
     * @return $wilks_rating [Wilks Rating]
     */
    public function wilksCalculatorMale($total_lifted, $body_weight) {

        $total_lifted_kilo = (double)($total_lifted / 2.2046);
        $body_weight_kilo = (double)($body_weight / 2.2046);

        $wilks_rating = $total_lifted_kilo *
                        (500 /
                              (   (-216.0475144)
                                + (16.2606339 * $body_weight_kilo)
                                + (-0.002388645 * pow($body_weight_kilo, 2))
                                + (-0.00113732 * pow($body_weight_kilo, 3))
                                + (0.00000701863 * pow($body_weight_kilo, 4))
                                + (-0.00000001291 * pow($body_weight_kilo, 5)) )
                        );

        return $wilks_rating = number_format($wilks_rating, 3, '.', '');
    }

    /**
     * Wilks Rating Calculator for Females
     *
     * @param  $total_lifted [Total weight lifted], $body_weight [Body weight]
     * @return $wilks_rating [Wilks Rating]
     */
    public function wilksCalculatorFemale($total_lifted, $body_weight) {

        $total_lifted_kilo = (double)($total_lifted / 2.2046);
        $body_weight_kilo = (double)($body_weight / 2.2046);

        $wilks_rating = $total_lifted_kilo *
                        (500 /
                              (   (594.31747775582)
                                + (-27.23842536447 * $body_weight_kilo)
                                + (0.82112226871 * pow($body_weight_kilo, 2))
                                + (-0.00930733913 * pow($body_weight_kilo, 3))
                                + (0.00004731582 * pow($body_weight_kilo, 4))
                                + (-0.00000009054 * pow($body_weight_kilo, 5)) )
                        );

        return $wilks_rating = number_format($wilks_rating, 3, '.', '');
    }


    /**
     * ------------------------------------------
     *  User Accounts
     * ------------------------------------------
     */

    /**
     * User Registeratrion (GET)
     *
     * @return View
     */
    public function getCreate() {

        return View::make('users.create');
    }

    /**
     * User Registration (POST)
     *
     * @return Redirect
     */
    public function postCreate() {

        $validator = Validator::make(Input::all(), User::$rules);

        if ($validator->fails()) {

            return Redirect::route('user-create')
                    ->withErrors($validator)
                    ->withInput();
        }
        else {
            $firstname      = Input::get('firstname');
            $lastname       = Input::get('lastname');
            $username       = Input::get('username');
            $password       = Input::get('password');
            $email          = Input::get('email');
            $height         = Input::get('height');
            $weight         = Input::get('weight');
            $big_three      = Input::get('big_three');
            $gender         = Input::get('gender');

            # Set Wilks Rating
            if (empty($big_three) || empty($weight)) {

                $wilks_rating = null;
            }
            else {

                if ($gender == 'female') {

                    $wilks_rating = $this->wilksCalculatorFemale($big_three, $weight);
                }
                else {

                    $wilks_rating = $this->wilksCalculatorMale($big_three, $weight);
                }
            }

            # Set Activation Code
            $code = str_random(60);

            # Create User
            $user = User::create(array(
                'firstname'     => $firstname,
                'lastname'      => $lastname,
                'username'      => $username,
                'password'      => Hash::make($password),
                'email'         => $email,
                'height'        => $height,
                'weight'        => $weight,
                'big_three'     => $big_three,
                'wilks_rating'  => $wilks_rating,
                'gender'        => $gender,
                'code'          => $code,
                'active'        => 0
            ));

            if ($user) {

                Mail::send('emails.auth.activate',
                    array('link' => URL::route('user-activate', $code), 'username' => $username),
                        function($message) use ($user) {
                            $message->to($user->email, $user->username)->subject('Activate your account');
                });

                return Redirect::route('home')
                        ->with('message', 'Your account has been created! We have sent you a confirmation email to activate your account.');
            }
        }
    }

    /**
     * User Activation Code
     *
     * @param  $code [Activation code]
     * @return Redirect
     */
    public function getActivate($code) {

        $user = User::where('code', '=', $code)->where('active', '=', 0);

        if ($user->count()) {

            $user = $user->first();

            # Update user to active state
            $user->active   = 1;
            $user->code     = '';

            if ($user->save()) {
                return Redirect::route('home')
                        ->with('message', 'Account activated! You can now sign in.');
            }
        }
        return Redirect::route('home')
                ->with('message', 'We could not activate your account. Try again later.');
    }

    /**
     * User Sign In (GET)
     *
     * @return View
     */
    public function getSignIn() {

        return View::make('users.signin');
    }

    /**
     * User Sign In (POST)
     *
     * @return Redirect
     */
    public function postSignIn() {

        $validator = Validator::make(Input::all(),
            array(
                'username'  => 'required',
                'password'  => 'required'
            )
        );

        if ($validator->fails()) {

            return Redirect::route('user-sign-in')
                    ->withErrors($validator)
                    ->withInput()
                    ->with('message', 'Log in failed. Please try again.');
        }
        else {

            $remember = (Input::has('remember')) ? true: false;

            $auth = Auth::attempt(array(
                'username'      => Input::get('username'),
                'password'      => Input::get('password'),
                'active'        => 1
            ), $remember);

            if ($auth) {

                return Redirect::intended('/');
            }
            else {

                return Redirect::route('user-sign-in')
                        ->with('form-message', 'Email/password not found.');
            }
        }
        return Redirect::route('home')
                ->with('message', 'There was a problem signing you in. Have you activated?');
    }

    /**
     * User Profile Settings (GET)
     *
     * @return View
     */
    public function getProfile()
    {
        # Get the user information
        $user = Auth::user();

        if(empty($user->id)) {
            return Redirect::route('home')
                    ->with('message', 'User does not exist.');
        }

        return View::make('users.profile', compact('user'));
    }

    /**
     * User Edit Profile (POST)
     *
     * @param $user
     * @return Redirect
     */
    public function postEdit($user)
    {
        $validator = Validator::make(Input::all(),
            array(
                'firstname'         => 'alpha|min:2|max:12',
                'lastname'          => 'alpha|min:2|max:12',
                'username'          => 'min:3|max:15|unique:users',
                'email'             => 'email|unique:users',
                'password'          => 'min:6',
                'password_confirm'  => 'same:password',
                'big_three'         => 'numeric',
                'height'            => 'numeric',
                'weight'            => 'numeric',
                'gender'            => 'alpha'
            )
        );

        if ($validator->fails()) {

            return Redirect::to('user/profile')
                    ->withErrors($validator);
        }
        else {

            $new_firstname      = Input::get('firstname');
            $new_lastname       = Input::get('lastname');
            $new_username       = Input::get('username');
            $new_password       = Input::get('password');
            $new_email          = Input::get('email');
            $new_height         = Input::get('height');
            $new_weight         = Input::get('weight');
            $new_big_three      = Input::get('big_three');
            $new_gender         = Input::get('gender');

            if (!empty($new_firstname)) {

                if ($new_firstname == $user->firstname) {
                    return Redirect::to('user/profile')
                            ->with('form-message', 'Firstname already exists.');
                }
                else
                    $user->firstname = $new_firstname;
            }

            if (!empty($new_lastname)) {

                if ($new_Lastname == $user->Lastname) {
                    return Redirect::to('user/profile')
                            ->with('form-message', 'Lastname already exists.');
                }

                $user->lastname = $new_lastname;
            }

            if (!empty($new_username)) {

                $user->username = $new_username;
            }

            if (!empty($new_password)) {

                $user->password = Hash::make($new_password);
            }

            if (!empty($new_email)) {

                $user->email = $new_email;
            }

            if (!empty($new_height)) {

                $user->height = $new_height;
            }
            if (!empty($new_weight)) {

                $user->weight = $new_weight;
            }

            if (!empty($new_big_three)) {

                $user->big_three = $new_big_three;
            }

            if ($new_gender != $user->gender) {

                $user->gender = $new_gender;
            }

            # Set Wilks Rating - if necessary
            if ((!empty($user->big_three)) && (!empty($user->weight)))
            {
                if ($user->gender == 'female') {

                    $new_wilks_rating = $this->wilksCalculatorFemale($user->big_three, $user->weight);
                    $user->wilks_rating = $new_wilks_rating;
                }
                else {
                    $new_wilks_rating = $this->wilksCalculatorMale($user->big_three, $user->weight);
                    $user->wilks_rating = $new_wilks_rating;
                }
            }

            if ($user->save()){

                return Redirect::route('home')
                        ->with('message', 'Your account information has been updated.');
            }
            else {

                return Redirect::route('user/profile')
                        ->with('message', 'There was a problem updating your account. Please try again.');
            }
        }
        return Redirect::route('user/profile')
                    ->with('message', 'Your account could not be updated at this time. Please try again later.');
    }

    /**
     * User Account - Sign out
     *
     * @return Redirect
     */
    public function getSignOut()
    {
        Auth::logout();

        return Redirect::route('home')
                ->with('message', 'You are now logged out.');
    }

    /**
     * User Account - Forgot Password (GET)
     * @return View users.forgot
     */
    public function getForgotPassword()
    {
        return View::make('users.forgot');
    }

    /**
     * User Account - Forgot Password (POST)
     * @return Redirect
     */
    public function postForgotPassword()
    {
        $validator = Validator::make(Input::all(),
            array(
                'email'     => 'required|email'
            )
        );

        if ($validator->fails()) {
            return Redirect::route('user-forgot-password')
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $user = User::where('email', '=', Input::get('email'));

            if ($user->count()) {
                $user = $user->first();

                // Generate a new code and password
                $code       = str_random(60);
                $password   = str_random(10);
                // Assign user new code and password
                $user->code             = $code;
                $user->password_temp    = Hash::make($password);

                if ($user->save()) {
                    Mail::send('emails.auth.forgot', array(
                        'link'      => URL::route('user-recover', $code),
                        'username'  => $user->username,
                        'password'  => $password
                        ), function($message) use ($user) {
                            $message->to($user->email, $user->username)->subject('Your new password');
                        }
                    );
                    return Redirect::route('home')
                            ->with('message', 'We have emailed you a new password.');
                }
            }
        }
        return Redirect::route('user-forgot-password')
                ->with('message', 'Could not request new password.');
    }

    /**
     * User Account - Recover Password (GET)
     * @param  $code
     * @return Redirect
     */
    public function getRecover($code) {
        $user = User::where('code', '=', $code)
                ->where('password_temp', '!=', '');

        if ($user->count()) {
            $user = $user->first();

            $user->password         = $user->password_temp;
            $user->password_temp    = '';
            $user->code             = '';

            if ($user->save()) {
                return Redirect::route('home')
                        ->with('message', 'Your account has been recovered. You can now sign in with your new password.');
            }

            return Redirect::route('home')
                    ->with('message', 'Could not recover your account.');
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;


use App;
use App\Helpers\SendMail;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jrean\UserVerification\Facades\UserVerification;
use OpenGraph;
use Redirect;
use SEOMeta;
use Session;
use Twitter;
use Validator;


class AuthUserController extends Controller
{


    //Show login view
    public function getLogin()
    {

        //SEO
        SEOMeta::setDescription('This is my page description');
        SEOMeta::setCanonical(\Request::url());


        //Open Graph
        OpenGraph::setDescription('This is my page description');
        OpenGraph::setTitle('Login');
        OpenGraph::setUrl(\Request::url());
        OpenGraph::addImage('public/images/logo.png', ['height' => 300, 'width' => 300]);

        //Twitter
        Twitter::setTitle('Login');

        return view('auth.login');
    }

    //Post login data
    public function postLogin(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => 'required|min:6|max:100',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }


        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

        //If admin
        if (auth()->guard('admin')->attempt($credentials)) {
            return redirect('/admin/dashboard');
        } //If user
        else if (auth()->guard('web')->attempt($credentials)) {

            //Check if verified
            if (Auth::user()->verified == 0) {
                auth()->guard('web')->logout();
                Session::flash('message', 'You must verify your account');
                Session::flash('message_type', 'danger');
                return redirect('/login')->withInput();
            } //Check if banned
            else if (Auth::user()->banned == 1) {
                auth()->guard('web')->logout();
                Session::flash('message', 'You are banned');
                Session::flash('message_type', 'danger');
                return redirect('/login')->withInput();
            } else {
                return redirect('/items');
            }

        } else {
            //Invalid Credentials
            Session::flash('message', 'Invalid credentials');
            Session::flash('message_type', 'danger');
            return redirect('/login')->withInput();
        }
    }


    //User Logout
    public function logout()
    {
        auth()->guard('web')->logout();
        Session::flash('message', 'You have been successfully logged out');
        Session::flash('message_type', 'success');

        return redirect('/login');
    }


    //Registration view
    public function getRegister()
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        //SEO
        SEOMeta::setDescription('This is my page description');
        SEOMeta::setCanonical(\Request::url());


        //Open Graph
        OpenGraph::setDescription('This is my page description');
        OpenGraph::setTitle('Register');
        OpenGraph::setUrl(\Request::url());
        OpenGraph::addImage('public/images/logo.png', ['height' => 300, 'width' => 300]);

        //Twitter
        Twitter::setTitle('Register');

        return view('auth.register');
    }


    //Registration post
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());

        //Send mail with verification code
        SendMail::send_verification_mail($user);

        Session::flash('message', 'Verification code sent to your email.');
        Session::flash('message_type', 'success');
        return redirect('/login');
    }


    //Get the guard to be used during registration.
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }


    //Get a validator for an incoming registration request

    protected function create(array $data)
    {
        return App\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //Create a new user instance after a valid registration.

    public function getVerification(Request $request, $token)
    {

        $this->validateRequest($request);

        try {
            UserVerification::process($request->input('email'), $token, $this->userTable());
        } finally {


            //Send welcome mail
            SendMail::send_welcome_mail($request->input('email'));


            Session::flash('message', 'User confirmed successfully.');
            Session::flash('message_type', 'success');
            return redirect::to('/login');
        }

    }


    //Get verification page

    protected function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect($this->redirectIfVerificationFails());
        }
    }

    //Show the verification error view.

    public function redirectIfVerificationFails()
    {
        return property_exists($this, 'redirectIfVerificationFails') ? $this->redirectIfVerificationFails : '/verification/error';
    }

    //Validate the verification link.

    protected function userTable()
    {
        return property_exists($this, 'userTable') ? $this->userTable : 'users';
    }


    //Get the verification e-mail view name.

    public function getVerificationError()
    {
        return view('errors.user-verification');
    }

    //Get the user table name.

    public function editVerificationResend()
    {

        return view('auth.resend_verification');
    }

    //Get the redirect path for a failing verification token verification.

    public function updateVerificationResend(Request $request)
    {

        $email = $request->input('email');
        $user = App\User::where('email', '=', $request->input('email'))->get();

        //Check if email address exists
        $validator = validator($request->all(), [
            'email' => 'required|email|max:255|exists:users',
        ]);
        if ($validator->fails()) {
            return redirect('/verification_resend')
                ->withErrors($validator)
                ->withInput();
        }

        //Check if user if banned
        if ($user['0']['banned'] == 1) {
            Session::flash('message', 'Your account has been banned.');
            Session::flash('message_type', 'danger');

            return redirect::to('/login');
        }

        //Check if user if verified
        if ($user['0']['verified'] == 1) {
            Session::flash('message', 'You are already verified.');
            Session::flash('message_type', 'danger');

            return redirect::to('/login');
        }

        //Create Token
        $generate_token = hash_hmac('sha256', Str::random(40), config('app.key'));

        //Update token
        $user_id = $user['0']['id'];
        $update_token = App\User::find($user_id);
        $update_token->verification_token = $generate_token;
        $update_token->verification_token = $generate_token;

        //Save token
        if ($update_token->save()) {
            SendMail::send_resend_verification_mail($email, $generate_token);
            Session::flash('message', 'Verification code sent to your email.');
            Session::flash('message_type', 'success');

            return redirect::to('/login');
        } else {
            Session::flash('message', 'Error while sending verification code.');
            Session::flash('message_type', 'danger');

            return redirect::to('/login');
        }


    }

    //View for verification

    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }

    //View for verification

    protected function verificationEmailView()
    {
        return property_exists($this, 'verificationEmailView') ? $this->verificationEmailView : 'emails.user-verification';
    }


}

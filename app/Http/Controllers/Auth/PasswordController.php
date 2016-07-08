<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Session;
use Redirect;

class PasswordController extends Controller
{


    //Get the name of the guest middleware.
    protected function guestMiddleware()
    {
        $guard = $this->getGuard();

        return $guard ? 'guest:'.$guard : 'guest';
    }

    //Display the form to request a password reset link.
    public function getEmail()
    {
        return $this->showLinkRequestForm();
    }

    //Display the form to request a password reset link.
    public function showLinkRequestForm()
    {
        if (property_exists($this, 'linkRequestView')) {
            return view($this->linkRequestView);
        }

        if (view()->exists('auth.passwords.email')) {
            return view('auth.passwords.email');
        }

        return view('auth.password');
    }

    //Send a reset link to the given user.
    public function postEmail(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }

    //Send a reset link to the given user.
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateSendResetLinkEmail($request);

        $broker = $this->getBroker();

        $response = Password::broker($broker)->sendResetLink(
            $this->getSendResetLinkEmailCredentials($request),
            $this->resetEmailBuilder()
        );

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->getSendResetLinkEmailSuccessResponse($response);
            case Password::INVALID_USER:
            default:
                return $this->getSendResetLinkEmailFailureResponse($response);
        }
    }

    //Validate the request of sending reset link.
    protected function validateSendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }

    //Get the needed credentials for sending the reset link.
    protected function getSendResetLinkEmailCredentials(Request $request)
    {
        return $request->only('email');
    }

    //Get the Closure which is used to build the password reset email message.
    protected function resetEmailBuilder()
    {
        return function (Message $message) {
            $message->subject($this->getEmailSubject());
        };
    }

    //Get the e-mail subject line to be used for the reset link email.
    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : 'Your Password Reset Link';
    }

    //Get the response for after the reset link has been successfully sent.
    protected function getSendResetLinkEmailSuccessResponse($response)
    {
        return redirect()->back()->with('status', trans($response));
    }

    //Get the response for after the reset link could not be sent.
    protected function getSendResetLinkEmailFailureResponse($response)
    {
        return redirect()->back()->withErrors(['email' => trans($response)]);
    }

    //Display the password reset view for the given token.
    public function getReset(Request $request, $token = null)
    {
        return $this->showResetForm($request, $token);
    }

    //Display the password reset view for the given token.
    public function showResetForm(Request $request, $token = null)
    {
        if (is_null($token)) {
            return $this->getEmail();
        }

        $email = $request->input('email');

        if (property_exists($this, 'resetView')) {
            return view($this->resetView)->with(compact('token', 'email'));
        }

        if (view()->exists('auth.passwords.reset')) {
            return view('auth.passwords.reset')->with(compact('token', 'email'));
        }

        return view('auth.reset')->with(compact('token', 'email'));
    }

    //Reset the given user's password.
    public function postReset(Request $request)
    {
        return $this->reset($request);
    }

    //Reset the given user's password.
    public function reset(Request $request)
    {
        $this->validate(
            $request,
            $this->getResetValidationRules(),
            $this->getResetValidationMessages(),
            $this->getResetValidationCustomAttributes()
        );

        $credentials = $this->getResetCredentials($request);

        $broker = $this->getBroker();

        $response = Password::broker($broker)->reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return $this->getResetSuccessResponse($response);
            default:
                return $this->getResetFailureResponse($request, $response);
        }
    }

    //Get the password reset validation rules.
    protected function getResetValidationRules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    //Get the password reset validation messages.
    protected function getResetValidationMessages()
    {
        return [];
    }

    //Get the password reset validation custom attributes.
    protected function getResetValidationCustomAttributes()
    {
        return [];
    }

    //Get the password reset credentials from the request.
    protected function getResetCredentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    //Reset the given user's password.
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();

        Auth::guard($this->getGuard())->login($user);
    }

    //Get the response for after a successful password reset.
    protected function getResetSuccessResponse($response)
    {
        return redirect($this->redirectPath())->with('status', trans($response));
    }

    //Get the response for after a failing password reset.
    protected function getResetFailureResponse(Request $request, $response)
    {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    //Get the broker to be used during password reset.
    public function getBroker()
    {
        return property_exists($this, 'broker') ? $this->broker : null;
    }

    //Get the guard to be used during password reset.
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }

    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        Session::flash('message', 'Lozinka uspje, unesite novi recept');
        Session::flash('message_type', 'success');
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/items';
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App;
use App\Helpers;
use App\Helpers\SendMail;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models;
use Hash;
use Illuminate\Http\Request;
use JWTAuth;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;


class AuthApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function postRegister(Request $request)
    {

        $save = new App\User;
        $save->name = $request->input('name');
        $save->email = $request->input('email');
        $save->password = Hash::make($request->password);
        $save->banned = 0;
        $save->verified = 1;

        //Check if user already exist
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
        ]);

        //Check for email address
        if ($validator->fails()) {
            $message = "Email already exist";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);
        }
        if ($save->save()) {
            //Send welcome mail
            SendMail::send_welcome_mail($request->input('email'));
            return ResponseBuilder::success();
        } else {
            $message = "Problem with saving user";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_500, $message);
        }


    }

    public function postForgotPassword(Request $request)
    {

        //Get email value
        $email = $request->input('email');

        //Check if email exist
        $validator = Validator::make($request->all(), [
            'email' => 'email|unique:users',
        ]);

        //If email exist send new password
        if ($validator->fails()) {

            //Generate new password
            $new_password = str_random(8);

            //Update password
            $update_password = App\User::where('email', $request->input('email'))->first();
            $update_password->password = Hash::make($new_password);

            //If new password is saved
            if ($update_password->save()) {

                //Send to user new password
                SendMail::send_api_new_password($request->input('email'), $new_password);
                return ResponseBuilder::success();
            } else {

                //If faild
                $message = "Problem with";
                return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_500, $message);
            }

        } else {
            $message = "User with this email doesn't exist";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);
        }


    }

    public function postLogin(Request $request)
    {

        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {

                $message = "Invalid Credicals";
                return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            $message = "Server Error";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_500, $message);
        } finally {


            $data = [
                'token' => $token
            ];

            return ResponseBuilder::success($data);

        }


    }

   


}

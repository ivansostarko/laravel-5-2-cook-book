<?php

namespace App\Http\Controllers\Api;

use App;
use App\Helpers;
use App\Helpers\SendMail;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models;
use Illuminate\Http\Request;
use JWTAuth;
use Hash;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }


    public function getProfile() {

        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                $message = "User not found";
                return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $message = "token_expired ". $e->getStatusCode();
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);


        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        $data = [
            'user_id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'created_at' => date('d.m.Y', strtotime($user['created_at']))
        ];
        // the token is valid and we have found the user via the sub claim
        return ResponseBuilder::success($data);

    }

    public function postProfile(Request $request) {

        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                $message = "User not found";
                return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $message = "token_expired ". $e->getStatusCode();
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);


        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        $update = App\User::find($user['id']);

        $update->name=$request->input('name');
        $update->email=$request->input('email');


        /* TO DO VALIDATE EMAIL */

        if($update->save()) {
            return ResponseBuilder::success();
        }
        else {
            $message = "There has been an error changing the profile data";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_500, $message);
        }
        
    }

    public function postPassword(Request $request) {

        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                $message = "User not found";
                return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $message = "token_expired ". $e->getStatusCode();
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);


        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        $update = App\User::find($user['id']);

        $update->password=Hash::make($request->input('password'));


        if($update->save()) {
            return ResponseBuilder::success();
        }
        else {
            $message = "There has been an error changing the password";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_500, $message);
        }

    }

    public function getProfileItems() {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                $message = "User not found";
                return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $message = "token_expired ". $e->getStatusCode();
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);


        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        $items = App\Models\Item::select('id', 'name', 'image','created_at' )->where('user_id',$user['id'])->get();

        //If record exist
        if ($items->first()) {

            return ResponseBuilder::success($items);
        }
        else {
            $message = "Data not found";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_404, $message);
        }

    }

    public function  postUpdateItem(Request $request) {

        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                $message = "User not found";
                return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $message = "token_expired ". $e->getStatusCode();
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);


        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        $update = App\Models\Item::findOrFail($request->input('id'));
        $update->name=$request->input('name');
        $update->category_id=$request->input('category_id');
        $update->content=$request->input('content');
        $update->ingredients=$request->input('ingredients');
        $update->time=$request->input('time');

        if ($request->hasFile('image')) {

            $file_name = substr(md5(uniqid(rand(), true)), 0, 100) . '.' . $request->file('image')->getClientOriginalExtension();
            $file_path = 'public/uploads/' . $file_name;

            $request->file('image')->move(
                base_path() . '/public/uploads/', $file_name
            );


            $update->image = $file_path;


        }

       if($update->save()) {
           
           return ResponseBuilder::success();
       }
        else {
            $message = "Data not found sranje";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_500, $message);
        }

    }


    public function  postStoreItem(Request $request) {

        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                $message = "User not found";
                return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $message = "token_expired ". $e->getStatusCode();
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);


        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        $save = new App\Models\Item;
        $save->name=$request->input('name');
        $save->category_id=$request->input('category_id');
        $save->user_id=$user['id'];
        $save->content=$request->input('content');
        $save->ingredients=$request->input('ingredients');
        $save->time=$request->input('time');

        if ($request->hasFile('image')) {

            $file_name = substr(md5(uniqid(rand(), true)), 0, 100) . '.' . $request->file('image')->getClientOriginalExtension();
            $file_path = 'public/uploads/' . $file_name;

            $request->file('image')->move(
                base_path() . '/public/uploads/', $file_name
            );


            $save->image = $file_path;


        }

        if($save->save()) {

            return ResponseBuilder::success();
        }
        else {
            $message = "Data not found sranje";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_500, $message);
        }

    }


    public function  destroyItem($id) {

        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                $message = "User not found";
                return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $message = "token_expired ". $e->getStatusCode();
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_401, $message);


        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        $destroy = App\Models\Item::find($id);

        if ($destroy->delete()) {
            return ResponseBuilder::success();
        } else {
            $message = "Data not found sranje";
            return ResponseBuilder::errorWithMessage(App\Helpers\ErrorCode::ERROR_500, $message);

        }
    }

}

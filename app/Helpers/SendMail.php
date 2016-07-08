<?php
namespace App\Helpers;

use Jrean\UserVerification\Facades\UserVerification;
use Mail;

class SendMail
{

    /* Send verification mail*/
    public static function send_verification_mail($user)
    {
        UserVerification::generate($user);

        UserVerification::send($user, 'Verify you account');
    }

    /* Resend verification mail */
    public static function send_resend_verification_mail($email, $token)
    {
        $parameters = array(
            'email' => $email

        );

        $data = array(
            'email' => $email,
            'token' => $token
        );

        Mail::send('emails.user-resend-verification', $data, function ($message) use ($parameters) {
            $message->from(env('MAIL_ADDRESS', ''), env('MAIL_FROM', ''));
            $message->to($parameters['email'])->subject('Resend verification  mail');
        });

    }

    /* send welcome mail */
    public static function send_welcome_mail($email)
    {

        $parameters = array(
            'email' => $email
        );

        $data = array(
            'email' => $email
        );


        Mail::send('emails.welcome', $data, function ($message) use ($parameters) {
            $message->from(env('MAIL_ADDRESS', ''), env('MAIL_FROM', ''));
            $message->to($parameters['email'])->subject('Welcome mail');
        });

    }

    /* Send mail when admin verified user */
    public static function send_admin_verify($email)
    {

        $parameters = array(
            'email' => $email
        );

        $data = array(
            'email' => $email
        );


        Mail::send('emails.admin-verify', $data, function ($message) use ($parameters) {
            $message->from(env('MAIL_ADDRESS', ''), env('MAIL_FROM', ''));
            $message->to($parameters['email'])->subject('Admin verified your account');
        });

    }

    /* Send mail when admin banned user */
    public static function send_admin_ban($email)
    {

        $parameters = array(
            'email' => $email
        );

        $data = array(
            'email' => $email
        );


        Mail::send('emails.admin-ban', $data, function ($message) use ($parameters) {
            $message->from(env('MAIL_ADDRESS', ''), env('MAIL_FROM', ''));
            $message->to($parameters['email'])->subject('Admin banned your account');
        });

    }

    /* Send mail when admin unbanned user */
    public static function send_admin_unban($email)
    {

        $parameters = array(
            'email' => $email
        );

        $data = array(
            'email' => $email
        );


        Mail::send('emails.admin-unban', $data, function ($message) use ($parameters) {
            $message->from(env('MAIL_ADDRESS', ''), env('MAIL_FROM', ''));
            $message->to($parameters['email'])->subject('Admin unbanned your account');
        });

    }

    /* Send mail when user change password */
    public static function send_user_password($email)
    {

        $parameters = array(
            'email' => $email
        );

        $data = array(
            'email' => $email
        );


        Mail::send('emails.user-change-password', $data, function ($message) use ($parameters) {
            $message->from(env('MAIL_ADDRESS', ''), env('MAIL_FROM', ''));
            $message->to($parameters['email'])->subject('Password changed');
        });

    }

    /*Send mail when user change password - API */
    public static function send_api_new_password($email, $password) {

        $parameters = array(
            'email' => $email
        );

        $data = array(
            'password' => $password
        );


        Mail::send('emails.user-change-password-api', $data, function ($message) use ($parameters) {
            $message->from(env('MAIL_ADDRESS', ''), env('MAIL_FROM', ''));
            $message->to($parameters['email'])->subject('Password changed');
        });
    }
}
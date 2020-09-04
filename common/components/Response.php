<?php
/**
 * Created by PhpStorm.
 * User: Darkness
 * Date: 11/30/2016
 * Time: 2:00 PM
 */

namespace common\components;


class Response
{
    public static function getOutputForAPI($data , $status = '', $message = '', $others = array(), $total_page = '')
    {

        $out = array();
        $out['status'] = $status;
        $out['data'] = $data;
        foreach ($others as $key=> $value){
            $out[$key] = $value;
        }
        $out['message'] = $message;
        $out['total_page'] = $total_page;

        return $out;
    }

    public static function getErrorMessage($errors)
    {
        $error_message = 'FAIL';
        $error_array = array();
        foreach ($errors as $field => $messages) {
            foreach ($messages as $message) {
                $error_array[] = $message;
            }
        }
        if (count($error_array) != 0) {
            $error_message = implode('. ', $error_array);
        }
        return $error_message;
    }


    public static function getErrorMsg($code)
    {
        $str = array(

            200 => 'Success',
            201 => 'Fail',
            202 => \Globals::MISSING_PARAMS,
            203 => 'Invalid input',
            204 => 'Token missing',
            205 => \Globals::TOKEN_MISMATCH,
            206 => \Globals::CAN_NOT_PERFORM,
            207 => 'Paid fail',

            221 => 'User not found',
            222 => 'Wrong password',
            223 => 'Email does not exist',
            224 => 'Email or username does not exist',
            225 => 'Email or phone number existed',
            226 => 'Email or username existed',
            227 => 'Current password mismatch',
            228 => 'Your account is not activated',
            229 => 'Fail to send email, please check your email address',
            230 => 'Your account balance is not enough to do this action',
            231 => 'Please update your business profile first',
            232 => 'You another request is pending, please try again later',
            233 => 'Please login by your social network account and change password',
            234 => 'Current password and new password are the same',

            241 => 'Deal not found',
            242 => 'Reservation not found',

            261 => 'Trip not found',
            262 => 'Your driver role is not activated',
            263 => 'Please update your driver profile first',
            264 => 'You need to charge your online duration',

        );
        if($code == 'all')
            return $str;
        else
            return isset($str[$code]) ? $str[$code] : '';
    }
}
<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    function validateAdmin($userCookie, $userSession){
        $userCookie = htmlspecialchars($userCookie);
        $sessionCookie = htmlspecialchars($userSession);

        if(!$userCookie || !$sessionCookie){
            return false;
        }else{
            $admin = Admin::where('name', $userCookie)->first();

            if(!$admin){
                return false;
            }else{
                if($admin->session_token != $sessionCookie){
                    return false;
                }else{
                    return $admin;
                }
            }
        }
    }
}

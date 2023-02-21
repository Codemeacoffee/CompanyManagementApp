<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Redirect;
use App\Incidence;
use App\ExternalIncidence;
use App\ServiceIncidence;

class RootController extends Controller
{
    function access(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin) return redirect('home');
        else return view('index');
    }

    function controlPanel(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $lowerCaseAdmin = strtolower($admin->name);

            $getUnsolvedIncidences = Incidence::query()->where('solved', 0);
            $getUnsolvedExternalIncidences = ExternalIncidence::query()->where('solved', 0);
            $getUnsolvedServiceIncidences = ServiceIncidence::query()->where('solved', 0);

            $getSolvedIncidences = Incidence::query()->where('solved', 1);
            $getSolvedExternalIncidences = ExternalIncidence::query()->where('solved', 1);
            $getSolvedServiceIncidences = ServiceIncidence::query()->where('solved', 1);

            if($admin->elevation != 1){
                $getUnsolvedIncidences = $getUnsolvedIncidences->whereraw('LOWER(informant) = (?)', $lowerCaseAdmin)->orwhere('user', $admin->id);
                $getUnsolvedExternalIncidences = $getUnsolvedExternalIncidences->whereraw('LOWER(informant) = (?)', $lowerCaseAdmin)->orwhere('user', $admin->id);
                $getUnsolvedServiceIncidences = $getUnsolvedServiceIncidences->whereraw('LOWER(informant) = (?)', $lowerCaseAdmin)->orwhere('user', $admin->id);

                $getSolvedIncidences = $getSolvedIncidences->whereraw('LOWER(informant) = (?)', $lowerCaseAdmin)->orwhere('user', $admin->id);
                $getSolvedExternalIncidences = $getSolvedExternalIncidences->whereraw('LOWER(informant) = (?)', $lowerCaseAdmin)->orwhere('user', $admin->id);
                $getSolvedServiceIncidences = $getSolvedServiceIncidences->whereraw('LOWER(informant) = (?)', $lowerCaseAdmin)->orwhere('user', $admin->id);
            }

            $allUnsolvedIncidences = $getUnsolvedIncidences->count();
            $allUnsolvedExternalIncidences = $getUnsolvedExternalIncidences->count();
            $allUnsolvedServiceIncidences = $getUnsolvedServiceIncidences->count();

            $allSolvedIncidences = $getSolvedIncidences->count();
            $allSolvedExternalIncidences = $getSolvedExternalIncidences->count();
            $allSolvedServiceIncidences = $getSolvedServiceIncidences->count();

            $unsolvedIncidences = $allUnsolvedIncidences + $allUnsolvedExternalIncidences + $allUnsolvedServiceIncidences;
            
            $solvedIncidences = $allSolvedIncidences + $allSolvedExternalIncidences + $allSolvedServiceIncidences;

            return view('controlPanel')
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('solvedIncidences', $solvedIncidences)
                ->with('unsolvedIncidences',$unsolvedIncidences)
                ->with('allUnsolvedIncidences',$allUnsolvedIncidences)
                ->with('allUnsolvedExternalIncidences',$allUnsolvedExternalIncidences)
                ->with('allUnsolvedServiceIncidences',$allUnsolvedServiceIncidences);
        }
        else return redirect('/');
    }

    function login(Request $request){
        $user = htmlspecialchars($request['user']);
        $password = htmlspecialchars($request['password']);

        $adminCoincidences = Admin::where('name', $user)->get();

        if(Count($adminCoincidences) > 0){
            foreach ($adminCoincidences as $adminCoincidence){
                if(Hash::check($password, $adminCoincidence['password'])) {
                    try{
                        $sessionToken = bin2hex(random_bytes(mt_rand(10, 25)));
                    }catch(Exception $e){
                        $sessionToken = $this->generateRandomString(mt_rand(20, 50));
                    }

                    $adminCoincidence->session_token = $sessionToken;
                    $adminCoincidence->save();

                    $adminCookie = cookie()->forever('user', $adminCoincidence->name);
                    $sessionCookie = cookie()->forever('sessionToken', $sessionToken);

                    return redirect('home')
                        ->withCookie($adminCookie)
                        ->withCookie($sessionCookie);
                }
            }
        }
        return Redirect::back()->withErrors('Email o Contraseña incorrectos.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Audit;
use App\CheckIn;
use App\CheckOut;
use App\Computer;
use App\Contract;
use App\ExternalIncidence;
use App\Furniture;
use App\Incidence;
use App\Message;
use App\ServiceIncidence;
use App\FormativeAction;
use App\Staff;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    //**************************************************************************  SOLVED INCIDENCES  **************************************************************************//

    function solvedIncidences(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));
        if($admin){
            $lowerCaseAdmin = strtolower($admin->name);

            $allIncidences = Incidence::where('solved',1)->get();
            $allExternalIncidences = ExternalIncidence::where('solved',1)->get();
            $allServiceIncidences = ServiceIncidence::where('solved',1)->get();

            $adminIncidences = [];
            $adminExternalIncidences = [];
            $adminServiceIncidences = [];
            foreach ($allIncidences as $incidence){
                if(strtolower($incidence->informant) == $lowerCaseAdmin) array_push($adminIncidences, $incidence);
            }
            foreach ($allExternalIncidences as $externalIncidence){
                if(strtolower($externalIncidence->informant) == $lowerCaseAdmin) array_push($adminExternalIncidences, $externalIncidence);
            }
            foreach ($allServiceIncidences as $serviceIncidence){
                if(strtolower($serviceIncidence->informant) == $lowerCaseAdmin) array_push($adminServiceIncidences, $serviceIncidence);
            }

            return view('solvedIncidences')
                ->with('incidences', $adminIncidences)
                ->with('externalIncidences', $adminExternalIncidences)
                ->with('serviceIncidences', $adminServiceIncidences)
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'myIncidences');
        }
        return abort(404);
    }


    //**************************************************************************  UNSOLVED INCIDENCES  **************************************************************************//

    function unsolvedIncidences(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));
        if($admin){
            $lowerCaseAdmin = strtolower($admin->name);

            $allIncidences = Incidence::where('solved',0)->get();
            $allExternalIncidences = ExternalIncidence::where('solved',0)->get();
            $allServiceIncidences = ServiceIncidence::where('solved',0)->get();

            $adminIncidences = [];
            $adminExternalIncidences = [];
            $adminServiceIncidences = [];
            foreach ($allIncidences as $incidence){
                if(strtolower($incidence->informant) == $lowerCaseAdmin || $admin->elevation == 1) array_push($adminIncidences, $incidence);
            }
            foreach ($allExternalIncidences as $externalIncidence){
                if(strtolower($externalIncidence->informant) == $lowerCaseAdmin || $admin->elevation == 1) array_push($adminExternalIncidences, $externalIncidence);
            }
            foreach ($allServiceIncidences as $serviceIncidence){
                if(strtolower($serviceIncidence->informant) == $lowerCaseAdmin || $admin->elevation == 1) array_push($adminServiceIncidences, $serviceIncidence);
            }

            return view('unsolvedIncidences')
                ->with('incidences', $adminIncidences)
                ->with('externalIncidences', $adminExternalIncidences)
                ->with('serviceIncidences', $adminServiceIncidences)
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'myIncidences');
        }
        return abort(404);
    }


    //**************************************************************************  INCIDENCES  **************************************************************************//

    function insertIncidence(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation == 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $code = htmlspecialchars($request['code']);
            $incidence = htmlspecialchars($request['incidence']);
            $informant = htmlspecialchars($request['informant']);
            $incidence_date = htmlspecialchars($request['incidence_date']);
            $observations = htmlspecialchars($request['observations']);
            $location = htmlspecialchars($request['location']);

            Incidence::create([
                'code' => $code,
                'incidence' => $incidence,
                'observations' => $observations,
                'location' => $location,
                'informant' => $informant,
                'user' => $admin->id,
                'created' => $incidence_date
            ]);

            return Redirect::back()->with('successMessage', 'Se ha registrado la incidencia "'.$incidence.'".');
        }
        return abort(404);
    }

    function allIncidences(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin->elevation != 1 && $admin->elevation != 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

        if($admin) return view('incidences')
            ->with('incidences', Incidence::orderBy('id', 'DESC')->get())
            ->with('adminData', [$admin->name, $admin->elevation])
            ->with('page', 'incidences');
        return abort(404);
    }
    
    function unsolvedTableIncidences(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin->elevation != 1 && $admin->elevation != 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

        if($admin) return view('incidences')
            ->with('incidences', Incidence::where('solved', 0)->orderBy('id', 'DESC')->get())
            ->with('adminData', [$admin->name, $admin->elevation])
            ->with('page', 'incidences')
            ->with('unsolved' ,'');
        return abort(404);
    }

    function editIncidence(Request $request, $id){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($id);

            $incidence = Incidence::where('id', $id)->first();

            if($incidence){
                if($admin->elevation != 1 && $admin->elevation != 4 && strtolower($incidence->informant) != strtolower($admin->name)) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                return view('editIncidence')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('incidence', $incidence)
                    ->with('page', 'incidences');
            }

        }
        return abort(404);
    }

    function modifyIncidence(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['incidenceId']);

            $incidence = Incidence::where('id', $id)->first();

            if($incidence){
                if($admin->elevation != 1 && $admin->elevation != 4 && strtolower($incidence->informant) != strtolower($admin->name)) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');
                
                $solved = $request['solved_incidence_date'];
                if($request['solved_incidence_date'] == '' && $request['solved'] == 1 && $incidence->solved == 0) $solved = date('Y-m-d');
                if($request['solved_incidence_date'] == '' && $request['solved'] == 0 && $incidence->solved == 0) $solved = null;

                $incidence->code = htmlspecialchars($request['code']);
                $incidence->incidence = htmlspecialchars($request['incidence']);
                $incidence->created = htmlspecialchars($request['incidence_date']);
                $incidence->updated = $solved;
                $incidence->observations = htmlspecialchars($request['observations']);
                $incidence->location = htmlspecialchars($request['location']);
                $incidence->solved = htmlspecialchars($request['solved']);
                $incidence->solution = htmlspecialchars($request['solution']);

                $incidence->save();

                return Redirect::back()->with('successMessage', 'Se ha modificado la incidencia "'.$incidence->incidence.'".');
            }
        }
        return abort(404);
    }
    
    function resolveIncidence(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['incidenceId']);

            $incidence = Incidence::where('id', $id)->first();

            if($incidence){
                if($admin->elevation != 1 && $admin->elevation != 4 && strtolower($incidence->informant) != strtolower($admin->name)) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');
                
                $solved = $request['solved_incidence_date'];
                if($request['solved_incidence_date'] == '' && $incidence->solved == 0) $solved = date('Y-m-d');

                $incidence->code = htmlspecialchars($request['code']);
                $incidence->incidence = htmlspecialchars($request['incidence']);
                $incidence->created = htmlspecialchars($request['incidence_date']);
                $incidence->updated = $solved;
                $incidence->observations = htmlspecialchars($request['observations']);
                $incidence->location = htmlspecialchars($request['location']);
                $incidence->solved = 1;
                $incidence->solution = htmlspecialchars($request['solution']);

                $incidence->save();
                
                return Redirect::to('viewUnsolvedTableIncidences')->with('successMessage', 'Se ha modificado la incidencia "'.$incidence->incidence.'".');
            }
        }
        return abort(404);
    }

    function removeIncidence(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
          $id = htmlspecialchars($request['incidenceId']);

          $incidence = Incidence::where('id', $id)->first();

          if($incidence){
              if($admin->elevation != 1 && strtolower($incidence->informant) != strtolower($admin->name)) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

              $incidence->delete();

              return Redirect::to('viewIncidences')->with('successMessage', 'Se ha borrado la incidencia "'.$incidence->incidence.'".');
          }
        }
        return abort(404);
    }

    //**************************************************************************  COMPUTERS  **************************************************************************//

    function insertComputer(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){

            if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $code = htmlspecialchars($request['code']);
            $name = htmlspecialchars($request['name']);
            $brand = htmlspecialchars($request['brand']);
            $model = htmlspecialchars($request['model']);
            $serial = htmlspecialchars($request['serial']);
            $ip = htmlspecialchars($request['ip']);
            $processor = htmlspecialchars($request['processor']);
            $memory = htmlspecialchars($request['memory']);
            $hardDrive = htmlspecialchars($request['hardDrive']);
            $operatingSystem = htmlspecialchars($request['operatingSystem']);
            $CD_ROM = htmlspecialchars($request['CD_ROM']);
            $status = htmlspecialchars($request['status']);
            $location = htmlspecialchars($request['location']);
            $originalPlacement = htmlspecialchars($request['originalPlacement']);
            $currentPlacement = htmlspecialchars($request['currentPlacement']);
            $observations = htmlspecialchars($request['observations']);
            $deceased = htmlspecialchars($request['deceased']);
            $deceaseDate = htmlspecialchars($request['deceaseDate']);
            $warranty = htmlspecialchars($request['warranty']);
            $warrantyEndDate = htmlspecialchars($request['warrantyEndDate']);
            $provider = htmlspecialchars($request['provider']);
            $gateway = htmlspecialchars($request['gateway']);
            $DNS1 = htmlspecialchars($request['DNS1']);
            $DNS2 = htmlspecialchars($request['DNS2']);
            $purchaseDate = htmlspecialchars($request['purchaseDate']);
            $activationKey = htmlspecialchars($request['activationKey']);

            Computer::create([
                'code' => $code,
                'name' => $name,
                'brand' => $brand,
                'model' => $model,
                'serial' => $serial,
                'ip' => $ip,
                'processor' => $processor,
                'memory' => $memory,
                'hardDrive' => $hardDrive,
                'operatingSystem' => $operatingSystem,
                'CD_ROM' => $CD_ROM,
                'status' => $status,
                'location' => $location,
                'originalPlacement' => $originalPlacement,
                'currentPlacement' => $currentPlacement,
                'observations' => $observations,
                'deceased' => $deceased,
                'deceaseDate' => $deceaseDate,
                'warranty' => $warranty,
                'warrantyEndDate' => $warrantyEndDate,
                'provider' => $provider,
                'gateway' => $gateway,
                'DNS1' => $DNS1,
                'DNS2' => $DNS2,
                'purchaseDate' => $purchaseDate,
                'activationKey' => $activationKey,
            ]);

            return Redirect::back()->with('successMessage', 'Se ha registrado el equipo "'.$code.'".');
        }
        return abort(404);
    }

    function allComputers(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

        if($admin) return view('computers')
            ->with('computers', Computer::orderBy('id', 'DESC')->get())
            ->with('adminData', [$admin->name, $admin->elevation])
            ->with('page', 'computers');
        return abort(404);
    }
    
    function autoCompleteComputer(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

        if($admin) {
            $computers = Computer::orderBy('id', 'DESC')->where('code', 'LIKE', '%'.htmlspecialchars($request['code']).'%')->get();
            // $results = '<ul class="listaCompletar list-unstyled">';
            $results = '';

            if(count($computers) == 0){
                $results = '<div>Sin resultados.</div>';
                return json_encode($results);
            }
            
            foreach($computers as $computer){
                $computerCode = "'".$computer['code']."'";
                $computerCurrentPlacement = "'".$computer['currentPlacement']."'";
                $computerId = "'".$computer['id']."'";
                $results .= '<div class="suggest-element" onClick="selectSuggestion('.$computerCode.', '.$computerCurrentPlacement.', '.$computerId.')">'.$computer['code'].'</div>';
            }
    
            // $results .= '</ul>';
            return json_encode($results);
        }
        return abort(404);
    }


    function editComputer(Request $request, $id){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $id = htmlspecialchars($id);

            $computer = Computer::where('id', $id)->first();

            if($computer)
                $incidences = Incidence::where('code', $computer->code)->get();

                $view = view('editComputer')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('computer', $computer)
                    ->with('page', 'computers');

                if(count($incidences)>0) $view = $view->with('incidences', $incidences);

                return $view;
        }
        return abort(404);
    }

    function modifyComputer(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $id = htmlspecialchars($request['computerId']);

            $computer = Computer::where('id', $id)->first();

            if($computer){
                $computer->code = htmlspecialchars($request['code']);
                $computer->name = htmlspecialchars($request['name']);
                $computer->brand = htmlspecialchars($request['brand']);
                $computer->model = htmlspecialchars($request['model']);
                $computer->serial = htmlspecialchars($request['serial']);
                $computer->ip = htmlspecialchars($request['ip']);
                $computer->processor = htmlspecialchars($request['processor']);
                $computer->memory = htmlspecialchars($request['memory']);
                $computer->hardDrive = htmlspecialchars($request['hardDrive']);
                $computer->operatingSystem = htmlspecialchars($request['operatingSystem']);
                $computer->CD_ROM = htmlspecialchars($request['CD_ROM']);
                $computer->status = htmlspecialchars($request['status']);
                $computer->location = htmlspecialchars($request['location']);
                $computer->originalPlacement = htmlspecialchars($request['originalPlacement']);
                $computer->currentPlacement = htmlspecialchars($request['currentPlacement']);
                $computer->observations = htmlspecialchars($request['observations']);
                $computer->deceased = htmlspecialchars($request['deceased']);
                $computer->deceaseDate = htmlspecialchars($request['deceaseDate']);
                $computer->warranty = htmlspecialchars($request['warranty']);
                $computer->warrantyEndDate = htmlspecialchars($request['warrantyEndDate']);
                $computer->provider = htmlspecialchars($request['provider']);
                $computer->gateway = htmlspecialchars($request['gateway']);
                $computer->DNS1 = htmlspecialchars($request['DNS1']);
                $computer->DNS2 = htmlspecialchars($request['DNS2']);
                $computer->purchaseDate = htmlspecialchars($request['purchaseDate']);
                $computer->activationKey = htmlspecialchars($request['activationKey']);

                $computer->save();

                return Redirect::back()->with('successMessage', 'Se ha modificado el equipo "'.$computer->code.'".');
            }
        }
        return abort(404);
    }
    
    function editPlacementComputers(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('editPlacementComputer')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('page', 'computers');
        }
        return abort(404);
    }
    
    function moveComputer(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $computerId = htmlspecialchars($request['computerId']);
            $code = htmlspecialchars($request['code']);
            $currentPlacement = htmlspecialchars($request['currentPlacement']);
            
            $computer = Computer::where('id', $computerId)->first();
            
            $computer->currentPlacement = $currentPlacement;
            $computer->save();

            // Computer::where('code', $computerId)->update(['currentPlacement' => $currentPlacement]);

            return Redirect::back()->with('successMessage', 'Se ha modificado el equipo "'.$code.'".');
            
        }
        return abort(404);
    }

    function removeComputer(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $id = htmlspecialchars($request['computerId']);

            $computer = Computer::where('id', $id)->first();

            if($computer){
                $computer->delete();

                return Redirect::to('viewComputers')->with('successMessage', 'Se ha borrado el equipo "'.$computer->code.'".');
            }
        }
        return abort(404);
    }

    //**************************************************************************  AUDITS  **************************************************************************//

    function insertAudit(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $location = htmlspecialchars($request['location']);
            $date = htmlspecialchars($request['date']);
            $placement = htmlspecialchars($request['placement']);
            $cause = htmlspecialchars($request['cause']);
            $observations = htmlspecialchars($request['observations']);

            Audit::create([
                'location' => $location,
                'date' => $date,
                'placement' => $placement,
                'cause' => $cause,
                'observations' => $observations,
            ]);

            return Redirect::back()->with('successMessage', 'Se ha registrado la auditoría.');
        }
        return abort(404);
    }

    function allAudits(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('audits')
                ->with('audits', Audit::orderBy('id', 'DESC')->get())
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'audits');
        }
        return abort(404);
    }

    function editAudit(Request $request, $id){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $id = htmlspecialchars($id);

            $audit = Audit::where('id', $id)->first();

            if($audit)
                return view('editAudit')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('audit', $audit)
                    ->with('page', 'audits');
        }
        return abort(404);
    }

    function modifyAudit(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $id = htmlspecialchars($request['auditId']);

            $audit = Audit::where('id', $id)->first();

            if($audit){
                $audit->location = htmlspecialchars($request['location']);
                $audit->placement = htmlspecialchars($request['placement']);
                $audit->date = htmlspecialchars($request['date']);
                $audit->cause = htmlspecialchars($request['cause']);
                $audit->observations = htmlspecialchars($request['observations']);

                $audit->save();

                return Redirect::back()->with('successMessage', 'Se ha modificado la auditoría.');
            }
        }
        return abort(404);
    }

    function removeAudit(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $id = htmlspecialchars($request['auditId']);

            $audit = Audit::where('id', $id)->first();

            if($audit){
                $audit->delete();

                return Redirect::to('viewAudits')->with('successMessage', 'Se ha borrado la auditoría.');
            }
        }
        return abort(404);
    }

    //**************************************************************************  EXTERNAL INCIDENCES  **************************************************************************//

    function insertExternalIncidence(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation == 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $incidence = htmlspecialchars($request['incidence']);
            $incidence_date = htmlspecialchars($request['incidence_date']);
            $informant = htmlspecialchars($request['informant']);
            $location = htmlspecialchars($request['location']);
            $contact = htmlspecialchars($request['contact']);
            $responsible = htmlspecialchars($request['responsible']);

            ExternalIncidence::create([
                'incidence' => $incidence,
                'location' => $location,
                'contact' => $contact,
                'responsible' => $responsible,
                'informant' => $informant,
                'user' => $admin->id,
                'created' => $incidence_date
            ]);

            return Redirect::back()->with('successMessage', 'Se ha registrado la incidencia "'.$incidence.'".');
        }
        return abort(404);
    }
    
    function allExternalIncidences(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1 && $admin->elevation != 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('externalIncidences')
                ->with('externalIncidences', ExternalIncidence::orderBy('id', 'DESC')->get())
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'externalIncidences');
        }
        return abort(404);
    }
    
    function unsolvedExternalIncidences(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1 && $admin->elevation != 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('externalIncidences')
                ->with('externalIncidences', ExternalIncidence::where('solved',0)->orderBy('id', 'DESC')->get())
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'externalIncidences')
                ->with('unsolved' ,'');
        }
        return abort(404);
    }

    function editExternalIncidence(Request $request, $id){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($id);

            $externalIncidence = ExternalIncidence::where('id', $id)->first();

            if($externalIncidence){
                if($admin->elevation != 1 && $admin->elevation != 4 && strtolower($externalIncidence->informant) != strtolower($admin->name)) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                return view('editExternalIncidence')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('externalIncidence', $externalIncidence)
                    ->with('page', 'externalIncidences');
            }
        }
        return abort(404);
    }

    function modifyExternalIncidence(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['externalIncidenceId']);

            $externalIncidence = ExternalIncidence::where('id', $id)->first();

            if($externalIncidence){
                if($admin->elevation != 1 && $admin->elevation != 4 && strtolower($externalIncidence->informant) != strtolower($admin->name)) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $solved = $request['solved_incidence_date'];
                if($request['solved_incidence_date'] == '' && $request['solved'] == 1 && $externalIncidence->solved == 0) $solved = date('Y-m-d');
                if($request['solved_incidence_date'] == '' && $request['solved'] == 0 && $externalIncidence->solved == 0) $solved = null;

                $externalIncidence->incidence = htmlspecialchars($request['incidence']);
                $externalIncidence->created = htmlspecialchars($request['incidence_date']);
                $externalIncidence->updated = $solved;
                $externalIncidence->location = htmlspecialchars($request['location']);
                $externalIncidence->contact = htmlspecialchars($request['contact']);
                $externalIncidence->responsible = htmlspecialchars($request['responsible']);
                $externalIncidence->solved = htmlspecialchars($request['solved']);
                $externalIncidence->solution = htmlspecialchars($request['solution']);

                $externalIncidence->save();

                return Redirect::back()->with('successMessage', 'Se ha modificado la incidencia "'.$externalIncidence->incidence.'".');
            }
        }
        return abort(404);
    }
    
    function resolveExternalIncidence(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['externalIncidenceId']);

            $externalIncidence = ExternalIncidence::where('id', $id)->first();

            if($externalIncidence){
                if($admin->elevation != 1 && $admin->elevation != 4 && strtolower($externalIncidence->informant) != strtolower($admin->name)) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $solved = $request['solved_incidence_date'];
                if($request['solved_incidence_date'] == '' && $externalIncidence->solved == 0) $solved = date('Y-m-d');

                $externalIncidence->incidence = htmlspecialchars($request['incidence']);
                $externalIncidence->created = htmlspecialchars($request['incidence_date']);
                $externalIncidence->updated = $solved;
                $externalIncidence->location = htmlspecialchars($request['location']);
                $externalIncidence->contact = htmlspecialchars($request['contact']);
                $externalIncidence->responsible = htmlspecialchars($request['responsible']);
                $externalIncidence->solved = 1;
                $externalIncidence->solution = htmlspecialchars($request['solution']);

                $externalIncidence->save();
                
                return Redirect::to('viewUnsolvedExternalIncidences')->with('successMessage', 'Se ha modificado la incidencia "'.$externalIncidence->incidence.'".');
            }
        }
        return abort(404);
    }

    function removeExternalIncidence(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['externalIncidenceId']);

            $externalIncidence = ExternalIncidence::where('id', $id)->first();

            if($externalIncidence){
                if($admin->elevation != 1 && strtolower($externalIncidence->informant) != strtolower($admin->name)) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $externalIncidence->delete();

                return Redirect::to('viewExternalIncidences')->with('successMessage', 'Se ha borrado la incidencia "'.$externalIncidence->incidence.'".');
            }
        }
        return abort(404);
    }

    //**************************************************************************  SERVICE INCIDENCES  **************************************************************************//

    function insertServiceIncidence(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation == 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $incidence = htmlspecialchars($request['incidence']);
            $incidence_date = htmlspecialchars($request['incidence_date']);
            $informant = htmlspecialchars($request['informant']);
            $location = htmlspecialchars($request['location']);
            $responsible = htmlspecialchars($request['responsible']);

            ServiceIncidence::create([
                'incidence' => $incidence,
                'location' => $location,
                'responsible' => $responsible,
                'informant' => $informant,
                'user' => $admin->id,
                'created' => $incidence_date
            ]);

            return Redirect::back()->with('successMessage', 'Se ha registrado la incidencia "'.$incidence.'".');
        }
        return abort(404);
    }

    function allServiceIncidences(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1 && $admin->elevation != 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('serviceIncidences')
                ->with('serviceIncidences', ServiceIncidence::orderBy('id', 'DESC')->get())
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'serviceIncidences');
        }
        return abort(404);
    }
    
    function unsolvedServiceIncidences(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1 && $admin->elevation != 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('serviceIncidences')
                ->with('serviceIncidences', ServiceIncidence::where('solved',0)->orderBy('id', 'DESC')->get())
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'serviceIncidences')
                ->with('unsolved' ,'');
        }
        return abort(404);
    }

    function editServiceIncidence(Request $request, $id){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($id);

            $serviceIncidence = ServiceIncidence::where('id', $id)->first();

            if($serviceIncidence){
                if($admin->elevation != 1 && $admin->elevation != 4 && strtolower($serviceIncidence->informant) != strtolower($admin->name)) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                return view('editServiceIncidence')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('serviceIncidence', $serviceIncidence)
                    ->with('page', 'serviceIncidences');
            }
        }
        return abort(404);
    }

    function modifyServiceIncidence(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['serviceIncidenceId']);

            $serviceIncidence = ServiceIncidence::where('id', $id)->first();

            if($serviceIncidence){
                if($admin->elevation != 1 && $admin->elevation != 4 && strtolower($serviceIncidence->informant) != strtolower($admin->name)) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $solved = $request['solved_incidence_date'];
                if($request['solved_incidence_date'] == '' && $request['solved'] == 1 && $serviceIncidence->solved == 0) $solved = date('Y-m-d');
                if($request['solved_incidence_date'] == '' && $request['solved'] == 0 && $serviceIncidence->solved == 0) $solved = null;

                $serviceIncidence->incidence = htmlspecialchars($request['incidence']);
                $serviceIncidence->created = htmlspecialchars($request['incidence_date']);
                $serviceIncidence->updated = $solved;
                $serviceIncidence->location = htmlspecialchars($request['location']);
                $serviceIncidence->responsible = htmlspecialchars($request['responsible']);
                $serviceIncidence->solved = htmlspecialchars($request['solved']);
                $serviceIncidence->solution = htmlspecialchars($request['solution']);

                $serviceIncidence->save();

                return Redirect::back()->with('successMessage', 'Se ha modificado la incidencia "'.$serviceIncidence->incidence.'".');
            }
        }
        return abort(404);
    }
    
    function resolveServiceIncidence(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['serviceIncidenceId']);

            $serviceIncidence = ServiceIncidence::where('id', $id)->first();

            if($serviceIncidence){
                if($admin->elevation != 1 && $admin->elevation != 4 && strtolower($serviceIncidence->informant) != strtolower($admin->name)) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $solved = $request['solved_incidence_date'];
                if($request['solved_incidence_date'] == '' && $serviceIncidence->solved == 0) $solved = date('Y-m-d');

                $serviceIncidence->incidence = htmlspecialchars($request['incidence']);
                $serviceIncidence->created = htmlspecialchars($request['incidence_date']);
                $serviceIncidence->updated = $solved;
                $serviceIncidence->location = htmlspecialchars($request['location']);
                $serviceIncidence->responsible = htmlspecialchars($request['responsible']);
                $serviceIncidence->solved = 1;
                $serviceIncidence->solution = htmlspecialchars($request['solution']);

                $serviceIncidence->save();
                
                return Redirect::to('viewUnsolvedServiceIncidences')->with('successMessage', 'Se ha modificado la incidencia "'.$serviceIncidence->incidence.'".');
            }
        }
        return abort(404);
    }

    function removeServiceIncidence(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['serviceIncidenceId']);

            $serviceIncidence = ServiceIncidence::where('id', $id)->first();

            if($serviceIncidence){
                if($admin->elevation != 1 && strtolower($serviceIncidence->informant) != strtolower($admin->name)) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $serviceIncidence->delete();

                return Redirect::to('viewServiceIncidences')->with('successMessage', 'Se ha borrado la incidencia "'.$serviceIncidence->incidence.'".');
            }
        }
        return abort(404);
    }

    //**************************************************************************  FURNITURE  **************************************************************************//

    function insertFurniture(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $code = htmlspecialchars($request['code']);
            $location = htmlspecialchars($request['location']);
            $amount = htmlspecialchars($request['amount']);
            $status = htmlspecialchars($request['status']);
            $observations = htmlspecialchars($request['observations']);
            $originalPlacement = htmlspecialchars($request['originalPlacement']);
            $currentPlacement = htmlspecialchars($request['currentPlacement']);

            Furniture::create([
                'code' => $code,
                'location' => $location,
                'amount' => $amount,
                'status' => $status,
                'observations' => $observations,
                'originalPlacement' => $originalPlacement,
                'currentPlacement' => $currentPlacement,
            ]);

            return Redirect::back()->with('successMessage', 'Se ha registrado el mobiliario "'.$code.'".');
        }
        return abort(404);
    }

    function allFurniture(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('furniture')
                ->with('furniture', Furniture::orderBy('id', 'DESC')->get())
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'furniture');
        }
        return abort(404);
    }

    function editFurniture(Request $request, $id){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($id);

            $furniture = Furniture::where('id', $id)->first();

            if($furniture){
                if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                return view('editFurniture')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('furniture', $furniture)
                    ->with('page', 'furniture');
            }
        }
        return abort(404);
    }

    function modifyFurniture(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['furnitureId']);

            $furniture = Furniture::where('id', $id)->first();

            if($furniture){
                if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $furniture->code = htmlspecialchars($request['code']);
                $furniture->location = htmlspecialchars($request['location']);
                $furniture->amount = htmlspecialchars($request['amount']);
                $furniture->status = htmlspecialchars($request['status']);
                $furniture->observations = htmlspecialchars($request['observations']);
                $furniture->originalPlacement = htmlspecialchars($request['originalPlacement']);
                $furniture->currentPlacement = htmlspecialchars($request['currentPlacement']);

                $furniture->save();

                return Redirect::back()->with('successMessage', 'Se ha modificado el mobiliario "'.$furniture->code.'".');
            }
        }
        return abort(404);
    }

    function removeFurniture(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['furnitureId']);

            $furniture = Furniture::where('id', $id)->first();

            if($furniture){
                if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $furniture->delete();

                return Redirect::to('viewFurniture')->with('successMessage', 'Se ha borrado el mobiliario "'.$furniture->code.'".');
            }
        }
        return abort(404);
    }

    //**************************************************************************  RESERVED LIST  **************************************************************************//

    function insertReservedList(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $name = htmlspecialchars($request['name']);
            $type = htmlspecialchars($request['type']);
            $email = htmlspecialchars($request['email']);
            $phone = htmlspecialchars($request['phone']);
            $location = htmlspecialchars($request['location']);
            $content = htmlspecialchars($request['content']);
            $info = htmlspecialchars($request['info']);
            $status = htmlspecialchars($request['status']);

            Subscriber::create([
                'name' => $name,
                'type' => $type,
                'email' => $email,
                'phone' => $phone,
                'location' => $location,
                'entity' => 'Fuerteventura2000',
                'content' => $content,
                'info' => $info,
                'status' => $status
            ]);

            return Redirect::back()->with('successMessage', 'Se ha registrado el '.$type.' "'.$name.'".');
        }
        return abort(404);
    }

    function allReservedList(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin) {
            if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('reservedList')
                ->with('reservedList', Subscriber::orderBy('id', 'DESC')->get())
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'reservedList');
        }
        return abort(404);
    }

    function limitedReservedList(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('reservedList')
                ->with('reservedList', Subscriber::orderBy('id', 'DESC')->paginate(1000))
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('limited', true)
                ->with('page', 'reservedList');
        }
        return abort(404);
    }

    function editReservedList(Request $request, $id){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($id);

            $reservedList = Subscriber::where('id', $id)->first();

            if($reservedList){
                if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                return view('editReservedList')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('reservedList', $reservedList)
                    ->with('page', 'reservedList');
            }
        }
        return abort(404);
    }

    function modifyReservedList(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['reservedListId']);

            $reservedList = Subscriber::where('id', $id)->first();

            if($reservedList){
                if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $reservedList->name = htmlspecialchars($request['name']);
                $reservedList->type = htmlspecialchars($request['type']);
                $reservedList->email = htmlspecialchars($request['email']);
                $reservedList->phone = htmlspecialchars($request['phone']);
                $reservedList->location = htmlspecialchars($request['location']);
                $reservedList->content = htmlspecialchars($request['content']);
                $reservedList->info = htmlspecialchars($request['info']);
                $reservedList->status = htmlspecialchars($request['status']);

                $reservedList->save();

                return Redirect::back()->with('successMessage', 'Se ha modificado el '.$reservedList->type.' "'.$reservedList->name.'".');
            }
        }
        return abort(404);
    }

    function removeReservedList(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['reservedListId']);

            $reservedList = Subscriber::where('id', $id)->first();

            if($reservedList){
                if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $reservedList->delete();

                return Redirect::to('viewLimitedReservedList')->with('successMessage', 'Se ha borrado el '.$reservedList->type.' "'.$reservedList->name.'".');
            }
        }
        return abort(404);
    }


    //**************************************************************************  FORMATIVE ACTION  **************************************************************************//

    function insertFormativeAction(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $name = htmlspecialchars($request['name']);
            $type = htmlspecialchars($request['type']);
            $speciality = htmlspecialchars($request['speciality']);
            $year = htmlspecialchars($request['year']);
            $closed = htmlspecialchars($request['closed']);

            FormativeAction::create([
                'name' => $name,
                'type' => $type,
                'speciality' => $speciality,
                'year' => $year,
                'closed' => $closed,
            ]);

            return Redirect::back()->with('successMessage', 'Se ha registrado la acción formativa "'.$name.'".');
        }
        return abort(404);
    }

    function allFormativeAction(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('formativeAction')
                ->with('formativeActions', FormativeAction::orderBy('id', 'DESC')->get())
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'formativeAction');
        }
        return abort(404);
    }

    function editFormativeAction(Request $request, $id){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($id);

            $formativeAction = FormativeAction::where('id', $id)->first();

            if($formativeAction){
                if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                return view('editFormativeAction')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('formativeAction', $formativeAction)
                    ->with('page', 'furniture');
            }
        }
        return abort(404);
    }

    function modifyFormativeAction(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['formativeActionId']);

            $formativeAction = FormativeAction::where('id', $id)->first();

            if($formativeAction){
                if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $formativeAction->name = htmlspecialchars($request['name']);
                $formativeAction->type = htmlspecialchars($request['type']);
                $formativeAction->speciality = htmlspecialchars($request['speciality']);
                $formativeAction->year = htmlspecialchars($request['year']);
                $formativeAction->closed = htmlspecialchars($request['closed']);

                $formativeAction->save();

                return Redirect::back()->with('successMessage', 'Se ha modificado la acción formativa "'.$formativeAction->name.'".');
            }
        }
        return abort(404);
    }

    function removeFormativeAction(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['formativeActionId']);

            $formativeAction = FormativeAction::where('id', $id)->first();

            if($formativeAction){
                if($admin->elevation > 4) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $formativeAction->delete();

                return Redirect::to('viewFormativeAction')->with('successMessage', 'Se ha borrado la acción formativa "'.$formativeAction->name.'".');
            }
        }
        return abort(404);
    }

    //**************************************************************************  CHECK IN  **************************************************************************//

    function insertCheckIn(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1 && $admin->elevation != 3) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $receiver = htmlspecialchars($request['receiver']);
            $entry_code = htmlspecialchars($request['entry_code']);
            $agency = htmlspecialchars($request['agency']);
            $document = htmlspecialchars($request['document']);
            $date = htmlspecialchars($request['date']);
            $destination = htmlspecialchars($request['destination']);
            $sender = htmlspecialchars($request['sender']);

            CheckIn::create([
                'receiver' => $receiver,
                'entry_code' => $entry_code,
                'agency' => $agency,
                'document' => $document,
                'date' => $date,
                'destination' => $destination,
                'sender' => $sender,
            ]);

            return Redirect::back()->with('successMessage', 'Se ha añadido el registro de entrada "'.$entry_code.'".');
        }
        return abort(404);
    }

    function allCheckIn(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1 && $admin->elevation != 3) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('checkIn')
                ->with('checkIns', CheckIn::orderBy('id', 'DESC')->get())
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'checkIn');
        }
        return abort(404);
    }

    function editCheckIn(Request $request, $id){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($id);

            $checkIn = CheckIn::where('id', $id)->first();

            if($checkIn){
                if($admin->elevation != 1 && $admin->elevation != 3) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                return view('editCheckIn')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('checkIn', $checkIn)
                    ->with('page', 'checkIn');
            }
        }
        return abort(404);
    }

    function modifyCheckIn(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['checkInId']);

            $checkIn = CheckIn::where('id', $id)->first();

            if($checkIn){
                if($admin->elevation != 1 && $admin->elevation != 3) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $checkIn->receiver = htmlspecialchars($request['receiver']);
                $checkIn->entry_code = htmlspecialchars($request['entry_code']);
                $checkIn->document = htmlspecialchars($request['document']);
                $checkIn->date = htmlspecialchars($request['date']);
                $checkIn->destination = htmlspecialchars($request['destination']);
                $checkIn->sender = htmlspecialchars($request['sender']);

                $checkIn->save();

                return Redirect::back()->with('successMessage', 'Se ha modificado el registro de entrada "'.$checkIn->entry_code.'".');
            }
        }
        return abort(404);
    }

    function removeCheckIn(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['checkInId']);

            $checkIn = CheckIn::where('id', $id)->first();

            if($checkIn){
                if($admin->elevation != 1 && $admin->elevation != 3) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $checkIn->delete();

                return Redirect::to('viewCheckIn')->with('successMessage', 'Se ha borrado el registro de entrada "'.$checkIn->entry_code.'".');
            }
        }
        return abort(404);
    }

    //**************************************************************************  CHECK OUT  **************************************************************************//

    function insertCheckOut(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1 && $admin->elevation != 3) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $receiver = htmlspecialchars($request['receiver']);
            $exit_code = htmlspecialchars($request['exit_code']);
            $document = htmlspecialchars($request['document']);
            $date = htmlspecialchars($request['date']);
            $destination = htmlspecialchars($request['destination']);
            $sender = htmlspecialchars($request['sender']);

            CheckOut::create([
                'receiver' => $receiver,
                'exit_code' => $exit_code,
                'document' => $document,
                'date' => $date,
                'destination' => $destination,
                'sender' => $sender,
            ]);

            return Redirect::back()->with('successMessage', 'Se ha registrado el registro de salida "'.$exit_code.'".');
        }
        return abort(404);
    }

    function limitedCheckOut(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1 && $admin->elevation != 3) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('checkOut')
                ->with('checkOuts', CheckOut::orderBy('id', 'DESC')->paginate(1000))
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('limited', true)
                ->with('page', 'checkOut');
        }
        return abort(404);
    }

    function allCheckOut(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation != 1 && $admin->elevation != 3) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('checkOut')
                ->with('checkOuts', CheckOut::orderBy('id', 'DESC')->get())
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'checkOut');
        }
        return abort(404);
    }

    function editCheckOut(Request $request, $id){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($id);

            $checkOut = CheckOut::where('id', $id)->first();

            if($checkOut){
                if($admin->elevation != 1 && $admin->elevation != 3) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                return view('editCheckOut')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('checkOut', $checkOut)
                    ->with('page', 'checkOut');
            }
        }
        return abort(404);
    }

    function modifyCheckOut(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['checkOutId']);

            $checkOut = CheckOut::where('id', $id)->first();

            if($checkOut){
                if($admin->elevation != 1 && $admin->elevation != 3) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $checkOut->receiver = htmlspecialchars($request['receiver']);
                $checkOut->exit_code = htmlspecialchars($request['exit_code']);
                $checkOut->document = htmlspecialchars($request['document']);
                $checkOut->date = htmlspecialchars($request['date']);
                $checkOut->destination = htmlspecialchars($request['destination']);
                $checkOut->sender = htmlspecialchars($request['sender']);

                $checkOut->save();

                return Redirect::back()->with('successMessage', 'Se ha modificado el registro de salida "'.$checkOut->exit_code.'".');
            }
        }
        return abort(404);
    }

    function removeCheckOut(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['checkOutId']);

            $checkOut = CheckOut::where('id', $id)->first();

            if($checkOut){
                if($admin->elevation != 1 && $admin->elevation != 3) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $checkOut->delete();

                return Redirect::to('viewLimitedCheckOut')->with('successMessage', 'Se ha borrado el registro de salida "'.$checkOut->exit_code.'".');
            }
        }
        return abort(404);
    }

    //**************************************************************************  STAFF  **************************************************************************//

    function insertStaff(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation > 3 && $admin->elevation != 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $name = htmlspecialchars($request['name']);
            $address = htmlspecialchars($request['address']);
            $city = htmlspecialchars($request['city']);
            $nif= htmlspecialchars($request['nif']);
            $social_security= htmlspecialchars($request['social_security']);
            $postal_code = htmlspecialchars($request['postal_code']);
            $birth_date = htmlspecialchars($request['birth_date']);
            $phone = htmlspecialchars($request['phone']);
            $bank = htmlspecialchars($request['bank']);
            $CC = htmlspecialchars($request['CC']);
            $marital_status = htmlspecialchars($request['marital_status']);
            $children = htmlspecialchars($request['children']);
            $email = htmlspecialchars($request['email']);

            if(strlen($children)<1) $children = 0;

            Staff::create([
                'name' => encrypt($name),
                'address' => encrypt($address),
                'city' => encrypt($city),
                'nif' => encrypt($nif),
                'social_security' => encrypt($social_security),
                'postal_code' => encrypt($postal_code),
                'birth_date' => encrypt($birth_date),
                'phone' => encrypt($phone),
                'bank' => encrypt($bank),
                'CC' => encrypt($CC),
                'marital_status' => encrypt($marital_status),
                'children' => encrypt($children),
                'email' => encrypt($email),
            ]);

            return Redirect::back()->with('successMessage', 'Se han añadido los datos de"'.$name.'".');
        }
        return abort(404);
    }

    function allStaff(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation > 3 && $admin->elevation != 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            return view('staff')
                ->with('staffs', Staff::orderBy('id', 'DESC')->exclude(['address', 'nif', 'social_security', 'phone', 'bank', 'CC', 'marital_status', 'children'])->get())
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'staff');
        }
        return abort(404);
    }

    function editStaff(Request $request, $id){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($id);

            $staff = Staff::where('id', $id)->first();

            if($staff){
                if($admin->elevation > 3 && $admin->elevation != 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $contracts = Contract::all();
                $staffContracts = [];

                foreach ($contracts as $contract){
                    if(decrypt($contract->teacher_nif) == decrypt($staff->nif)) array_push($staffContracts, $contract);
                }
                return view('editStaff')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('staff', $staff)
                    ->with('contracts', $staffContracts)
                    ->with('page', 'staff');
            }
        }
        return abort(404);
    }

    function modifyStaff(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['staffId']);

            $staff = Staff::where('id', $id)->first();

            if($staff){
                if($admin->elevation > 3 && $admin->elevation != 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $staff->name = encrypt(htmlspecialchars($request['name']));
                $staff->address = encrypt(htmlspecialchars($request['address']));
                $staff->city = encrypt(htmlspecialchars($request['city']));
                $staff->nif= encrypt(htmlspecialchars($request['nif']));
                $staff->social_security= encrypt(htmlspecialchars($request['social_security']));
                $staff->postal_code = encrypt(htmlspecialchars($request['postal_code']));
                $staff->birth_date = encrypt(htmlspecialchars($request['birth_date']));
                $staff->phone = encrypt(htmlspecialchars($request['phone']));
                $staff->bank = encrypt(htmlspecialchars($request['bank']));
                $staff->CC = encrypt(htmlspecialchars($request['CC']));
                $staff->marital_status = encrypt(htmlspecialchars($request['marital_status']));
                if(strlen($request['children'])<1) $request['children'] = 0;
                $staff->children = encrypt(htmlspecialchars($request['children']));
                $staff->email = encrypt(htmlspecialchars($request['email']));

                $staff->save();

                return Redirect::back()->with('successMessage', 'Se ha modificado el registro de "'.$staff->name.'".');
            }
        }
        return abort(404);
    }

    function removeStaff(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['staffId']);

            $staff = Staff::where('id', $id)->first();

            if($staff){
                if($admin->elevation > 3 && $admin->elevation != 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $staff->delete();

                return Redirect::to('viewStaff')->with('successMessage', 'Se ha borrado el registro de entrada "'.$staff->name.'".');
            }
        }
        return abort(404);
    }


    //**************************************************************************  CONTRACTS  **************************************************************************//

    function insertContract(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            if($admin->elevation > 3 && $admin->elevation != 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            if(isset($request['monday'])) $monday = 1;
            else $monday = 0;
            if(isset($request['tuesday'])) $tuesday = 1;
            else $tuesday = 0;
            if(isset($request['wednesday'])) $wednesday = 1;
            else $wednesday = 0;
            if(isset($request['thursday'])) $thursday = 1;
            else $thursday = 0;
            if(isset($request['friday'])) $friday = 1;
            else $friday = 0;
            if(isset($request['saturday'])) $saturday = 1;
            else $saturday = 0;
            if(isset($request['sunday'])) $sunday = 1;
            else $sunday = 0;
            $entity = htmlspecialchars($request['entity']);
            $teacher_nif = encrypt(htmlspecialchars($request['teacher_nif']));
            $type = htmlspecialchars($request['type']);
            $course_type= htmlspecialchars($request['course_type']);
            $gross_salary= htmlspecialchars($request['gross_salary']);
            $retentions = htmlspecialchars($request['retentions']);
            $net_salary = htmlspecialchars($request['net_salary']);
            $formative_planning = htmlspecialchars($request['formative_planning']);
            $case_file = htmlspecialchars($request['case_file']);
            $annuity = htmlspecialchars($request['annuity']);
            $agreement = htmlspecialchars($request['agreement']);
            $other_agreements = htmlspecialchars($request['other_agreements']);
            $sector = htmlspecialchars($request['sector']);
            $course = htmlspecialchars($request['course']);
            $init_date = htmlspecialchars($request['init_date']);
            $end_date = htmlspecialchars($request['end_date']);
            $total_hours = htmlspecialchars($request['total_hours']);
            $daily_hours = htmlspecialchars($request['daily_hours']);
            $schedule = htmlspecialchars($request['schedule']);
            $location = htmlspecialchars($request['location']);
            $observations = htmlspecialchars($request['observations']);
            $communication_date = htmlspecialchars($request['communication_date']);
            $processing_date = htmlspecialchars($request['processing_date']);
            $company_code = htmlspecialchars($request['company_code']);
            $employee_code = htmlspecialchars($request['employee_code']);
            $INEM_code = htmlspecialchars($request['INEM_code']);
            $processed = htmlspecialchars($request['processed']);

            if(strlen($company_code)<1) $company_code = 0;
            if(strlen($employee_code)<1) $employee_code = 0;
            if(strlen($total_hours)<1) $total_hours = 0;
            if(strlen($daily_hours)<1) $daily_hours = 0;

            Contract::create([
                'entity' => $entity,
                'teacher_nif' => $teacher_nif,
                'type' => $type,
                'course_type' => $course_type,
                'gross_salary' => $gross_salary,
                'retentions' => $retentions,
                'net_salary' => $net_salary,
                'formative_planning' => $formative_planning,
                'case_file' => $case_file,
                'annuity' => $annuity,
                'agreement' => $agreement,
                'other_agreements' => $other_agreements,
                'sector' => $sector,
                'course' => $course,
                'init_date' => $init_date,
                'end_date' => $end_date,
                'total_hours' => $total_hours,
                'daily_hours' => $daily_hours,
                'schedule' => $schedule,
                'monday' => $monday,
                'tuesday' => $tuesday,
                'wednesday' => $wednesday,
                'thursday' => $thursday,
                'friday' => $friday,
                'saturday' => $saturday,
                'sunday' => $sunday,
                'location' => $location,
                'observations' => $observations,
                'communication_date' => $communication_date,
                'processing_date' => $processing_date,
                'company_code' => $company_code,
                'employee_code' => $employee_code,
                'INEM_code' => $INEM_code,
                'processed' => $processed,
            ]);

            return Redirect::back()->with('successMessage', 'Se han añadido el contrato en la entidad de"'.$entity.'".');
        }
        return abort(404);
    }

    function limitedContracts(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));
        if($admin){
            if($admin->elevation > 3 && $admin->elevation != 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $contract = Contract::orderBy('id', 'DESC')->paginate(1000);
            $noProcessedContracts =  [];
            $staffs = Staff::all();
            $staffsNif = [];

            for($i = 0; $i < Count($staffs); $i++) array_push($staffsNif, decrypt($staffs[$i]->nif));
            for($i = 0; $i < Count($contract); $i++){
                $search = array_search(decrypt($contract[$i]->teacher_nif),$staffsNif);

                if($contract[$i]->processed == 0) array_push($noProcessedContracts, $contract[$i]);

                if($search) $contract[$i]->teacher_name = $staffs[$search]->name;
                else $contract[$i]->teacher_name = '';
            }

            return view('contracts')
                ->with('contracts', $contract)
                ->with('noProcessedContracts', $noProcessedContracts)
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('limited', true)
                ->with('page', 'contract');
        }
        return abort(404);
    }

    function allContract(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));
        if($admin){
            if($admin->elevation > 3 && $admin->elevation != 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

            $contract = Contract::orderBy('id', 'DESC')->get();
            $noProcessedContracts =  [];
            $staffs = Staff::all();
            $staffsNif = [];

            for($i = 0; $i < Count($staffs); $i++) array_push($staffsNif, decrypt($staffs[$i]->nif));
            for($i = 0; $i < Count($contract); $i++){
                $search = array_search(decrypt($contract[$i]->teacher_nif),$staffsNif);

                if($contract[$i]->processed == 0) array_push($noProcessedContracts, $contract[$i]);

                if($search) $contract[$i]->teacher_name = $staffs[$search]->name;
                else $contract[$i]->teacher_name = '';
            }

            return view('contracts')
                ->with('contracts', $contract)
                ->with('noProcessedContracts', $noProcessedContracts)
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('page', 'contract');
        }
        return abort(404);
    }

    function editContract(Request $request, $id){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($id);

            $contract = Contract::where('id', $id)->first();

            if($contract){
                if($admin->elevation > 3 && $admin->elevation != 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $staffs = Staff::all();
                $contractStaff = null;

                foreach ($staffs as $staff){
                    if(decrypt($staff->nif) == decrypt($contract->teacher_nif)) $contractStaff = $staff;
                }
                return view('editContract')
                    ->with('adminData', [$admin->name, $admin->elevation])
                    ->with('contract', $contract)
                    ->with('staff', $contractStaff)
                    ->with('page', 'contract');
            }
        }
        return abort(404);
    }

    function modifyContract(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['contractId']);

            $contract = Contract::where('id', $id)->first();

            if($contract){
                if($admin->elevation > 3 && $admin->elevation != 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                if(isset($request['monday'])) $contract->monday = 1;
                else $contract->monday = 0;
                if(isset($request['tuesday'])) $contract->tuesday = 1;
                else $contract->tuesday = 0;
                if(isset($request['wednesday'])) $contract->wednesday = 1;
                else $contract->wednesday = 0;
                if(isset($request['thursday'])) $contract->thursday = 1;
                else $contract->thursday = 0;
                if(isset($request['friday'])) $contract->friday = 1;
                else $contract->friday = 0;
                if(isset($request['saturday'])) $contract->saturday = 1;
                else $contract->saturday = 0;
                if(isset($request['sunday'])) $contract->sunday = 1;
                else $contract->sunday = 0;
                $contract->entity = htmlspecialchars($request['entity']);
                $contract->teacher_nif = encrypt(htmlspecialchars($request['teacher_nif']));
                $contract->type = htmlspecialchars($request['type']);
                $contract->course_type= htmlspecialchars($request['course_type']);
                $contract->gross_salary= htmlspecialchars($request['gross_salary']);
                $contract->retentions = htmlspecialchars($request['retentions']);
                $contract->net_salary = htmlspecialchars($request['net_salary']);
                $contract->formative_planning = htmlspecialchars($request['formative_planning']);
                $contract->case_file = htmlspecialchars($request['case_file']);
                $contract->annuity = htmlspecialchars($request['annuity']);
                $contract->agreement = htmlspecialchars($request['agreement']);
                $contract->other_agreements = htmlspecialchars($request['other_agreements']);
                $contract->sector = htmlspecialchars($request['sector']);
                $contract->course = htmlspecialchars($request['course']);
                $contract->init_date = htmlspecialchars($request['init_date']);
                $contract->end_date = htmlspecialchars($request['end_date']);
                if(strlen($request['total_hours'])<1) $request['total_hours'] = 0;
                $contract->total_hours = htmlspecialchars($request['total_hours']);
                if(strlen($request['daily_hours'])<1) $request['daily_hours'] = 0;
                $contract->daily_hours = htmlspecialchars($request['daily_hours']);
                $contract->schedule = htmlspecialchars($request['schedule']);
                $contract->location = htmlspecialchars($request['location']);
                $contract->observations = htmlspecialchars($request['observations']);
                $contract->communication_date = htmlspecialchars($request['communication_date']);
                $contract->processing_date = htmlspecialchars($request['processing_date']);
                if(strlen($request['company_code'])<1) $request['company_code'] = 0;
                $contract->company_code = htmlspecialchars($request['company_code']);
                if(strlen($request['employee_code'])<1) $request['employee_code'] = 0;
                $contract->employee_code = htmlspecialchars($request['employee_code']);
                $contract->INEM_code = htmlspecialchars($request['INEM_code']);
                $contract->processed = htmlspecialchars($request['processed']);

                $contract->save();

                return Redirect::back()->with('successMessage', 'Se ha modificado el registro de "'.$contract->entity.'".');
            }
        }
        return abort(404);
    }

    function removeContract(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $id = htmlspecialchars($request['contractId']);

            $contract = Contract::where('id', $id)->first();

            if($contract){
                if($admin->elevation > 3 && $admin->elevation != 6) return Redirect::back()->withErrors( 'No tiene los permisos necesarios para realizar esta acción.');

                $contract->delete();

                return Redirect::to('viewLimitedContracts')->with('successMessage', 'Se ha borrado el registro de entrada "'.$contract->entity.'".');
            }
        }
        return abort(404);
    }

    //**************************************************************************  CHAT  **************************************************************************//

    function viewAllChats(Request $request, $parameter = null){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $otherAdmins =  Admin::where('name', '!=', $admin->name)->orderBy('name', 'ASC')->get();
            $chatData = [];

            $unreadChats = Message::where('receiver', $admin->name)->where('seen', 0)->get();

            foreach ($unreadChats as $unreadChat){
                $unreadChat->seen = 1;
                $unreadChat->save();
            }

            foreach ($otherAdmins as $otherAdmin){
                $messages = Message::where(function ($query) use ($admin, $otherAdmin) {
                    $query->where('sender', $admin->name)->where('receiver', $otherAdmin->name);
                })->orWhere(function ($query) use ($admin, $otherAdmin) {
                    $query->where('sender', $otherAdmin->name)->where('receiver', $admin->name);
                })->orderBy('created_at', 'DESC')->get();

                array_push($chatData, [[$otherAdmin->name, $otherAdmin->id], $messages]);
            }

            return view('chat')
                ->with('adminData', [$admin->name, $admin->elevation])
                ->with('target', $parameter)
                ->with('chatData', $chatData)
                ->with('unreadChats', $unreadChats)
                ->with('page', 'chat');
        }
        return abort(404);
    }

    function chatSendMessage(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            $receiver = htmlspecialchars($request['receiver']);
            $message = htmlspecialchars($request['message']);

            $receiver = Admin::where('id', $receiver)->first();

            Message::create([
                'sender' => $admin->name,
                'receiver' => $receiver->name,
                'message' => $message
            ]);

            return Redirect::to('chat/'.$receiver->id);
        }
        return abort(404);
    }

    //**************************************************************************  CLOSE SESSION  **************************************************************************//

    function closeSession(Request $request){
        $admin = $this->validateAdmin($request->cookie('user'), $request->cookie('sessionToken'));

        if($admin){
            Cookie::queue(Cookie::forget('user'));
            Cookie::queue(Cookie::forget('sessionToken'));
            return redirect('/');
        }else return abort(404);
    }
}
<?php

namespace App\Http\Controllers\Paciente;

use App\Paciente;
use App\PacientesExpedientes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use UxWeb\SweetAlert\SweetAlert as Alert;

class PacienteExpedienteController extends Controller
{
     public function index(Paciente $paciente)
    {
        $expediente = $paciente->expediente;
        if ($expediente == null) {
            return view('pacineteexpediente.create',['paciente'=>$paciente]);
            //return redirect()->route('pacineteexpediente.create',['paciente'=>$paciente]);
        }
        else {
            return view('pacineteexpediente.view',['paciente'=>$paciente, 'expediente'=>$expediente]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,Paciente $paciente)
    {
        
        if ($request->input('Actualizar')!=null) {
            return view('pacineteexpediente.create', ['paciente' => $paciente,'expediente' => $paciente->expediente]);
        }else{
            return view('pacineteexpediente.create', ['paciente' => $paciente]);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Paciente $paciente)
    {
       
        if ($request->aviso_privacidad && $request->file('aviso_privacidad')->isValid()) {
            $aviso_privacidad = explode("/",$request->aviso_privacidad->storeAs('expedientes/'.$paciente->id, 'aviso_privacidad.'.$request->aviso_privacidad->extension(), 'public'));
        }
        if ($request->identificacion && $request->file('identificacion')->isValid()) {
            $identificacion = explode("/",$request->identificacion->storeAs('expedientes/'.$paciente->id, 'identificacion.'.$request->identificacion->extension(), 'public'));
        }
        if ($request->identificacion2 && $request->file('identificacion2')->isValid()) {
            $identificacion2 = explode("/",$request->identificacion2->storeAs('expedientes/'.$paciente->id, 'identificacion2.'.$request->identificacion2->extension(), 'public'));
        }
        if ($request->inapam && $request->file('inapam')->isValid()) {
            $inapam = explode("/",$request->inapam->storeAs('expedientes/'.$paciente->id, 'inapam.'.$request->inapam->extension(), 'public'));
        }

        if ($request->receta && $request->file('receta')->isValid()) {
            $receta = explode("/",$request->receta->storeAs('expedientes/'.$paciente->id, 'receta.'.$request->receta->extension(), 'public'));
        }


        if (!isset($aviso_privacidad)) {
            $aviso_privacidad=null;
        }else{
            $aviso_privacidad=$aviso_privacidad[2];
        }
        if (!isset($identificacion)) {
            $identificacion=null;
        }else{
            $identificacion=$identificacion[2];
        }
        if (!isset($identificacion2)) {
            $identificacion2=null;
        }else{
            $identificacion2=$identificacion2[2];
        }

        if (!isset($inapam)) {
            $inapam=null;
        }else{
             $inapam=$inapam[2];
        }
        if (!isset($receta)) {
            $receta=null;
        }else{
             $receta=$receta[2];
        }

        if (PacientesExpedientes::where('paciente_id',$paciente->id)->exists()) {
            $expediente=$paciente->expediente;
            if ($identificacion!=null) {
                $expediente = PacientesExpedientes::updateOrCreate(['paciente_id'=>$paciente->id],[
                    'identificacion'=>$identificacion
                ]);
            }
            if ($inapam!=null) {
                $expediente = PacientesExpedientes::updateOrCreate(['paciente_id'=>$paciente->id],[
                    'inapam'=>$inapam
                ]);
            }
            if ($receta!=null) {
                $expediente = PacientesExpedientes::updateOrCreate(['paciente_id'=>$paciente->id],[
                    'receta'=>$receta
                ]);
            }
            if ($identificacion2!=null) {
                $expediente = PacientesExpedientes::updateOrCreate(['paciente_id'=>$paciente->id],[
                    'identificacion2'=>$identificacion2
                ]);
            }
            

        }else{
            $expediente = PacientesExpedientes::updateOrCreate(['paciente_id'=>$paciente->id],[
                
                'aviso_privacidad'=>$aviso_privacidad,
                'identificacion'=>$identificacion,
                'inapam'=>$inapam,
                'receta'=>$receta,
                'identificacion2'=>$identificacion2
            ]);
        }
        Alert::success('Información Agregada', 'Se ha registrado correctamente la información');
        return view('pacineteexpediente.view',['paciente'=>$paciente,'expediente'=>$expediente]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoExpediente  $empleadoExpediente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente, PacientesExpedientes $empleadoExpediente)
    {
        return view('pacineteexpediente.view',['paciente'=>$paciente,'expediente'=>$paciente->expediente]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrarBeneficiarioRequest;
use App\Beneficiario;

class BeneficiarioController extends Controller
{
    public function index()
    {
    	$beneficiarios = Beneficiario::all();
    	return view('beneficiario.beneficiarios')->with('beneficiarios', $beneficiarios);
    }

    public function registro()
    {
    	return view('beneficiario.registro');
    }

    public function registrar(RegistrarBeneficiarioRequest $request)
    {
    	$beneficiario = new Beneficiario();

    	$fecha = $request->get('anio') . '-' . $request->get('mes') . '-' . $request->get('dia');

    	$beneficiario->nombre = $request->get('nombre');
    	$beneficiario->ap_paterno = $request->get('ap_paterno');
    	$beneficiario->ap_materno = $request->get('ap_materno');
    	$beneficiario->fecha_nacimiento = $fecha;
    	$beneficiario->domicilio = $request->get('domicilio');
    	$beneficiario->comunidad = $request->get('comunidad');
    	$beneficiario->fecha_registro = date("Y-m-d");
    	$beneficiario->tb_usuarios_id_usuario = 1;

    	$beneficiario->save();
    	
    	return redirect()->route('ruta_beneficiarios');
    }
}
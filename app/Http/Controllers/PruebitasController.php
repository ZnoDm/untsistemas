<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebitasController extends Controller
{
    // public function index(){
    //     //Existe solicitud en revision
    //     //ESTADOS DE LA PRACTICA 1=EN REVISION, 2=APROBADA, 3= RECHAZADA, 4=FINALIZADA.
    //     $status= Practica::select('status')->where('alumno_codigo',auth()->user()->alumno_codigo)->value('status');
    //     $practica = null;
    //     if($status == 2){
    //         $practica= Practica::firstWhere(['status'=> 2,'alumno_codigo'=> auth()->user()->alumno_codigo]);
    //     }
    //     return view('alumno.practicas.index',compact('status','practica'));
    // }

    // public function solicitud(Request $request){

    //     $request->validate([
    //         'num_operacion' => 'required',
    //         'file_voucher' =>'required',

    //         'solicitud' => 'required',
    //         'description' => 'required',
    //         'start_date' => 'required',
    //         'end_date' => 'required',
    //         'file_practica' => 'required',
    //     ]);
        
    //     $file_voucher =$request->file('file_voucher')->store('public/vouchers');
    //     $url_file_voucher =Storage::url($file_voucher);

    //     Voucher::create([
    //         'num_operacion' => $request->num_operacion,
    //         'file_voucher' => $url_file_voucher,
    //     ]);

    //     $file_practica =$request->file('file_practica')->store('public/plan_practicas');
    //     $url_file_practica =Storage::url($file_practica);

    //     Practica::create([
    //         'solicitud' => $request->solicitud,
    //         'description' => $request->description,
    //         'start_date' => $request->start_date,
    //         'end_date' => $request->end_date,
            
    //         'file_practica' => $url_file_practica,

    //         'status'=> 1,//ESTADO 1 EN REVISION
    //         'alumno_codigo' => auth()->user()->alumno_codigo,
    //         'voucher_num_operacion' =>$request->num_operacion,
    //     ]);

    //     return redirect()->route('alumno.practicas.index')->with('info','Su solicitud fue enviada con éxito!');
    // }
}

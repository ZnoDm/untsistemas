<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApprovedPractica;
use App\Mail\AvisaPractica;
use App\Mail\DeniedPractica;
use App\Mail\EndPractica;
use App\Models\Alumno;
use App\Models\Practica;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PracticaController extends Controller
{
    //ESTADOS DE LA PRACTICA 1=EN REVISION, 2=APROBADA, 3= RECHAZADA, 4=FINALIZADA, 5=INFORME FINAL.,6 =INFORME DENEGADO
    public function index ()
    {
        $practicas = DB::table('alumno_practica')        
        ->join('practicas', 'alumno_practica.practica_id', '=', 'practicas.id')
        ->join('alumnos', 'alumno_practica.alumno_codigo', '=', 'alumnos.codigo')
        ->join('docentes', 'alumno_practica.docente_id', '=', 'docentes.id')
        ->select('alumno_practica.*','alumnos.*','docentes.nombre AS docente','practicas.descripcion','practicas.fecha_inicio','practicas.fecha_fin') 
        ->where('alumno_practica.status',1)
        ->orWhere('alumno_practica.status',5)
        ->get(); 
        return view('admin.practica.index',compact('practicas'));
    }
    public function revision($id)
    {
        $practica = DB::table('alumno_practica')        
        ->join('practicas', 'alumno_practica.practica_id', '=', 'practicas.id')
        ->join('alumnos', 'alumno_practica.alumno_codigo', '=', 'alumnos.codigo')
        ->join('docentes', 'alumno_practica.docente_id', '=', 'docentes.id')
        ->join('empresas', 'practicas.empresa_id', '=', 'empresas.id')
        ->join('vouchers', 'practicas.voucher_id', '=', 'vouchers.id')
        ->select('alumno_practica.*','alumnos.*','docentes.nombre AS docente','practicas.descripcion','practicas.fecha_inicio','practicas.fecha_fin','practicas.file_practica','practicas.file_informe_final','practicas.voucher_id','practicas.empresa_id','empresas.ruc','empresas.nombre as razonsocial','empresas.representante','empresas.supervisor','empresas.telefono as e_telefono','vouchers.nro','vouchers.file_voucher') 
        ->where('alumno_practica.id',$id)->first();
        return view('admin.practica.revision',compact('practica'));
    }
    
    //MANDAR A CORREGIR
    public function denegar(Request $request,$id,$alumno,$estado)
    {

        if ($estado == 3) {
            DB::table('alumno_practica') 
            ->where('alumno_practica.id',$id)->update(['status'=>3]);
        }else{
        
            DB::table('alumno_practica') 
            ->where('alumno_practica.id',$id)->update(['status'=>6]);
        }
        
        $mensajito  = $request->descripcion;
        $practica = Practica::find($id);
        $practica->observations()->create(['mensaje'=>$request->descripcion]);
        $alumno1 = Alumno::firstWhere('codigo',$alumno);
        $mail1 = new DeniedPractica($alumno1,$mensajito);
        Mail::to($alumno1->email)->queue($mail1);


        return redirect()->route('admin.practicas')->with('info','Se mandó a corregir satisfactoriamente');

    }

    public function aprobar($id,$alumno,$estado)
    {
        
        $alumno = Alumno::firstWhere('codigo',$alumno);
        if ($estado == 3) {
            DB::table('alumno_practica') 
            ->where('alumno_practica.id',$id)->update(['status'=>2]);
            $practica = Practica::find($id);
            $mensaje = "Su practica fue aprobada con exito";
            $mail = new ApprovedPractica($alumno,$practica,$mensaje);
            Mail::to($alumno->email)->queue($mail);
            $fecha1= new DateTime($practica->fecha_inicio);
            $fecha2= new DateTime($practica->fecha_fin);
            $diff = $fecha1->diff($fecha2);
            
            //Mail::to($alumno->email)->later(now()->addMinutes(1),$mail);
            //A los días obtenidos le restamos 7 para obtener una semana antes * 1,440 (24*60)

            $minutos_retraso =  ($diff->days - 7)* 1440;
            
            $mensaje = "Debe enviar su informe final dentro del plazo";
            $mail_aviso = new AvisaPractica($alumno,$practica,$mensaje);
            Mail::to($alumno->email)->later(now()->addMinutes(1),$mail_aviso);
            

            
        }else{
            DB::table('alumno_practica') 
            ->where('alumno_practica.id',$id)->update(['status'=>4]);
            $mail = new EndPractica($alumno);
            Mail::to($alumno->email)->queue($mail);
        }
        
        return redirect()->route('admin.practicas')->with('info','Aprobacion satisfactoria');
    }
    
    public function practicas_finalizadas(){
        $practicas = DB::table('alumno_practica')        
        ->join('practicas', 'alumno_practica.practica_id', '=', 'practicas.id')
        ->join('alumnos', 'alumno_practica.alumno_codigo', '=', 'alumnos.codigo')
        ->join('docentes', 'alumno_practica.docente_id', '=', 'docentes.id')
        ->select('alumno_practica.*','alumnos.*','docentes.nombre AS docente','practicas.descripcion','practicas.descripcion','practicas.fecha_inicio','practicas.fecha_fin') 
        ->where('alumno_practica.status',4)
        ->get(); 
        return view('admin.practica.finalizadas',compact('practicas'));
    }

    public function show($id){
        $practica = DB::table('alumno_practica')        
        ->join('practicas', 'alumno_practica.practica_id', '=', 'practicas.id')
        ->join('alumnos', 'alumno_practica.alumno_codigo', '=', 'alumnos.codigo')
        ->join('docentes', 'alumno_practica.docente_id', '=', 'docentes.id')
        ->join('empresas', 'practicas.empresa_id', '=', 'empresas.id')
        ->join('vouchers', 'practicas.voucher_id', '=', 'vouchers.id')
        ->select('alumno_practica.*','alumnos.*','docentes.nombre AS docente','practicas.descripcion','practicas.fecha_inicio','practicas.fecha_fin','practicas.file_practica','practicas.file_informe_final','practicas.voucher_id','practicas.empresa_id','empresas.ruc','empresas.nombre as razonsocial','empresas.representante','empresas.supervisor','empresas.telefono as e_telefono','vouchers.nro','vouchers.file_voucher') 
        ->where('alumno_practica.id',$id)->first();
        return view('admin.practica.show',compact('practica'));
    }


}

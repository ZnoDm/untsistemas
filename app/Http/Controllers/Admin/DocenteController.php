<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    //ESTADOS DE LA PRACTICA 1=EN REVISION, 2=APROBADA, 3= RECHAZADA, 4=FINALIZADA, 5=INFORMEFINAL.
    public function index()
    {
        return view('admin.docente.index');
    }
    public function show(Docente $docente)
    {
        $tesis =DB::table('alumno_tesis')->where('docente_id',$docente->id)->get();
        $practicas=DB::table('alumno_practica')
        ->join('practicas', 'alumno_practica.practica_id', '=', 'practicas.id')
        ->join('alumnos', 'alumno_practica.alumno_codigo', '=', 'alumnos.codigo')
        ->select('alumno_practica.*','alumnos.*','practicas.descripcion','practicas.descripcion','practicas.fecha_inicio','practicas.fecha_fin','practicas.file_practica','practicas.voucher_id','practicas.empresa_id')
        ->where('docente_id',$docente->id)
        ->where('alumno_practica.status',2)->get();
        return view('admin.docente.show',compact('docente','tesis','practicas'));
    }
    public function asignar(Docente $docente)
    {
        return view('admin.docente.asignar',compact('docente'));
    }

    public function asignado(Request $request)
    {
        // Con 1 es solo Practica, Con 2 Es Tesis, 3 AMBOS
        $docente = Docente::find($request->docente_id);
        if ($request->cbox1 and $request->cbox2) {
            $docente->update(['status'=>3]);
        }else{
            if ($request->cbox1) {
                $docente->update(['status'=>1]);
            }else{
                $docente->update(['status'=>2]);
            }
        }
        
        return redirect()->route('admin.docente.index')->with('info','Docente asignado con exito');
    }
}

<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Empresa;
use App\Models\Practica;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PracticaController extends Controller
{
    //ESTADOS DE LA PRACTICA 1=EN REVISION, 2=APROBADA, 3= RECHAZADA, 4=FINALIZADA, 5=INFORME FINAL.
    public function index()
    {
        $alumno = Alumno::firstWhere(['email'=>auth()->user()->email]);
        $practicas = DB::table('alumno_practica')->where('alumno_codigo',$alumno->codigo)->get();
        return view('alumno.practica.index',compact('practicas'));
    }

    public function create()
    {
        $docentes = Docente::where('status','3')->orWhere('status','1')->get();
        return view('alumno.practica.create',compact('docentes'));
    }

    public function store(Request $request)
    {
        $request->validate([            
            'descripcion' => 'required',
            'fecha_inicio' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < date('Y-m-d')) {
                        $fail('Fecha no válida. La fecha no puede ser menor a la actual.');
                    }
                }],
            'fecha_fin' =>[
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request->fecha_inicio) {
                        $fail('Fecha no válida. La fecha final, debe ser posterior a la fecha inicial.');
                    }
                },
                function ($attribute, $value, $fail) use ($request) {
                    if ((strtotime($value) - strtotime($request->fecha_inicio))/3600 < 600) {
                        $fail('Fecha no válida. Se debe cumplir un minimo de 600 horas.');
                    }
                }],       
            'file_practica' => 'required',

            'nro' => 'required',
            'file_voucher' => 'required',
            'docente_id'=>[function ($attribute, $value, $fail) use ($request) {
                if ($value == "") {
                    $fail('Seleccione un docente.');
                }
            }],
            'ruc' => 'required',
            'nombre' => 'required',
            'representante' => 'required',
            'supervisor' => 'required',
            'telefono' => 'required',
        ]);

            $alumno = Alumno::firstWhere(['email'=>auth()->user()->email]);

            $file_voucher =$request->file('file_voucher')->store('public/vouchers');
            $url_file_voucher =Storage::url($file_voucher);
            $voucher = Voucher::create([
                'nro' => $request->nro,
                'file_voucher' => $url_file_voucher,
            ]);
            $empresa = Empresa::create([            
                'ruc' => $request->ruc,
                'nombre' => $request->nombre,
                'representante' => $request->representante,
                'supervisor' => $request->supervisor,
                'telefono' => $request->telefono,
            ]);


            $file_practica =$request->file('file_practica')->store('public/plan_practicas');
            $url_file_practica =Storage::url($file_practica);

            $practica = Practica::create([
                'descripcion' => $request->descripcion,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'file_practica' => $url_file_practica,
                'voucher_id' =>$voucher->id,
                'empresa_id' =>$empresa->id,
            ]);

            DB::table('alumno_practica')->insert([
                'alumno_codigo'=>$alumno->codigo,
                'practica_id'=>$practica->id,
                'docente_id' =>$request->docente_id,
                'status'=>1,
            ]);

        return redirect()->route('practica.index')->with('info','Su solicitud fue enviada con éxito!');
        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $docentes = Docente::where('status','3')->orWhere('status','1')->get();
        $alumno_practica = DB::table('alumno_practica')->where('alumno_practica.id',$id)->first();
        $practica = Practica::find($alumno_practica->practica_id);
        return view('alumno.practica.edit',compact('practica','docentes','alumno_practica'));        
    }

 function update(Request $request, Practica $practica)
    {
        $request->validate([            
            'descripcion' => 'required',
            'fecha_inicio' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < date('Y-m-d')) {
                        $fail('Fecha no válida. La fecha no puede ser menor a la actual.');
                    }
                }],
            'fecha_fin' =>[
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request->fecha_inicio) {
                        $fail('Fecha no válida. La fecha final, debe ser posterior a la fecha inicial.');
                    }
                },
                function ($attribute, $value, $fail) use ($request) {
                    if ((strtotime($value) - strtotime($request->fecha_inicio))< 600) {
                        $fail('Fecha no válida. Se debe cumplir un minimo de 600 horas.');
                    }
                }],            
            
            'nro' => 'required',
            'docente_id'=>[function ($attribute, $value, $fail) use ($request) {
                if ($value == "") {
                    $fail('Seleccione un docente.');
                }
            }],    
            'ruc' => 'required',
            'nombre' => 'required',
            'representante' => 'required',
            'supervisor' => 'required',
            'telefono' => 'required',
        ]);
        

        $practica->empresa()->update([
            'ruc' => $request->ruc,
            'nombre' => $request->nombre,
            'representante' => $request->representante,
            'supervisor' => $request->supervisor,
            'telefono' => $request->telefono,
        ]);

        $practica->update([
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        if($request->file('file_practica')){
            $file_practica = $request->file('file_practica')->store('public/plan_practicas');
            $url_file_practica =Storage::url($file_practica);
            $practica->update([
                'file_practica' => $url_file_practica,
            ]);
        }

        if($request->file('file_voucher') || $practica->voucher->nro != $request->nro){
            
            $request->validate([ 'file_voucher' => 'required' ]); 
            $file_voucher = $request->file('file_voucher')->store('public/vouchers');
            $url_file_voucher =Storage::url($file_voucher);

            if($practica->voucher->nro == $request->nro){
                Storage::delete($practica->voucher->file_voucher);

                $practica->voucher->update([
                    'file_voucher' => $url_file_voucher,
                ]);
            }else{
                $practica->voucher->update([                    
                    'nro' => $request->nro,
                    'file_voucher' => $url_file_voucher,
                ]);
            }
        }

        DB::table('alumno_practica') 
        ->where('alumno_practica.practica_id',$practica->id)->update(['status'=>1,'docente_id'=>$request->docente_id]);

        return redirect()->route('practica.index')->with('info','Su solicitud fue actualizada con éxito!');
    }

    public function destroy($id)
    {
        //
    }

    public function progreso($id){
        $practica = DB::table('alumno_practica')        
        ->join('practicas', 'alumno_practica.practica_id', '=', 'practicas.id')
        ->join('alumnos', 'alumno_practica.alumno_codigo', '=', 'alumnos.codigo')
        ->join('docentes', 'alumno_practica.docente_id', '=', 'docentes.id')
        ->join('empresas', 'practicas.empresa_id', '=', 'empresas.id')
        ->join('vouchers', 'practicas.voucher_id', '=', 'vouchers.id')
        ->select('alumno_practica.*','alumnos.*','docentes.nombre AS docente','practicas.descripcion','practicas.descripcion','practicas.fecha_inicio','practicas.fecha_fin','practicas.file_practica','practicas.voucher_id','practicas.empresa_id','empresas.ruc','empresas.nombre as razonsocial','empresas.representante','empresas.supervisor','empresas.telefono as e_telefono','vouchers.nro','vouchers.file_voucher') 
        ->where('alumno_practica.id',$id)->first();
        $prac = Practica::find($practica->practica_id);
        return view('alumno.practica.progreso',compact('practica','prac'));
    }

    public function informefinal(Request $request){
        $request->validate([
            'file_informe_final' => 'required',
        ]);
        $file_informe_final =$request->file('file_informe_final')->store('public/informe_final/practicas');
        $url_file_informe_final =Storage::url($file_informe_final);
        $practica = Practica::find($request->practica_id);
        $practica->update(['file_informe_final'=>$url_file_informe_final]);

        DB::table('alumno_practica') 
        ->where('alumno_practica.id',$request->practica_id)->update(['status'=>5]);
        
        return redirect()->route('practica.index')->with('info','Informe final enviado con exito!');
    }
}

<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Tesis;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TesisController extends Controller
{
    
    public function index()
    {
        
        $alumno = Alumno::firstWhere(['email'=>auth()->user()->email]);
        $tesis = DB::table('alumno_tesis')->where('alumno_codigo',$alumno->codigo)->get();
        //VALIDAR SI HA TERMINADO SUS PRACTICAS PARA PODER HACER SU TESIS
        $practica_finalizada = DB::table('alumno_practica')->where('alumno_codigo',$alumno->codigo)->where('status','4')->get();
        return view('alumno.tesis.index',compact('tesis','practica_finalizada'));
    }

    public function create()
    {
        $docentes = Docente::where('status','3')->orWhere('status','2')->get();
        return view('alumno.tesis.create',compact('docentes'));
    }


    public function store(Request $request)
    {
        $request->validate([            
            'titulo' => 'required',            
            'file_tesis' => 'required',
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
                }
            ],            
            'docente_id'=>[function ($attribute, $value, $fail) use ($request) {
                    if ($value == "") {
                        $fail('Seleccione un docente.');
                    }
                }],
            'nro' => 'required',            
            'file_voucher' => 'required',
        ]);

        $alumno = Alumno::firstWhere(['email'=>auth()->user()->email]);

        $file_voucher =$request->file('file_voucher')->store('public/vouchers');
        $url_file_voucher =Storage::url($file_voucher);
        $voucher = Voucher::create([
            'nro' => $request->nro,
            'file_voucher' => $url_file_voucher,
        ]);

        $file_tesis =$request->file('file_tesis')->store('public/plan_tesis');
        $url_file_tesis =Storage::url($file_tesis);

        $tesis = Tesis::create([
            'titulo' => $request->titulo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'file_tesis' => $url_file_tesis,
            'voucher_id' =>$voucher->id,
        ]);

        DB::table('alumno_tesis')->insert([
            'alumno_codigo'=>$alumno->codigo,
            'tesis_id'=>$tesis->id,
            'docente_id' =>$request->docente_id,
            'status'=>1,
        ]);

        return redirect()->route('tesis.index')->with('info','Su solicitud fue enviada con éxito!');
    }


    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $docentes = Docente::where('status','3')->orWhere('status','2')->get();
        $alumno_tesis = DB::table('alumno_tesis')->where('alumno_tesis.id',$id)->first();
        $tesis = Tesis::find($alumno_tesis->tesis_id);
        return view('alumno.tesis.edit',compact('docentes','tesis','alumno_tesis'));
    }

    public function update(Request $request,$tesis)
    {
        $tesis = Tesis::find($tesis);
        $request->validate([            
            'titulo' => 'required',
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
        ]);
        


        $tesis->update([
            'titulo' => $request->titulo,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        if($request->file('file_tesis')){
            $file_tesis = $request->file('file_tesis')->store('public/plan_tesis');
            $url_file_tesis =Storage::url($file_tesis);
            $tesis->update([
                'file_tesis' => $url_file_tesis,
            ]);
        }
        if($request->file('file_voucher') || $tesis->voucher->nro != $request->nro){
            
            $request->validate([ 'file_voucher' => 'required' ]); 
            $file_voucher = $request->file('file_voucher')->store('public/vouchers');
            $url_file_voucher =Storage::url($file_voucher);

            if($tesis->voucher->nro == $request->nro){
                Storage::delete($tesis->voucher->file_voucher);

                $tesis->voucher->update([
                    'file_voucher' => $url_file_voucher,
                ]);
            }else{
                $tesis->voucher->update([                    
                    'nro' => $request->nro,
                    'file_voucher' => $url_file_voucher,
                ]);
            }
        }
        DB::table('alumno_tesis') 
        ->where('alumno_tesis.tesis_id',$tesis->id)->update(['status'=>1,'docente_id'=>$request->docente_id]);

        return redirect()->route('tesis.index')->with('info','Su solicitud fue actualizada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function informefinal($id){
        $tesis = DB::table('alumno_tesis')
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->select('alumno_tesis.*','tesis.*')       
        ->where('alumno_tesis.id',$id)->first();
        $tes = Tesis::find($tesis->tesis_id);
        return view('alumno.tesis.final',compact('tesis','tes'));
    }

    public function send_informefinal(Request $request){

        $request->validate([
            'file_informe_final' => 'required',
        ]);

        $file_informe_final = $request->file('file_informe_final')->store('public/informe_final/tesis');
        $url_file_informe_final = Storage::url($file_informe_final);

        $tesis = Tesis::find($request->tesis_id);
        $tesis->update(['file_informe_final'=>$url_file_informe_final]);

        DB::table('alumno_tesis') 
        ->where('alumno_tesis.id',$request->tesis_id)->update(['status'=>5]);
        
        return redirect()->route('tesis.index')->with('info','Informe final enviado con exito!');
    }
    public function revisar($id){
        $jurados = DB::table('alumno_tesis')
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->join('jurados', 'alumno_tesis.tesis_id', '=', 'jurados.tesis_id')
        ->join('docentes', 'jurados.docente_id', '=', 'docentes.id')
        ->select('docentes.*','alumno_tesis.sustentacion')     
        ->where('alumno_tesis.id',$id)->get();

        $tesis = DB::table('alumno_tesis')
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->select('alumno_tesis.*','tesis.*')       
        ->where('alumno_tesis.id',$id)->first();
        return view('alumno.tesis.revisar',compact('tesis','jurados'));
    }
    

}

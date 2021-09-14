<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApprovedPractica;
use App\Mail\ApprovedTesis;
use App\Mail\AvisaPractica;
use App\Mail\DeniedTesis;
use App\Mail\EndPractica;
use App\Mail\JuradoTesis;
use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Jurado;
use App\Models\Tesis;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TesisController extends Controller
{
    public function index ()
    {
        $tesis = DB::table('alumno_tesis')        
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->join('alumnos', 'alumno_tesis.alumno_codigo', '=', 'alumnos.codigo')
        ->join('docentes', 'alumno_tesis.docente_id', '=', 'docentes.id')
        ->select('alumno_tesis.*','alumnos.*','docentes.nombre AS docente','tesis.*') 
        ->where('alumno_tesis.status',1)
        ->orWhere('alumno_tesis.status',5)
        ->get(); 
        return view('admin.tesis.index',compact('tesis'));
    }
    public function revision($id)
    {
        $tesis = DB::table('alumno_tesis')        
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->join('alumnos', 'alumno_tesis.alumno_codigo', '=', 'alumnos.codigo')
        ->join('docentes', 'alumno_tesis.docente_id', '=', 'docentes.id')
        ->join('vouchers', 'tesis.voucher_id', '=', 'vouchers.id')
        ->select('alumno_tesis.*','alumnos.*','docentes.nombre AS docente','tesis.*','vouchers.nro','vouchers.file_voucher')  
        ->where('alumno_tesis.id',$id)->first();

        $docentes = Docente::where('status','3')->orWhere('status','2')->get();
        return view('admin.tesis.revision',compact('tesis','docentes'));
    }
       
    public function denegar(Request $request,$id,$alumno,$estado)
    {
        if ($estado == 1) {
            DB::table('alumno_tesis') 
            ->where('alumno_tesis.id',$id)->update(['status'=>3]);
        }else{
        
            DB::table('alumno_tesis') 
            ->where('alumno_tesis.id',$id)->update(['status'=>6]);
        }
        
        $mensajito  = $request->descripcion;
        $tesis = Tesis::find($id);
        $tesis->observations()->create(['mensaje'=>$request->descripcion]);
        $alumno1 = Alumno::firstWhere('codigo',$alumno);
        $mail1 = new DeniedTesis($alumno1,$mensajito);
        Mail::to($alumno1->email)->queue($mail1);
        
        return redirect()->route('admin.tesis')->with('info','Se mandó a corregir satisfactoriamente');

    }

    public function aprobar(Request $request,$id,$alumno,$estado)
    {
        $alumno = Alumno::firstWhere('codigo',$alumno);
        if ($estado == 1) {
            DB::table('alumno_tesis') 
            ->where('alumno_tesis.id',$id)->update(['status'=>2]);
            $practica = Tesis::find($id);
            $mensaje = "Su solicitud de tesis fue aprobada con exito";
            $mail = new ApprovedTesis($alumno,$practica,$mensaje);
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
            $jurados=$request->docente_ids;
            $jurado=new Jurado();
            $jurado->tesis_id = $id;
            $jurado->docente_id= $jurados[0];
            $jurado->save();

            $jurado1=new Jurado();
            $jurado1->tesis_id = $id;
            $jurado1->docente_id= $jurados[1];
            $jurado1->save();

            $jurado2=new Jurado();
            $jurado2->tesis_id = $id;
            $jurado2->docente_id= $jurados[2];
            $jurado2->save();

            DB::table('alumno_tesis') 
            ->where('alumno_tesis.id',$id)->update(['status'=>8]);

            $practica = Tesis::find($id);
            $mensaje = "Su informe final de tesis fue aprobada con exito";
            $jurados = DB::table('jurados')
            ->join('docentes', 'docentes.id', '=', 'jurados.docente_id')
            ->select('docentes.*')
            ->where('tesis_id',$id)->get();
            $mail = new JuradoTesis($alumno,$practica,$mensaje,$jurados);
            Mail::to($alumno->email)->queue($mail);
        }
        
        return redirect()->route('admin.tesis')->with('info','Aprobacion satisfactoria');
    }

    
    public function sustenacion(){
        $tesis = DB::table('alumno_tesis')        
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->join('alumnos', 'alumno_tesis.alumno_codigo', '=', 'alumnos.codigo')
        ->join('docentes', 'alumno_tesis.docente_id', '=', 'docentes.id')
        ->select('alumno_tesis.*','alumnos.*','docentes.nombre AS docente','tesis.*') 
        ->where('alumno_tesis.status',7)
        ->orWhere('alumno_tesis.status',8)
        ->get();  
        return view('admin.tesis.sustentaciones',compact('tesis'));
    }
    public function asignar_fecha($id){
        $tesis = DB::table('alumno_tesis')        
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->join('alumnos', 'alumno_tesis.alumno_codigo', '=', 'alumnos.codigo')
        ->join('docentes', 'alumno_tesis.docente_id', '=', 'docentes.id')
        ->join('vouchers', 'tesis.voucher_id', '=', 'vouchers.id')
        ->select('alumno_tesis.*','alumnos.*','docentes.nombre AS docente','tesis.*','vouchers.nro','vouchers.file_voucher')  
        ->where('alumno_tesis.id',$id)->first();

        return view('admin.tesis.asignar_fecha',compact('tesis'));
    }
    public function asignando_fecha(Request $request){
        $request->validate([
            'sustentacion' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < date('Y-m-d')) {
                        $fail('Fecha no válida. La fecha no puede ser menor a la actual.');
                    }
                }],
        ]);
        $alumno = Alumno::firstWhere('codigo',$request->codigo);
        $jurados = DB::table('alumno_tesis')
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->join('jurados', 'alumno_tesis.tesis_id', '=', 'jurados.tesis_id')
        ->join('docentes', 'jurados.docente_id', '=', 'docentes.id')
        ->select('jurados.*')     
        ->where('alumno_tesis.id',$request->tesis_id)->get();

        DB::table('alumno_tesis') 
            ->where('alumno_tesis.id',$request->tesis_id)->update(['status'=>7,'sustentacion'=>$request->sustentacion]);

        $practica = Tesis::find($request->tesis_id);
        $mensaje = "Su informe final de tesis fue aprobada con exito, debe sustentar el ".$request->sustentacion." .";
        $jurados = DB::table('jurados')
            ->join('docentes', 'docentes.id', '=', 'jurados.docente_id')
            ->select('docentes.*')
            ->where('tesis_id',$request->tesis_id)->get();
        $mail = new JuradoTesis($alumno,$practica,$mensaje,$jurados);
        Mail::to($alumno->email)->queue($mail);
        return redirect()->route('admin.tesisfinalizadas')->with('info','Fecha Asignada');
    }

    
    public function calificar($id){

        $jurados = DB::table('alumno_tesis')
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->join('jurados', 'alumno_tesis.tesis_id', '=', 'jurados.tesis_id')
        ->join('docentes', 'jurados.docente_id', '=', 'docentes.id')
        ->select('docentes.*','alumno_tesis.sustentacion')     
        ->where('alumno_tesis.id',$id)->get();

        $tesis = DB::table('alumno_tesis')        
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->join('alumnos', 'alumno_tesis.alumno_codigo', '=', 'alumnos.codigo')
        ->join('docentes', 'alumno_tesis.docente_id', '=', 'docentes.id')
        ->join('vouchers', 'tesis.voucher_id', '=', 'vouchers.id')
        ->select('alumno_tesis.*','alumnos.*','docentes.nombre AS docente','tesis.*','vouchers.nro','vouchers.file_voucher')  
        ->where('alumno_tesis.id',$id)->first();

        return view('admin.tesis.calificar',compact('tesis','jurados'));
    }

  

    public function calificando(Request $request){
        $request->validate([
            'nota1' => ['required',function ($attribute, $value, $fail) use ($request) {
                if ($value > 20) {
                    $fail('La nota debe ser menor a 20.');
                }
            }],
            'nota2' => ['required',function ($attribute, $value, $fail) use ($request) {
                if ($value > 20) {
                    $fail('La nota debe ser menor a 20.');
                }
            }],
            'nota3' => ['required',function ($attribute, $value, $fail) use ($request) {
                if ($value > 20) {
                    $fail('La nota debe ser menor a 20.');
                }
            }]
        ]);
        $jurados = DB::table('alumno_tesis')
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->join('jurados', 'alumno_tesis.tesis_id', '=', 'jurados.tesis_id')
        ->join('docentes', 'jurados.docente_id', '=', 'docentes.id')
        ->select('jurados.*')     
        ->where('alumno_tesis.id',$request->tesis_id)->get();
        $array[] = "";
        foreach ($jurados as $jur) {
            array_push($array, $jur->id);
        }
        $jurado = Jurado::find($array[1]);
        $jurado->update(['nota'=> $request->nota1]);
        $jurado = Jurado::find($array[2]);
        $jurado->update(['nota'=> $request->nota2]);
        $jurado = Jurado::find($array[3]);
        $jurado->update(['nota'=> $request->nota3]);

        DB::table('alumno_tesis') 
        ->where('alumno_tesis.id',$request->tesis_id)->update(['status'=>4]);

        $alumno = Alumno::firstWhere('codigo',$request->codigo);
        $mail = new EndPractica($alumno);
        Mail::to($alumno->email)->queue($mail);
        return redirect()->route('admin.tesisfinalizadas')->with('info','Calificaciones Gurdadas');
    }


    public function tesis(){
        $tesis = DB::table('alumno_tesis')        
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->join('alumnos', 'alumno_tesis.alumno_codigo', '=', 'alumnos.codigo')
        ->join('docentes', 'alumno_tesis.docente_id', '=', 'docentes.id')
        ->select('alumno_tesis.*','alumnos.*','docentes.nombre AS docente','tesis.*') 
        ->where('alumno_tesis.status',4)
        ->get(); 
        return view('admin.tesis.finalizadas',compact('tesis'));
    }
    public function show($id){
        $jurados = DB::table('alumno_tesis')
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->join('jurados', 'alumno_tesis.tesis_id', '=', 'jurados.tesis_id')
        ->join('docentes', 'jurados.docente_id', '=', 'docentes.id')
        ->select('docentes.*','jurados.nota')     
        ->where('alumno_tesis.id',$id)->get();
        $tesis = DB::table('alumno_tesis')        
        ->join('tesis', 'alumno_tesis.tesis_id', '=', 'tesis.id')
        ->join('alumnos', 'alumno_tesis.alumno_codigo', '=', 'alumnos.codigo')
        ->join('docentes', 'alumno_tesis.docente_id', '=', 'docentes.id')
        ->join('vouchers', 'tesis.voucher_id', '=', 'vouchers.id')
        ->select('alumno_tesis.*','alumnos.*','docentes.nombre AS docente','tesis.*','vouchers.nro','vouchers.file_voucher')  
        ->where('alumno_tesis.id',$id)->first();
        return view('admin.tesis.show',compact('tesis','jurados'));
    }
}

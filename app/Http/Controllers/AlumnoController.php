<?php

namespace App\Http\Controllers;

use App\DTO\AlumnoDTO;
use App\Models\Alumno;
use App\Models\Nivel;
use App\Services\AlumnoService;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class AlumnoController extends Controller
{
    protected $alumnoService;

    public function __construct(AlumnoService $alumnoService)
    {
        $this->alumnoService=$alumnoService;
    }

    public function index()
    {
        try{
            $all=$this->alumnoService->listAll();
            return response()->json($all);
        }catch(Exception $e){
        }
    }
    
    public function show($id)
    {
        try{
            $detail=$this->alumnoService->findDetail($id);
            return response()->json($detail);
        }catch(Exception $e){
        }
    }
    
    
    public function store(Request $request)
    {
    //     $request->validate([
    //         'matricula'=>'required|unique:alumnos|max:10',
    //         'nombre'=>'required|max:255',
    //         'fecha'=>'required|date',
    //         'telefono'=>'required',
    //         'email'=>'nullable|email',
    //         'nivel'=>'required'
    //     ]);
        try{
            $alumnoDTO=new AlumnoDTO(0,$request->input('matricula'),$request->input('nombre'),$request->input('fecha_nacimiento'),
            $request->input('telefono'),$request->input('email'),$request->input('nivel_id'));
            $alumnoDTO->validate();
            return response()->json($this->alumnoService->create($alumnoDTO));
        }catch(Exception $e){
        }
    }
    
}

    
    // public function update(Request $request, $id){
    //     $request->validate([
    //         'matricula'=>'required|max:10|unique:alumnos,matricula,' . $id,
    //         'nombre'=>'required|max:255',
    //         'fecha'=>'required|date',
    //         'telefono'=>'required',
    //         'email'=>'nullable|email',
    //         'nivel'=>'required'
    //     ]);
    //     $alumno= Alumno::find($id);
    //     $alumno->matricula=$request->input('matricula');
    //     $alumno->nombre=$request->input('nombre');
    //     $alumno->fecha_nacimiento=$request->input('fecha');
    //     $alumno->telefono=$request->input('telefono');
    //     $alumno->email=$request->input('email');
    //     $alumno->nivel_id=$request->input('nivel');
    //     $alumno->save();
    //     return view('alumnos.message',['msg'=>'Registro modificado']);
    // }

    // public function destroy($id)
    // {
    //     $alumno=Alumno::find($id);
    //     $alumno->delete();
    //     return redirect('alumnos');
    // }

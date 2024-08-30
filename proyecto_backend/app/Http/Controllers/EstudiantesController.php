<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Estudiante::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $e = Estudiante::create($inputs);
        return response()->json(
            [
                "data" => $e,
                "message" => "Estudiante creado correctamente"
            ]
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){
            return response()->json(
                [
                    "data" => $e,
                    "message" => "Estudiante encontrado con exito."
                ]
            );
        }else{
            return response()->json(
                [
                    "error" => true,
                    "message" => "Estudiante no encontrado."
                ]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $e  = Estudiante::find($id);
        if(isset($e)){
            $e->nombre = $request->nombre;
            $e->apellido = $request->apellido;
            $e->foto = $request->foto;
            if($e->save()){
                return response()->json(
                    [
                        "data" => $e,
                        "message" => "Estudiante actualizado correctamente"
                    ]
                    );
            }else{
                return response()->json(
                    [
                        "error" => true,
                        "message" => "Error al actualizar el estudiante"
                    ]
                    );
            }
        }else{
            return response()->json(
                [
                    "error" => true,
                    "message" => "Estudiante no encontrado"
                ]
                );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){
           $res = Estudiante::destroy($id);
           if($res){
            return response()->json(
                [
                    "data"=>$e,
                    "message" => "Estudiante eliminado correctamente"
                ]
                );
           }else{
            return response()->json(
                [
                    "data" => $e,
                    "message" => "Error al eliminar el estudiante"
                ]
                );
           }

        }else{
            return response()->json(
                [
                    "error" => true,
                    "message" => "Estudiante no encontrado"
                ]
                );
        }
    }
}

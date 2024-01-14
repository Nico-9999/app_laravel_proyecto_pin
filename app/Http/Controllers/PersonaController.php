<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'apellido' => 'required',
                'mail' => 'required|unique:personas,mail',
                'mensaje' => 'required',
            ]);

            $persona = Persona::create([
                'nombre' => $request['nombre'],
                'apellido' => $request['apellido'],
                'mail' => $request['mail'],
                'mensaje' => $request[
                    'mensaje'
                ]
            ]);

            $details = [
                'mensaje' => "El usuario " . $request['nombre'] . " se ha registrado",
                'nombre' => $request['nombre'],
                'apellido' => $request['apellido'],
                'mail' => $request['mail']
            ];

            \Mail::to('astradasatya@gmail.com')->send(new \App\Mail\sendPost($details));

            return response()->json([
                'mensaje' => 'Se agregó correctamente la persona',
                'data' => $persona,
            ]);
        } catch (\Exception $exception) {
            // Puedes imprimir el mensaje de error o lograrlo para un seguimiento más detallado
            \Log::error($exception);

            // También puedes personalizar la respuesta según tus necesidades
            return response()->json(['error' => $exception->getMessage()], 500);    

        }
    }
        // 

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Lógica para obtener y mostrar la persona con el ID proporcionado
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json(['mensaje' => 'Persona no encontrada'], 404);
        }

        return response()->json(['data' => $persona]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $persona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        //
    }
}

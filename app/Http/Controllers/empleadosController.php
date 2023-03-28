<?php

namespace App\Http\Controllers;

use App\Models\empleados;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;

class empleadosController extends Controller
{
    //
    public function obtenerEmpleados()
    {
        try {
            $empleados = empleados::all();
            // return response()->json([
            //     'empleado' => $empleados
            // ]);

            return response()->json($empleados);
            // return json_encode($empleados);
        } catch (Exception $e) {
            $msj = $e->getMessage();
            return response()->json($msj);
        }
    }



    public function almacenarEmpleado(Request $request)
    {
        try {
            if ($request->nombre != null && $request->correo != null) {

                $empleado = new empleados;
                $empleado->nombre = $request->nombre;
                $empleado->correo = $request->correo;
                $empleado->save();

                return response()->json([
                    'estado'=>1,
                    'message' => 'Se agrego al empleado'
                ], 201);
            } else {
                return response()->json([
                    'estado'=>0,
                    'message' => 'No se pudo agregar al empleado'
                ], 201);
            }
        } catch (Exception $e) {
            $msj = $e->getMessage();
            return response()->json($msj);
        }
    }

    public function actualizarEmpleado(Request $request)
    {
        if ($request->nombre != null) {

            $empleado = empleados::find($request->id);
            $empleado->nombre = $request->nombre;
            $empleado->correo = $request->correo;
            $empleado->save();

            return response()->json([
                'message' => 'Empleado actualizado correctamente'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Empleado no creado correctamente'
            ], 201);
        }
    }

    public function borrarEmpleado($id)
    {
        $empleado = empleados::find($id);
        $empleado->delete();

        return response()->json([
            'message' => 'Empleado borrado correctamente'
        ], 201);
    }
}

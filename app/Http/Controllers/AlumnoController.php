<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class AlumnoController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = Alumno::all();
        return response()->json([
            'status' => 'true',
            'code' => Response::HTTP_OK,
            'data' => $data
        ], Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param Alumno $alumno
     * @return JsonResponse
     */
    public function show(Alumno $alumno):JsonResponse
    {
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'data' => $alumno
        ], Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Alumno $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        //
    }


    /**
     * @param Alumno $alumno
     * @return JsonResponse
     */
    public function destroy(Alumno $alumno): JsonResponse
    {
        $alumno->delete();
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'message' => 'Student has been deleted successfully',
        ], Response::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlumnoStoreRequest;
use App\Http\Requests\AlumnoUpdateRequest;
use App\Models\Alumno;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @param AlumnoStoreRequest $request
     * @return JsonResponse
     */
    public function store(AlumnoStoreRequest $request): JsonResponse
    {
        $alumno = Alumno::create($request->validated());
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_CREATED,
            'message' => 'Student has been added successfully',
            'data' => $alumno,
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Alumno $alumno
     * @return JsonResponse
     */
    public function show(Alumno $alumno): JsonResponse
    {
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'data' => $alumno
        ], Response::HTTP_OK);
    }


    /**
     * @param AlumnoUpdateRequest $request
     * @param Alumno $alumno
     * @return JsonResponse
     */
    public function update(AlumnoUpdateRequest $request, Alumno $alumno): JsonResponse
    {
        $alumno->update($request->validated());
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'message' => 'Student information has been updated successfully',
            'data' => $alumno
        ], Response::HTTP_OK);
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

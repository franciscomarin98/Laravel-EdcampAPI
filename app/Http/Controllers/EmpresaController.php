<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaStoreRequest;
use App\Http\Requests\EmpresaUpdateRequest;
use App\Models\Empresa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = Empresa::all();
        return response()->json([
            'status' => 'true',
            'code' => Response::HTTP_OK,
            'data' => $data
        ],Response::HTTP_OK);
    }


    /**
     * @param EmpresaStoreRequest $request
     * @return JsonResponse
     */
    public function store(EmpresaStoreRequest $request): JsonResponse
    {
        $empresa = Empresa::create($request->validated());
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_CREATED,
            'message' => 'Price has been added successfully',
            'data' => $empresa,
        ], Response::HTTP_CREATED);
    }


    /**
     * @param Empresa $empresa
     * @return JsonResponse
     */
    public function show(Empresa $empresa): JsonResponse
    {
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'data' => $empresa
        ], Response::HTTP_OK);
    }


    /**
     * @param EmpresaUpdateRequest $request
     * @param Empresa $empresa
     * @return JsonResponse
     */
    public function update(EmpresaUpdateRequest $request, Empresa $empresa): JsonResponse
    {
        $empresa->update($request->validated());
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'message' => 'Company information has been updated successfully',
            'data' => $empresa
        ], Response::HTTP_OK);
    }


    /**
     * @param Empresa $empresa
     * @return JsonResponse
     */
    public function destroy(Empresa $empresa): JsonResponse
    {
        $empresa->delete();
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'message' => 'Company has been deleted successfully',
        ], Response::HTTP_OK);
    }
}

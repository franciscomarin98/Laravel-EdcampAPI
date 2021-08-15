<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrecioStoreRequest;
use App\Http\Requests\PrecioUpdateRequest;
use App\Models\Precio;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PrecioController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = Precio::all();
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'data' => $data
        ], Response::HTTP_OK);
    }


    /**
     * @param PrecioStoreRequest $request
     * @return JsonResponse
     */
    public function store(PrecioStoreRequest $request): JsonResponse
    {
        $precio = Precio::create($request->validated());
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_CREATED,
            'message' => 'Price has been added successfully',
            'data' => $precio
        ], Response::HTTP_CREATED);
    }


    /**
     * @param Precio $precio
     * @return JsonResponse
     */
    public function show(Precio $precio): JsonResponse
    {
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'data' => $precio
        ], Response::HTTP_OK);
    }


    /**
     * @param PrecioUpdateRequest $request
     * @param Precio $precio
     * @return JsonResponse
     */
    public function update(PrecioUpdateRequest $request, Precio $precio): JsonResponse
    {
        $precio->update($request->validated());
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'message' => 'Price has been updated successfully',
            'data' => $precio
        ], Response::HTTP_OK);
    }

    /**
     * @param Precio $precio
     * @return JsonResponse
     */
    public function destroy(Precio $precio): JsonResponse
    {
        $precio->delete();
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'message' => 'Price has been deleted successfully',
        ], Response::HTTP_OK);
    }
}

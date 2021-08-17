<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagoStoreRequest;
use App\Http\Requests\PagoUpdateRequest;
use App\Models\Pago;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PagoController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = Pago::all();
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'data' => $data
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PagoStoreRequest $request
     * @return JsonResponse
     */
    public function store(PagoStoreRequest $request): JsonResponse
    {
        $pago = Pago::create($request->validated());
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_CREATED,
            'message' => 'Successful registration payment',
            'data' => $pago
        ], Response::HTTP_CREATED);
    }


    /**
     * @param Pago $pago
     * @return JsonResponse
     */
    public function show(Pago $pago): JsonResponse
    {
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'data' => $pago
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PagoUpdateRequest $request
     * @param Pago $pago
     * @return JsonResponse
     */
    public function update(PagoUpdateRequest $request, Pago $pago): JsonResponse
    {
        $pago->update($request->validated());
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'message' => 'Registration payment information has been updated successfully',
            'data' => $pago
        ], Response::HTTP_OK);
    }

    /**
     * @param Pago $pago
     * @return JsonResponse
     */
    public function destroy(Pago $pago): JsonResponse
    {
        $pago->delete();
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_OK,
            'message' => 'Pay has been deleted successfully',
        ], Response::HTTP_OK);
    }
}

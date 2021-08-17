<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pago $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
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

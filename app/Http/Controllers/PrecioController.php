<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrecioStoreRequest;
use App\Models\Precio;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Precio::all();
    }


    public function store(PrecioStoreRequest $request)
    {
        $precio = Precio::create($request->validated());
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_CREATED,
            'message' => 'Price has been added successfully',
            'data' => $precio
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Precio $precio
     * @return \Illuminate\Http\Response
     */
    public function show(Precio $precio)
    {
        return $precio;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Precio $precio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Precio $precio)
    {
        $precio->update($request->all());
        return $precio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Precio $precio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Precio $precio)
    {
        $precio->delete();
        return $precio;
    }
}

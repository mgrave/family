<?php

namespace App\Http\Controllers;

use App\BusinessPartner;
use App\Http\Requests\StoreBusinessPartnerRequest;
use App\Http\Requests\UpdateBusinessPartnerRequest;
use Illuminate\Http\Request;

class BusinessPartnerController extends Controller
{

    /**
     * Devuelve la lista de bancos
     * @param Request|mixed $request
     * @return static
     */
    public function search(Request $request)
    {
        $search = $request->input('q') ?? $request->input('q');
        return BusinessPartner::with('user')->where('first_name', 'like', "%{$search}%")->get();
    }

    /**
     * Crear un nuvo banco
     * @param StoreBusinessPartnerRequest|mixed $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBusinessPartnerRequest $request)
    {
        $objBusinessPartner = new BusinessPartner();
        $objBusinessPartner->fill([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'status' => $request->status
        ]);
        $objBusinessPartner->user()->associate($request->user());
        if ($objBusinessPartner->save()) {
            return response()->json(['message' => 'Socio de Negocio creado correctamente!']);
        } else {
            return response()->json(['error' => 'El Socio de Negocio no pudo ser creado.'], 500);
        }
    }

    /**
     * Actualiza los datos de un banco
     * @param UpdateBusinessPartnerRequest|mixed $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBusinessPartnerRequest $request, $id)
    {
        /** @var BusinessPartner|mixed $objBusinessPartner */
        $objBusinessPartner = BusinessPartner::find($id);
        if (empty($objBusinessPartner)) {
            return response()->json(['error' => 'El Socio de Negocio no pudo ser encontrado.'], 500);
        }
        $objBusinessPartner->first_name = $request->first_name;
        $objBusinessPartner->last_name = $request->last_name;
        $objBusinessPartner->status = $request->status;
        if ($objBusinessPartner->save()) {
            return response()->json(['Socio de Negocio actualizado correctamente!']);
        } else {
            return response()->json(['error' => 'El Socio de Negocio no pudo ser creado.'], 500);
        }
    }

    /**
     * Elimina un socio de negocio
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id)
    {
        /** @var BusinessPartner|mixed $objBusinessPartner */
        $objBusinessPartner = BusinessPartner::find($id);
        if (empty($objBusinessPartner)) {
            return response()->json(['error' => 'El Socio de Negocio no pudo ser encontrado.'], 500);
        }
        if ($objBusinessPartner->delete()) {
            return response()->json(['Socio de Negocio eliminado correctamente!']);
        } else {
            return response()->json(['error' => 'El Socio de Negocio no pudo ser creado.'], 500);
        }
    }

}

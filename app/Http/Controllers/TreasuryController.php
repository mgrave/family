<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BusinessPartner;
use App\Http\Requests\StoreTreasuryRequest;
use App\Http\Requests\UpdateTreasuryRequest;
use App\Treasury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Exception;

class TreasuryController extends Controller
{

    /**
     * Devuelve la lista de bancos
     * @param Request|mixed $request
     * @return static
     */
    public function search(Request $request)
    {
        $type = $request->input('t') ?? $request->input('t');
        return Treasury::with('user')->with('businessPartner')->with('bank')->where('type', 'like', "%{$type}%")->get();
    }

    /**
     * Crear un nuvo banco
     * @param StoreTreasuryRequest|mixed $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTreasuryRequest $request)
    {
        try {
            $objBusinessPartner = BusinessPartner::find($request->business_partner_id);
            if (empty($objBusinessPartner)) {
                throw new Exception('El Socio de Negocio no pudo ser encontrado.');
            }
            $objBank = Bank::find($request->bank_id);
            if (empty($objBank)) {
                throw new Exception('El Banco no pudo ser encontrado.');
            }
            $objTreasury = new Treasury();
            $objTreasury->fill([
                'type' => $request->type,
                'amount' => $request->amount,
                'status' => $request->status
            ]);
            $objTreasury->user()->associate($request->user());
            $objTreasury->businessPartner()->associate($objBusinessPartner);
            $objTreasury->bank()->associate($objBank);
            if (!$objTreasury->save()) {
                throw new Exception('No se pudo crear el movimiento de tesoreria.');
            }
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
        return response()->json('Movimiento de tesorería creado correctamente.');
    }

    /**
     * Actualiza los datos de un banco
     * @param UpdateTreasuryRequest|mixed $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTreasuryRequest $request, $id)
    {
        try {
            /** @var Treasury|mixed $objTreasury */
            $objTreasury = Treasury::find($id);
            if (empty($objTreasury)) {
                throw new Exception('El movimiento de tesorería no pudo ser encontrado.');
            }
            $objBusinessPartner = BusinessPartner::find($request->business_partner_id);
            if (empty($objBusinessPartner)) {
                throw new Exception('El Socio de Negocio no pudo ser encontrado.');
            }
            $objBank = Bank::find($request->bank_id);
            if (empty($objBank)) {
                throw new Exception('El Banco no pudo ser encontrado.');
            }
            $objTreasury->type = $request->type;
            $objTreasury->amount = $request->amount;
            $objTreasury->status = $request->status;
            $objTreasury->user()->associate($request->user());
            $objTreasury->businessPartner()->associate($objBusinessPartner);
            if (!$objTreasury->save()) {
                throw new Exception('No se pudo crear el movimiento de tesoreria.');
            }
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
        return response()->json('Movimiento de tesorería actualizado correctamente.');
    }

    /**
     * Elimina un banco
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id)
    {
        try {
            /** @var Treasury|mixed $objTreasury */
            $objTreasury = Treasury::find($id);
            if (empty($objTreasury)) {
                throw new Exception('El movimiento de tesorería no pudo ser encontrado.');
            }
            if (!$objTreasury->delete()) {
                return response()->json(['error' => 'El movimiento de tesorería no pudo ser creado.'], 500);
            }
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
        return response()->json('Movimiento de tesorería eliminado correctamente.');
    }

}

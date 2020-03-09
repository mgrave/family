<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankSercice;
use App\Http\Requests\StoreBankRequest;
use App\Http\Requests\UpdateBankRequest;
use Illuminate\Http\Request;

class BankController extends Controller
{

    /**
     * Devuelve la lista de bancos
     * @param Request|mixed $request
     * @return static
     */
    public function search(Request $request)
    {
        $search = $request->input('q') ?? $request->input('q');
        return Bank::with('bankService')->where('name', 'like', "%{$search}%")->get();
    }

    /**
     * Devuelve los servicios de los bancos
     * @param Request $request
     * @return static
     */
    public function services(Request $request)
    {
        $services = BankSercice::all()->where('status', '=', 1);
        return $services;
    }

    /**
     * Crear un nuvo banco
     * @param StoreBankRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBankRequest $request)
    {
        $objBankService = BankSercice::find($request->bank_service_id);
        if (empty($objBankService)) {
            return response()->json(['message' => 'El servicio no pudo ser encontrado'], 500);
        }
        $objBank = new Bank();
        $objBank->fill([
            'name' => $request->name,
            'balance' => 0,
            'status' => $request->status
        ]);
        $objBank->bankService()->associate($objBankService);
        if ($objBank->save()) {
            return response()->json(['message' => 'Banco creado correctamente!']);
        } else {
            return response()->json(['error' => 'El banco no pudo ser creado.'], 500);
        }
    }

    /**
     * Actualiza los datos de un banco
     * @param UpdateBankRequest|mixed $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBankRequest $request, $id)
    {
        /** @var Bank|mixed $objBank */
        $objBank = Bank::find($id);
        if (empty($objBank)) {
            return response()->json(['error' => 'El banco no pudo ser encontrado.'], 500);
        }
        $objBankService = BankSercice::find($request->bank_service_id);
        if (empty($objBankService)) {
            return response()->json(['error' => 'El servicio no pudo ser encontrado'], 500);
        }
        $objBank->name = $request->name;
        $objBank->status = $request->status;
        $objBank->bankService()->associate($objBankService);
        if ($objBank->save()) {
            return response()->json(['Banco actualizado correctamente!']);
        } else {
            return response()->json(['error' => 'El banco no pudo ser creado.'], 500);
        }
    }

    /**
     * Elimina un banco
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id)
    {
        /** @var Bank|mixed $objBank */
        $objBank = Bank::find($id);
        if (empty($objBank)) {
            return response()->json(['error' => 'El banco no pudo ser encontrado.'], 500);
        }
        if ($objBank->delete()) {
            return response()->json(['Banco eliminado correctamente!']);
        } else {
            return response()->json(['error' => 'El banco no pudo ser creado.'], 500);
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CepService;
use Illuminate\Http\JsonResponse;

class CEPController extends Controller
{
    protected $cepService;

    public function __construct(CepService $cepService)
    {
        $this->cepService = $cepService;
    }

    /**
     * Busca informações de endereço pelo CEP
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getCEP(Request $request): JsonResponse
    {
        $request->validate([
            'cep' => 'required|string|min:8|max:9'
        ]);

        return $this->cepService->getAddressByCep($request->cep);
    }
}

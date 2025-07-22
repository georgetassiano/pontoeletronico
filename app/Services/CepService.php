<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class CepService
{
    /**
     * Busca informações de endereço pelo CEP
     *
     * @param string $cep
     * @return JsonResponse
     */
    public function getAddressByCep(string $cep): JsonResponse
    {
        try {
            // Remove caracteres não numéricos do CEP
            $cep = preg_replace('/[^0-9]/', '', $cep);
            
            // Verifica se o CEP tem 8 dígitos
            if (strlen($cep) !== 8) {
                return response()->json([
                    'success' => false,
                    'message' => 'CEP deve conter 8 dígitos'
                ], 400);
            }
            
            // Faz a requisição para a API do ViaCEP
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
            
            if ($response->successful()) {
                $data = $response->json();
                
                // Verifica se o CEP foi encontrado
                if (isset($data['erro'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'CEP não encontrado'
                    ], 404);
                }
                
                return response()->json([
                    'success' => true,
                    'data' => [
                        'street' => $data['logradouro'] ?? '',
                        'district' => $data['bairro'] ?? '',
                        'city' => $data['localidade'] ?? '',
                        'state' => $data['uf'] ?? '',
                        'cep' => $data['cep'] ?? ''
                    ]
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Erro ao consultar CEP'
            ], 500);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor'
            ], 500);
        }
    }
}
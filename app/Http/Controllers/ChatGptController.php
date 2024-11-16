<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\PesquisarController;
use App\Models\Modelo;
use Illuminate\Support\Facades\DB;

class ChatGptController extends Controller
{

    public function getresponse(Request $request)
    {
        try {
            $response = $this->getResponseGemini($request);
            dd($response);
            if (is_array($response) && empty($response)) {
                return response()->json(['error' => 'Dados da API inválidos'], 400);
            }

            $modelo_id = DB::table('modelo')
                        ->select('id')
                        ->where('nome', 'like', $response['modelo_nome'])
                        ->get();
            
            dd($modelo_id);                

            $pesquisa = new PesquisarController();

            return $pesquisa->search($request, $response);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro inesperado: ' . $e->getMessage()], 500);
        }
    }

    public function getResponseGemini(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $apiKey = env('GEMINI_API_KEY');
        $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key={$apiKey}";

        $mensagem = "Com a seguinte frase, retorne, caso nao ha na frase retorne null, a montadora apenas ignorar 
            modelo do carro, motor do carro, ano do carro, peça do carro desejada " . $request->input('message');
        try {
            $response = $client->post($endpoint, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $mensagem],
                            ],
                        ],
                    ],
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);
            $textResponse = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? '';
            
            $jsonContent = trim(str_replace(['```json', '```'], '', $textResponse));
            $data = json_decode($jsonContent, true);
            
            $filters = [
                'modelo_nome'    => $data['modelo do carro'] ?? null,
                'motor_nome'     => $data['motor do carro'] ?? null,
                'ano'          => $data['ano do carro'] ?? null,
                'grupo_nome'   => $data['peça do carro desejada'] ?? null,
            ];
            
            dd($filters);
            return $filters;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}

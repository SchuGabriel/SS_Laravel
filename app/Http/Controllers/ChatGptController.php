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

            if (is_array($response) && empty($response)) {
                return response()->json(['error' => 'Dados da API inválidos'], 400);
            }

            if (isset($response['modelo_nome']) || $response['modelo_nome'] == null) {
                $modelo_id = DB::table('modelo')
                    ->select('id')
                    ->where('nome', 'like', $response['modelo_nome'])
                    ->first();

                #dd($modelo_id);
            } else {
                dd('A chave modelo_nome não está definida no array $response.');
            }

            if (isset($response['motor_nome']) || $response['motor_nome'] == null) {
                $motor_id = DB::table('motor')
                    ->select('id')
                    ->where('nome', 'like', $response['motor_nome'])
                    ->first();

                #dd($motor_id);
            } else {
                dd('A chave motor_nome não está definida no array $response.');
            }

            if (isset($response['grupo_nome']) || $response['grupo_nome'] == null) {
                $grupo_id = DB::table('grupo')
                    ->select('id')
                    ->where('nome', 'like', $response['grupo_nome'])
                    ->first();

                #dd($grupo_id);
            } else {
                dd('A chave grupo_nome não está definida no array $response.');
            }

            $request->merge([
                'modelo_id' => $modelo_id ? $modelo_id->id : null,
                'motor_id' => $motor_id ? $motor_id->id : null,
                'ano' => $response['ano'],
                'grupo_id' => $grupo_id ? $grupo_id->id : null,
            ]);
            

            $pesquisa = new PesquisarController();
            
            return $pesquisa->search($request);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro inesperado: ' . $e->getMessage()], 500);
        }
    }

    public function getResponseGemini(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $apiKey = env('GEMINI_API_KEY');
        $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key={$apiKey}";

        $mensagem = "Por favor, com frase a seguir retorne: modelo do carro, motor do carro, ano do carro e peça desejada. Se algum dado não for encontrado, retorne null para esse campo. Frase: " . $request->input('message');
        #$mensagem = "Por favor, extraia as seguintes informações da frase a seguir, retornando sem nenhum símbolos: modelo do carro, motor do carro, ano do carro e peça do carro desejada. Se algum dado não for encontrado, retorne null para esse campo. Frase: " . $request->input('message');

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

            preg_match('/Modelo do carro:\s*(.+)/i', $textResponse, $modelo);
            preg_match('/Motor do carro:\s*(.+)/i', $textResponse, $motor);
            preg_match('/Ano do carro:\s*(.+)/i', $textResponse, $ano);
            preg_match('/Peça desejada:\s*(.+)/i', $textResponse, $peca);

            $data = [
                'modelo_nome' => $modelo[1] ?? null,
                'motor_nome' => $motor[1] ?? null,
                'ano' => $ano[1] ?? null,
                'grupo_nome' => $peca[1] ?? null,
            ];

            return $data;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}

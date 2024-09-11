<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ChatGptController extends Controller
{
    public function getResponse(Request $request)
    {
        $client = new Client();
        $apiKey = env('OPENAI_API_KEY');

        try {
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                        ['role' => 'user', 'content' => $request->input('message')],
                    ],
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);
            dd($responseData); 

        } catch (\Exception $e) {
            dd($e->getMessage()); 
        }
    }
}

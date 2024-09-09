<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Gemini\Laravel\Facades\Gemini;
use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

class GeminiController extends Controller
{
    public function enhanceDescription(Request $request)
    {
        $apiKey = env('GEMINI_API_KEY');
        $productName = $request->input('product_name');
        $prompt = "Generate a short and simple description (without functions) for the product " . $productName . "No more than 25 words.";

        return response()->json(['response' => "Endpoint interno correcto con " . $productName]);

        try {
            $client = new Client($apiKey);
            $response = $client->geminiPro()->generateContent(
                new TextPart($prompt),
            );

            return response()->json(['response' => $response]);
        } catch (Exception $e) {
            Log::error('Error en la API de Gemini: ' . $e->getMessage());
            return response()->json(['error' => 'Error en la generación de contenido'], 500);
        }


        /*try {
            $result = Gemini::geminiPro()->generateContent($prompt);
            $generatedText = $result->text();
            return response()->json(['response' => $generatedText]);
        } catch (Exception $e) {
            Log::error('Error en la API de Gemini: ' . $e->getMessage());
            return response()->json(['error' => 'Error en la generación de contenido'], 500);
        } */
    }
}

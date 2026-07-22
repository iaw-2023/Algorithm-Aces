<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GeminiAPI\Client;
use GeminiAPI\Resources\ModelName;
use GeminiAPI\Resources\Parts\TextPart;
use GeminiAPI\Requests\GenerateContentRequest;
use Illuminate\Support\Facades\Log;

class GeminiController extends Controller
{
    public function enhanceDescription(Request $request)
    {
        $apiKey = env('GEMINI_API_KEY');
        $productName = $request->input('product_name');
        $prompt = "Generate a short and simple description (without functions) for the product " . $productName . " No more than 25 words. If the product name is not a product, reply properly.";

        try {
            // Crear el cliente de Gemini
            $client = new Client($apiKey);

            $response = $client->generativeModel(ModelName::GEMINI_1_5_PRO)->generateContent(
                new TextPart($prompt),
            );

            return response()->json(['response' => $response->text()]);

        } catch (Exception $e) {
            Log::error('Error in Gemini API: ' . $e->getMessage());
            return response()->json(['response' => 'Error while generating enhanced description'], 503);
        }
    }
}

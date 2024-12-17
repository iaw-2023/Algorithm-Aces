<?php

namespace App\Http\Controllers\APIControllers;

require_once 'vendor/autoload.php';

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class APIMercadoPagoController extends Controller
{
    public function createPayment(Request $request)
    {


        //Console log saracatunga
        $this->log("createPayment");

        try {
            // Set access token
            MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));
            MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL); // Only for local testing
            $client = new PaymentClient();

            $requestOptions = new RequestOptions();
            $requestOptions->setCustomHeaders(["X-Idempotency-Key" => uniqid()]);

            $body = $request->json()->all();
            // Log body
            $this->log("Body: " . json_encode($body));

            $paymentRequest = [
                "transaction_amount" => $body['transaction_amount'],
                "token" => $body['token'],
                "description" => "MP Products payment",
                "installments" => $body['installments'],
                "payment_method_id" => $body['payment_method_id'],
                "payer" => [
                    "email" => $body['payer']['email'],
                    "identification" => [
                        "type" => $body['payer']['identification']['type'],
                        "number" => $body['payer']['identification']['number']
                    ]
                ]
            ];

            $payment = $client->create($paymentRequest, $requestOptions);
            // Log payment
            $this->log("Payment: " . json_encode($payment));

            return response()->json($payment);
        } catch (MPApiException $e) {
            return response()->json([
                'status_code' => $e->getApiResponse()->getStatusCode(),
                'content' => $e->getApiResponse()->getContent()
            ], $e->getApiResponse()->getStatusCode());
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function log($message)
    {
        // Implement your logging logic here
    }
}

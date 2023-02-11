<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getPayment()
    {

        $apiKey = env('PAYMENT_API_KEY');

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_FRESH_CONNECT  => true,
        CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
        CURLOPT_FAILONERROR    => false,
        CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = (json_decode($response)->data);
        // dd(json_decode($response));

        return $response ? $response : $error;


    }

    public function ReqPayment($method, $product)
    {


        $apiKey       = env('PAYMENT_API_KEY');
        $privateKey   = env('PAYMENT_API_PRIVATE');
        $merchantCode = env('PAYMENT_MERCH');
        $merchantRef  = 'LX-' . time();
        $user = auth()->user();
        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $product->price,
            'customer_name'  => $user->name,
            'customer_email' => $user->email,
            'order_items'    => [
                [
                    'sku'         => $merchantRef,
                    'name'        => $product->name,
                    'price'       => $product->price,
                    'quantity'    => 1,
                ],
            ],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$product->price, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;

        return $response ? $response : $error;


    }

    public function detailTrx($reference)
    {


        $apiKey = env('PAYMENT_API_KEY');

        $payload = ['reference'	=> $reference];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;

        return $response ? $response : $error;


    }
}

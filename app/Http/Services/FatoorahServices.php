<?php

namespace App\Http\Services;

//use http\Client;

use GuzzleHttp\Client;
//use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request;

class FatoorahServices
{
    private $base_url;
    private $headers;
    private $request_client;

    /**
     * Fatorah Services constructor
     * @param Client $request_client
     */

    public function __construct(Client $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = env('FATOORAH_BASE_URL');
        $this->headers = [
          'Content_type' => 'application/json',
          'authorization' => 'Bearer '.env('FATOORAH_TOKEN'),
        ];
    }

    /**
     * @param $uri
     * @param $method
     * @param array $body
     * @return false|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    private function buildRequest($uri, $method , $data =[])
    {
        $request = new Request($method, $this->base_url.$uri , $this->headers);

        if(!$data)
            return false;

        $response = $this->request_client->send($request , [
           'json' => $data,
        ]);

        if ($response->getStatusCode() != 200){
            return false;
        }

        $response = json_decode($response->getBody(), true);
        return $response;
    }

    /**
     * @param $data
     */
    function sendPayment($data)
    {
       return  $response = $this->buildRequest('v2/SendPayment','POST', $data);
    }

//    /**
//     * @param $request
//     * @return false
//     */
//    public function transactionCallback($request)
//    {
//        return  $response = $this->buildRequest('v2/getPaymentStatus','POST', '');
//    }

    /**
     * @param $data
     */
    function getPaymentStatus($data)
    {
        return  $response = $this->buildRequest('v2/getPaymentStatus','POST', $data);
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Services\FatoorahServices;
use Illuminate\Http\Request;

class FatoorahController extends Controller
{
    private $fatoorahServices;

    public function __construct(FatoorahServices $fatoorahServices)
    {
        $this->fatoorahServices = $fatoorahServices;
    }

    public function payOrder()
    {
        $data = [
            'CustomerName' => 'Mahmoud Badr',
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue' => '50',
            'CustomerEmail' => 'mahmoud.hussiba@gmail.com',
            'CallBackUrl' => env('CALLBACK_URL'),
            'ErrorUrl' => env('ERROR_URL'),
            'Language' => 'en', //or 'ar'
            'DisplayCurrencyIso' => 'SAR',
        ];

        return $this->fatoorahServices->sendPayment($data);

    }

    public function paymentCallback(Request $request)
    {
        $data = [
            'key' => $request->paymentId,
            'keyType'=>'paymentId'
        ];

       return $this->fatoorahServices->getPaymentStatus($data);
    }


    public function paymentError(Request $request)
    {
        dd("Failed payment");
    }
}

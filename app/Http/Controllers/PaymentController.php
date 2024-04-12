<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index(Request $request)
    {
        $amount = 100;
        $orderId = 1;
        $cardNumber = '4268270087374847';
        $expiryMonth = '12';
        $expiryYear = '27';
        $cvv = '123';

        $this->paymentService->doPay();
    }
}

<?php

namespace App\Services;


class PaymentService
{
    protected $data;
    protected $payment;

    public function __construct()
    {
        $this->data = [
            "order" => [
                "items" => [
                    [
                        "reference" => "string",
                        "name" => "string",
                        "quantity" => 1,
                        "unit" => "string",
                        "unitPrice" => 100,

                        "grossTotalAmount" => 100,
                        "netTotalAmount" => 100,
                        "imageUrl" => "string"
                    ]
                ],
                "amount" => 100,
                "currency" => "DKK",
                "reference" => "string"
            ],
            "checkout" => [
                "url" => "http://localhost:8000",
                "integrationType" => "EmbeddedCheckout",
                "returnUrl" => "http://localhost:8000",

                "termsUrl" => "string",



                "charge" => true,
                "publicDevice" => true,
                "merchantHandlesConsumerData" => true,
                "appearance" => [
                    "displayOptions" => [
                        "showMerchantName" => true,
                        "showOrderSummary" => true
                    ],
                    "textOptions" => [
                        "completePaymentButtonText" => "string"
                    ]
                ],
                "countryCode" => "DNK"
            ],
            "merchantNumber" => "string",



            "myReference" => "string"
        ];
    }

    public function doPay()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://test.api.dibspayment.eu/v1/payments",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($this->data),
            CURLOPT_HTTPHEADER => [
                "Authorization: test-secret-key-b2db655983f44c1bad4e0210ed5552bf",
                "CommercePlatformTag: TEST",
                "content-type: application/*+json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            dd($err);
        } else {
            // dd($response);
            $this->payment = json_decode($response);
            $this->retrievePayment();
        }
    }

    private function retrievePayment()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://test.api.dibspayment.eu/v1/payments/" . $this->payment->paymentId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: test-secret-key-b2db655983f44c1bad4e0210ed5552bf",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            dd($err);
        } else {
            // dd($response);
            $yy = json_decode($response);
            $this->chargePayment($yy->payment->orderDetails);
        }
    }

    private function chargePayment($order)
    {
        $xx = [
            "amount" => 100,
            "orderItems" => [
                [
                    "reference" => "string",
                    "name" => "string",
                    "quantity" => 1,
                    "unit" => "string",
                    "unitPrice" => 100,
                    "taxRate" => 0,
                    "taxAmount" => 0,
                    "grossTotalAmount" => 100,
                    "netTotalAmount" => 100,
                    "imageUrl" => "string"
                ]
            ],

            "finalCharge" => true,
            "myReference" => "string"
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://test.api.dibspayment.eu/v1/payments/" . $this->payment->paymentId . "/charges",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($xx),
            CURLOPT_HTTPHEADER => [
                "Authorization: test-secret-key-b2db655983f44c1bad4e0210ed5552bf",
                "CommercePlatformTag: TEST",
                "Idempotency-Key: TEST",
                "content-type: application/*+json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            dd($err);
        } else {
            dd($response);
        }
    }
}

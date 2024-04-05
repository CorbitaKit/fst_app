<?php

namespace App\Services;

class PaymentService
{
    public function doRegister()
    {


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "http://epayment.nets.eu/Netaxept/Register.aspx?merchantId=SOME_STRING_VALUE&token=SOME_STRING_VALUE&serviceType=SOME_STRING_VALUE&transactionId=SOME_STRING_VALUE&transactionReconRef=SOME_STRING_VALUE&description=SOME_STRING_VALUE&isApp=SOME_BOOLEAN_VALUE&digitalWalletId=SOME_STRING_VALUE&orderNumber=SOME_STRING_VALUE&currencyCode=SOME_STRING_VALUE&amount=SOME_STRING_VALUE&force3DSecure=SOME_BOOLEAN_VALUE&updateStoredPaymentInfo=SOME_STRING_VALUE&SCAExemption=SOME_STRING_VALUE&validateCustomer=SOME_BOOLEAN_VALUE&DeliveryDate=SOME_STRING_VALUE&authType=SOME_STRING_VALUE&numberOfGoods=SOME_INTEGER_VALUE&amount_N=SOME_STRING_VALUE&articleNumber_N=SOME_STRING_VALUE&discount_N=SOME_NUMBER_VALUE&handling_N=SOME_BOOLEAN_VALUE&isVatIncluded_N=SOME_BOOLEAN_VALUE&quantity_N=SOME_INTEGER_VALUE&shipping_N=SOME_BOOLEAN_VALUE&title_N=SOME_STRING_VALUE&unitCode_N=SOME_STRING_VALUE&VAT_N=SOME_NUMBER_VALUE&OS=SOME_STRING_VALUE&environmentLanguage=SOME_STRING_VALUE&orderDescription=SOME_STRING_VALUE&language=SOME_STRING_VALUE&redirectUrl=SOME_STRING_VALUE&paymentMethodActionList=SOME_STRING_VALUE&paymentMethodList=SOME_STRING_VALUE&feeList=SOME_STRING_VALUE&terminalVat=SOME_STRING_VALUE&autoAuth=SOME_STRING_VALUE&autoSale=SOME_STRING_VALUE&terminalDesign=SOME_STRING_VALUE&templateData=SOME_STRING_VALUE&terminalSinglePage=SOME_STRING_VALUE&terminalLayout=SOME_STRING_VALUE&redirectOnError=SOME_STRING_VALUE&customerNumber=SOME_STRING_VALUE&customerEmail=SOME_STRING_VALUE&customerPhoneNumber=SOME_STRING_VALUE&customerFirstName=SOME_STRING_VALUE&customerLastName=SOME_STRING_VALUE&customerAddress1=SOME_STRING_VALUE&customerAddress2=SOME_STRING_VALUE&customerPostcode=SOME_STRING_VALUE&customerTown=SOME_STRING_VALUE&customerCountry=SOME_STRING_VALUE&customerIsCompany=SOME_STRING_VALUE&customerAccountNumber=SOME_STRING_VALUE&customerSocialSecurityNumber=SOME_STRING_VALUE&customerCompanyName=SOME_STRING_VALUE&CompanyRegistrationNumber=SOME_STRING_VALUE&customerNotificationMode=SOME_STRING_VALUE&pan=SOME_STRING_VALUE&expiryDate=SOME_STRING_VALUE&securityCode=SOME_STRING_VALUE&recurringType=SOME_STRING_VALUE&recurringFrequency=SOME_STRING_VALUE&recurringExpiryDate=SOME_STRING_VALUE&recurringTransactionType=SOME_STRING_VALUE&panHash=SOME_STRING_VALUE&panhashSecret=SOME_STRING_VALUE&recurringUse3DS=SOME_STRING_VALUE&customerLoyaltyId=SOME_STRING_VALUE&loyaltyAmount=SOME_STRING_VALUE&paymentMethodBenefitAmount=SOME_STRING_VALUE&enableCardLink=SOME_STRING_VALUE&PaymentFacilitatorMCC=SOME_STRING_VALUE&PaymentFacilitatorMerchantDescriptor=SOME_STRING_VALUE&PaymentFacilitatorSubMerchantId=SOME_STRING_VALUE&avtaleGiroKid=SOME_STRING_VALUE&avtaleGiroAccountNumber=SOME_STRING_VALUE&avtaleGiroCompanyName=SOME_STRING_VALUE&avtaleGiroAmountLimit=SOME_STRING_VALUE&pproSepaDynamicDescriptor=SOME_STRING_VALUE&pproSepaMandate=SOME_STRING_VALUE&pproSepaMandateUrl=SOME_STRING_VALUE",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
}

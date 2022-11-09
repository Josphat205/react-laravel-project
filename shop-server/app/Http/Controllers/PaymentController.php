<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
class PaymentController extends Controller
{
    //
    public function paymentApi(Request $req){
       // Set your app credentials
        $username   = "sandbox";
        $apikey     = "858086c813bb05e25be29dbc817bb70de045de879f08d45e9bbd86e6237444bf";

        // Initialize the SDK
        $AT         = new AfricasTalking($username, $apikey);

        // Get the payments service
        $payments   = $AT->payments();

        // Set the name of your Africa's Talking payment product
        $productName  = "Flight_payment";

        // Set the phone number you want to send to in international format
        $phoneNumber  = $req->phone;

        // Set The 3-Letter ISO currency code and the checkout amount
        $currencyCode = "KES";
        $amount       = $req->amount;

        // Set any metadata that you would like to send along with this request.
        // This metadata will be included when we send back the final payment notification
        $metadata = [
            "agentId"   => "654",
            "productId" => "321"
        ];

        // Thats it, hit send and we'll take care of the rest.

            $result = $payments->mobileCheckout([
                "productName"  => $productName,
                "phoneNumber"  => $phoneNumber,
                "currencyCode" => $currencyCode,
                "amount"       => $amount,
                "metadata"     => $metadata
            ]);

            return response()->json([
                'result'=>$result
            ]);

    }
}
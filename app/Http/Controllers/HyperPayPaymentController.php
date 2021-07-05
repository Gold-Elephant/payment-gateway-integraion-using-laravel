<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HyperPayPaymentController extends Controller
{
    public function checkout(Request $request)
    {
        return view('hyperpay.checkout1');
    }

    public function result(Request $request) {
        $data = session("data");
        $url = "https://test.oppwa.com" . $request->input('resourcePath');
        $url .= "?entityId=" . $data["entityId"];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGFjN2E0Yzc3NTBjNWE2ZjAxNzUxNzc5MzRiZDExYWN8eEttQzh0TURmWQ=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = json_decode(curl_exec($ch), true);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        if(isset($responseData["amount"]) && $responseData["amount"] == $data["amount"] && $responseData["currency"] == $data["currency"] && $responseData["paymentType"] == $data["paymentType"]) {
            return redirect("/hyperpay/checkout")->with("message", "success");
        }
        else {
            return redirect("/hyperpay/checkout")->with("message", "failed");
        }
    }

    public function creditPayment(Request $request)
    {
        $amount = $request->except("_token");
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8ac7a4c7750c5a6f0175177982f011b0" .
                    "&amount=92.00" .
                    "&currency=SAR" .
                    "&paymentType=DB";
        $resData = $this->request($url, $data);
        return $resData;
    }
    public function fastCheck(Request $request){
        $data = $request->except("_token");
        
        dd($data);
    }

    public function creditResult(Request $request ) {
        $res = $request->except("_token");
        $url = "https://test.oppwa.com/".$res['resourcePath'];
        $data = "";
        $resData = $this->request($url, $data);
        dd($resData);
        echo $resData;
        
    }
    public function finalize(Request $request) {
        dd($request);
    }
    public function finalizes(Request $request) {
        dd($request);
    }





    private function request($url, $data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGFjN2E0Yzc3NTBjNWE2ZjAxNzUxNzc5MzRiZDExYWN8eEttQzh0TURmWQ=='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }
}

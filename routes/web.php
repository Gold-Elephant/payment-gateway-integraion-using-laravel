<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('hyperpay/checkout', 'HyperPayPaymentController@checkout')->name('checkout');
Route::get('hyperpay/result', 'HyperPayPaymentController@result')->name('result');
Route::post('hyperpay/credit/payment', 'HyperPayPaymentController@creditPayment')->name('creditPayment');
Route::post('/hyperpay/fastCheck', 'HyperPayPaymentController@fastCheck');
Route::get('/hyperpay/getCheckoutID', function(Request $request) {

    $url = "https://test.oppwa.com/v1/checkouts";
    if($request->input("method") == "visa") {
        $data = array("entityId"=>"8ac7a4c7750c5a6f0175177982f011b0",
                      "amount"=>"92.00",
                      "currency"=>"SAR",
                      "paymentType"=>"DB");
        // $data = "entityId=8ac7a4c7750c5a6f0175177982f011b0" .
        //             "&amount=92.00" .
        //             "&currency=SAR" .
        //             "&paymentType=DB";
    } else if($request->input("method") == "mada"){
        $data = array("entityId"=>"8ac7a4c8750c64ce0175178f7a6c1823",
                      "amount"=>"92.00",
                      "currency"=>"SAR",
                      "paymentType"=>"DB");
        // $data = "entityId=8ac7a4c8750c64ce0175178f7a6c1823" .
        //             "&amount=92.00" .
        //             "&currency=SAR" .
        //             "&paymentType=DB";
    } else {
        return "";
    }
    session(["data"=> $data]);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjN2E0Yzc3NTBjNWE2ZjAxNzUxNzc5MzRiZDExYWN8eEttQzh0TURmWQ=='));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = json_decode(curl_exec($ch));
    if(curl_errno($ch)) {
        return curl_error($ch);
    }
    curl_close($ch);
    return $responseData->id;
});
Route::get('/hyperpay/credit/result','HyperPayPaymentController@creditResult');
Route::get('hyperpay/finalize', 'HyperPayPaymentController@finalize')->name('finalize');
Route::post('hyperpay/finalize', 'HyperPayPaymentController@finalizes')->name('finalize');
// Route::post('hyperpay/payment-status', 'HyperPayPaymentController@paymentStatus')->name('payment-status');

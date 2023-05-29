<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;

// use Karim007\LaravelBkash\Facade\BkashPayment;
// use Karim007\LaravelBkash\Facade\BkashRefund;

class BkashPaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }
    public function createPayment(Request $request)
    {
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011';
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = 100;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");;

        $request_data_json = json_encode($request->all());

        $response =  BkashPaymentTokenize::cPayment($request_data_json);
        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont.. default param is 1

        //store paymentID and your account number for matching in callback request
        // dd($response) //if you are using sandbox and not submit info to bkash use it for 1 response


        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        else return redirect()->back()->with('error-alert2', $response['statusMessage']);
    }

    public function callBack(Request $request)
    {
        //callback request params
        // paymentID=TR00117B1674409647770&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params

        if ($request->status == 'success') {
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

            if (!$response) {
                $response =  BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

            }
            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */
                return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        } else if ($request->status == 'cancel') {
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        } else {
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }
    public function searchTnx($trxID)
    {
        //response
        /*{
        "trxID":"AAN60A8IOQ",
       "initiationTime":"2023-01-23T12:06:05:000 GMT+0600",
       "completedTime":"2023-01-23T12:06:05:000 GMT+0600",
       "transactionType":"bKash Tokenized Checkout via API",
       "customerMsisdn":"01877722345",
       "transactionStatus":"Completed",
       "amount":"20",
       "currency":"BDT",
       "organizationShortCode":"50022",
       "statusCode":"0000",
       "statusMessage":"Successful"
    }*/
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

    }
    public function refund(Request $request)
    {
        $paymentID = 'paymentID';
        $trxID = 'trxID';
        $amount = 5;
        $reason = 'this is test reason';
        $sku = 'abc';
        //response
        /*{
            "statusCode":"0000",
           "statusMessage":"Successful",
           "originalTrxID":"AAN30A8M4T",
           "refundTrxID":"AAN30A8M5N",
           "transactionStatus":"Completed",
           "amount":"5",
           "currency":"BDT",
           "charge":"0.00",
           "completedTime":"2023-01-23T15:53:29:120 GMT+0600"
        }*/
        return BkashRefundTokenize::refund($paymentID, $trxID, $amount, $reason, $sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

    }
    public function refundStatus(Request $request)
    {
        $paymentID = 'paymentID';
        $trxID = 'trxID';
        /*{
            "statusCode":"0000",
           "statusMessage":"Successful",
           "originalTrxID":"AAN30A8M4T",
           "refundTrxID":"AAN30A8M5N",
           "transactionStatus":"Completed",
           "amount":"5",
           "currency":"BDT",
           "charge":"0.00",
           "completedTime":"2023-01-23T15:53:29:120 GMT+0600"
        }*/
        return BkashRefundTokenize::refundStatus($paymentID, $trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

    }
}

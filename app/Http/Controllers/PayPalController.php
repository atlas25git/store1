<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Mail\OrderPaid;
use Illuminate\Http\Request;
use App\Services\PaypalService;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    private $paypalService;

    // function __construct(PaypalService $paypalService){

    //     $this->paypalService = $paypalService;

    // }


    public function getExpressCheckout()
    {
        $cart = \Cart::session(auth()->id());
        //dd($cart->getContent()->toarray());
        // $checkoutData = [
        //     'items'=> [
        //         [
        //             'name' => 'Product 1',
        //              'price'=>9.99,
        //              'qty'=>1,
        //         ],
        //         [
        //             'name' => 'Product 2',
        //              'price'=>9.99,
        //              'qty'=>1,
        //         ],
        //         ],
        //             'return_url'=>route('paypal.success'),
        //             'cancel_url'=>route('paypal.cancel'),
        //             'invoice_id'=>uniqid(),
        //             'invoice_description'=>"order description"

        //     ];

        $cartItems = array_map(function($item){
            return [
                'name'=>$item['name'],
                'price'=>$item['price'],
                'qty'=>$item['quantity']
            ];
         }, $cart->getContent()->toarray());

        $checkoutData = [
            'items'=> $cartItems,
                    'return_url'=>route('paypal.success'),
                    'cancel_url'=>route('paypal.cancel'),
                    'invoice_id'=>uniqid(),
                    'invoice_description'=>"order description"

            ];
            

            $provider = new ExpressCheckout();



    // Through facade. No need to import namespaces
    //$provider = PayPal::setProvider($checkoutData);

        // Through facade. No need to import namespaces
            $response =  $provider->setExpressCheckout($checkoutData);
            dd($response);
    }



    public function cancelPage()
    {
        dd('payment failed');
    }


    public function getExpressCheckoutSuccess(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        $response = $this->paypalService->captureOrder($order->paypal_orderid);

        if ($response->result->status == 'COMPLETED') {
            $order->is_paid = 1;
            $order->save();
            \Cart::session(auth()->id())->clear();

            Mail::to($order->user->email)->send(new OrderPaid($order));
            return redirect()->route('home')->withMessage('Payment successful!');

        }

        return redirect()->route('home')->withError('Payment UnSuccessful! Something went wrong!');


    }
}
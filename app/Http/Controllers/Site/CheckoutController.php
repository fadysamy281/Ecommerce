<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\OrderInterface;
use App\Services\PayPalService;

class CheckoutController extends Controller
{
    protected $orderRepository , $payPal;

    public function __construct(OrderInterface $orderRepository, PayPalService $payPal)
    {
        $this->payPal = $payPal;
        $this->orderRepository = $orderRepository;
    }
    public function getCheckout()
    {
        return view('site.pages.checkout');
    }

    public function placeOrder(Request $request)
    {

        $order = $this->orderRepository->storeOrderDetails($request->all());

        //  add more control here to handle if the order
        // is not stored properly
        if ($order) {
            $this->payPal->processPayment($order);
        }

        return back()->with('message','Order not placed');
    }
    
    //Completing PAYMENT
    public function complete(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $status = $this->payPal->completePayment($paymentId, $payerId);

        $order = Order::where('order_number', $status['invoiceId'])->first();
        $order->status = 'processing';
        $order->payment_status = 1;
        $order->payment_method = 'PayPal -'.$status['salesId'];
        $order->save();

        Cart::clear();
        return view('site.pages.success', compact('order'));
    }
}

<?php

namespace App\service;

use \Stripe\StripeClient;

class PaymentService
{

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->stripe = new StripeClient('sk_test_51JNEPiKtBjvNOtXeAdW8r0aTggNOiLbC7jWDdTfG0ohseQ1vr1plhshWzTlfNz6B1Lk1ygnDDdoTbfusMFxGMBFm00qxDPgMsF');
    }

    public function create()
    {
        $cart = $this->cartService->get();
        $items = [];
        foreach ($cart['elements'] as $nosPlatsId => $element)
        {
            $items[] = [
                'amount' => $element['nosPlats']->getPrice() * 100,
                'quantity' => $element['quantity'],
                'currency' => 'eur',
                'name' => $element['nosPlats']->getName()
            ];
        }

        $protocol = 'http';
        $host = $_SERVER['SERVER_NAME'];
        $successUrl = $protocol . '://'. $host . '/payment/success/{CHECKOUT_SESSION_ID}';
        $failureUrl = $protocol . '://'. $host . '/payment/failure/{CHECKOUT_SESSION_ID}';

        $session = $this->stripe->checkout->sessions->create([
            'success_url' => $successUrl,
            'cancel_url' => $failureUrl,
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => $items 
        ]);

        return $session->id;
    }

}
<?php

namespace App\Controller;


use App\Entity\NosPlats;
use App\service\CartService;
use App\service\PaymentService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_index")
     */
    public function index(CartService $cartService): Response
    {

        $cart = $cartService->get();
        return $this->render('cart/index.html.twig', [
            'cart' => $cart
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add(NosPlats $nosPlats, CartService $cartService): Response
    {
        $cartService->add($nosPlats);
        return $this->redirectToRoute('cart_index');
    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove(NosPlats $nosPlats, CartService $cartService): Response
    {

        $cartService->remove($nosPlats);
        return $this->redirectToRoute('cart_index');
    }

    /**
     * @Route("/cart/clear", name="cart_clear")
     */
    public function clear(CartService $cartService): Response
    {

        $cartService->clear();
        return $this->redirectToRoute('cart_index');
    }


    /**
     * @Route("/cart/valider", name="cart_valider")
     */
    public function validate(PaymentService $paymentService): Response
    {
        $stripeSessionId = $paymentService->create();

        return $this->render('cart/redirect.html.twig', [
            'stripeSessionId' => $stripeSessionId
        ]);
    }

}

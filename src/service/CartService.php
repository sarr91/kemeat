<?php

namespace App\service;

use App\Entity\NosPlats;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    // je crée une propriété 
    private $sessionInterface;

    // je crée une injection de dépendance avec construct pour la sessionInterface
    public function __construct(SessionInterface $sessionInterface)
    {
        $this->sessionInterface = $sessionInterface;
    }

    // je crée mes fonctionnalités pour récupéré un panier
    public function get()
    {
        return $this->sessionInterface->get('cart', [
            'elements' => [],
            'total' => 0.0
        ]);
    }

    // fonctionalité pour ajouter de plats
    public function add(NosPlats $nosPlats)
    {

        
        $cart = $this->get();
        $nosPlatsId = $nosPlats->getId();

        if (!isset($cart['elements'][$nosPlatsId]))
        {
            $cart['elements'][$nosPlatsId] = [
                'nosPlats' => $nosPlats,
                'quantity' => 0
            ];
        }

        $cart['total'] = $cart['total'] + $nosPlats->getPrice();
        // 
        $cart['elements'][$nosPlatsId]['quantity'] = $cart['elements'][$nosPlatsId]['quantity'] + 1;

        // je sauvegarde
        $this->sessionInterface->set('cart', $cart);
    }

    public function remove(NosPlats $nosPlats): void
    {
        $cart = $this->get();
        $nosPlatsId = $nosPlats->getId();

        if (!isset($cart['elements'][$nosPlatsId]))
        {
            return;
        }

        $cart['total'] = $cart['total'] - $nosPlats->getPrice();
        $cart['elements'][$nosPlatsId]['quantity'] = $cart['elements'][$nosPlatsId]['quantity'] - 1;

        if ($cart['elements'][$nosPlatsId]['quantity'] <= 0)
        {
            unset($cart['elements'][$nosPlatsId]);
        }

        $this->sessionInterface->set('cart', $cart);
    }

    public function clear()
    {
        $this->sessionInterface->clear('cart');
    }
}
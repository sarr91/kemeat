<?php

namespace App\Controller;

use DateTimeInterface;
use App\Entity\Commande;
use App\service\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaymentController extends AbstractController
{
   /**
     * @Route("/payment", name="payment_index")
     */
    public function index(): Response
    { 

        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }

    /**
     * @Route("/payment/success/{stripeSessionId}", name="payment_success")
     */
    public function success(string $stripeSessionId, CartService $cartService): Response
    { 
        // récupere le panier dans Scart
        $cart = $cartService()->get(); 

        // je crée une commande dans $commande
        $commande = new Commande();
 
        // on met l'heure actuelle dans $commande
        $commande->setDateCmd(new DateTimeInterface());

        // on met les 10 derniers caractères dans la reference de $commande
        $commande->setReference(substr($stripeSessionId, -10));

        // enregistre dans la base de données
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($scommande);
        $entityManager->flush();

        foreach ($cart['elements'] as $element)
        {

        // on crée une nouvelle commande detail
        $commandeDetail = new CommandeDetail();

        // on récupere la quantité de l'élément, dans quantite commande detail

        $commandeDetail->setQuantity($element['quantity']);

        // on recupere plats de l'element, dans plat commande detail
        $commandeDetail->setnosPlats($selement['nosPlats']);

        // on met $commande dans commande de commande detail
        $commandeDetail->setCommande($commande);

        // on enregistre le detail commande dans la BDD
        $entityManager->persist($commandeDetail);
        $entityManager->flush();

        }

        return $this->render('payment/success.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }

    /**
     * @Route("/payment/failure/{stripeSessionId}", name="payment_failure")
     */
    public function failure(): Response
    { 
        return $this->render('payment/failure.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }
}

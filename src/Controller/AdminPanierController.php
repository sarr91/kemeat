<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Form\PanierType;
use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route("/admin/panier")
 */
class AdminPanierController extends AbstractController
{
    /**
     * @Route("/", name="admin_panier_index", methods={"GET"})
     */
    public function index(SessionInterface $sessionInterface): Response
    {
        
        // 1. On récupère le panier s'il existe, sinon on en reprend un nouveau
        $cart = $sessionInterface->get('cart');
        if ($cart === null)
        {
             $cart = [
                'total' => 0.0,
                'elements' => []
            ];
        }

        return $this->render('admin_panier/index.html.twig', [
            'cart' => $cart,
        ]);
    }

    /**
     * @Route("/admin/panier/ajouter/{id}", name="admin_panier_add", methods={"GET"})
     */
    public function add(Panier $panier, SessionInterface $sessionInterface): Response
    {
        
        // 1. On récupère le panier s'il existe, sinon on en reprend un nouveau
        $cart = $sessionInterface->get('cart');
        if ($cart === null)
        {
             $cart = [
                'total' => 0.0,
                'elements' => []
                ];
        }

        // 2. On ajoute le plat s'il n'y en a pas
        $panierId = $panier->getId();
        if (!isset($cart['elements'][$panierId]))
        {
            $cart['elements'][$panierId] = [
                'panier' => $panier,
                'quantity' => 0
               ];   
        }

        // 3. On incrémente la quantity et on recalcul le prix total
        $cart['elements'][$panierId]['quantity'] = $cart['elements'][$panierId]['quantity'] + 1;
        $cart['total'] = $cart['total'] + $panier->getPrice();
        
        // 4. On sauvegarde le nouveau panier
        $sessionInterface->set('cart', $cart);

        // 5. On redirige l'utilisateur vers la page index du panier
        return $this->redirectToRoute('admin/panier_index');
        
    }
    /**
    * @Route("admin/panier/enlever/{id}", name="admin_panier_enlever")
    */
   public function delete(Book $book, SessionInterface $sessionInterface): Response
   {
       // 1. On récupère le panier s'il existe, sinon on en reprend un nouveau
        $cart = $sessionInterface->get('cart');
        if ($cart === null)
       {
           $cart = [
            'total' => 0.0,
            'elements' => []
            ];
       }

       
       // 2. Si le plat n'est pas dans le panier, on ne fait rien
       $panierId = $panier->getId();
       if (!isset($cart['elements'][$panierId]))
       {
           return $this->redirectToRoute('admin/panier_index');
       }


       // 3. Il existe, alors on met à jour les quantites
       $cart['total'] = $cart['total'] - $panier->getPrice();
       $cart['elements'][$panierId]['quantity'] = $cart['elements'][$panierId]['quantity'] - 1;


       // 4. Si la quantité est de 0, on l'enlève complétement du panier
       if ($cart['elements'][$panierId]['quantity'] <= 0)
       {
           unset($cart['elements'][$panierId]);
       }
       

       // 5. On sauvegarde le panier
       $sessionInterface->set('cart', $cart);

       // 6. On redirige l'utilisateur vers la page index du panier
       return $this->redirectToRoute('admin_panier_index');
   }

    
   // vider un panier 

   /**
    * @Route("admin/panier/vider", name="admin_panier_vider")
    */
   
   public function clear(SessionInterface $sessionInterface): Response
   {
        $sessionInterface->remove('cart');
        return $this->redirectToRoute('admin_panier_index');
   }

   /**
    * @Route("admin/panier/supprimer/{id}", name="admin_panier_supprimer")
    */

   public function removeLine(string $bookId, SessionInterface $sessionInterface): Response
   {
       $cart = $sessionInterface->get('cart');
       if ($cart === null)
       {
           $cart = [
               'total' => 0.0,
               'elements' => []
           ];
       }
       
       $panierId = $panier->getId();
       if (!isset($cart['elements'][$panierId]))
       {
           return $this->redirectToRoute('admin_panier_index');
       }

       $cart['total'] = $cart['total'] - $panier->getPrice() * $cart['elements'][$panierId]['quantity'];

       unset($cart['elements'][$panierId]);

       $sessionInterface->set('cart', $cart);

       return $this->redirectToRoute('admin_panier_index');
   }

   // Valider le panier
}
    
<?php

namespace App\Controller;

use App\Entity\NosPlats;
use App\Form\NosPlatsType;
use App\Repository\NosPlatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/nos/plats")
 */
class AdminNosPlatsController extends AbstractController
{
    /**
     * @Route("/", name="admin_nos_plats_index", methods={"GET"})
     */
    public function index(NosPlatsRepository $nosPlatsRepository): Response
    {
        return $this->render('admin_nos_plats/index.html.twig', [
            'nos_plats' => $nosPlatsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_nos_plats_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $nosPlat = new NosPlats();
        $form = $this->createForm(NosPlatsType::class, $nosPlat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nosPlat);
            $entityManager->flush();

            return $this->redirectToRoute('admin_nos_plats/index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_nos_plats/new.html.twig', [
            'nos_plat' => $nosPlat,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_nos_plats_show", methods={"GET"})
     */
    public function show(NosPlats $nosPlat): Response
    {
        return $this->render('admin_nos_plats/show.html.twig', [
            'nos_plat' => $nosPlat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_nos_plats_edit", methods={"GET","POST"})
     */
    public function edit( NosPlats $nosPlat, Request $request): Response
    {
        $form = $this->createForm(NosPlatsType::class, $nosPlat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_nos_plats/index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_nos_plats/edit.html.twig', [
            'nos_plat' => $nosPlat,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_nos_plats_delete", methods={"POST"})
     */
    public function delete(NosPlats $nosPlat, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nosPlat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nosPlat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_nos_plats/index', [], Response::HTTP_SEE_OTHER);
    }
}

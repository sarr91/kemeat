<?php

namespace App\Controller;

use App\Entity\NosPlats;
use App\Form\NosPlats1Type;
use App\Repository\NosPlatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class NosPlatsController extends AbstractController
{
    /**
     * @Route("/admin/nos/plats/", name="nos_plats_index", methods={"GET"})
     */
    public function index(NosPlatsRepository $nosPlatsRepository): Response
    {
        return $this->render('nos_plats/index.html.twig', [
            'nos_plats' => $nosPlatsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/nos/plats/new", name="nos_plats_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $nosPlat = new NosPlats();
        $form = $this->createForm(NosPlats1Type::class, $nosPlat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg= $form['img']->getData();
            $extensionImg= $infoImg->guessExtension();
            $nomImg = time()."nosplats.".$extensionImg;
            $infoImg->move($this->getParameter('nosplats_folder'), $nomImg);
            $nosPlat->setImg($nomImg);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nosPlat);
            $entityManager->flush();

            return $this->redirectToRoute('nos_plats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nos_plats/new.html.twig', [
            'nos_plats' => $nosPlat,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/nos/plats/{id}", name="nos_plats_show", methods={"GET"})
     */
    public function show(NosPlats $nosPlat): Response
    {
        return $this->render('nos_plats/show.html.twig', [
            'nos_plats' => $nosPlat,
        ]);
    }

    /**
     * @Route("/admin/nos/plats/{id}/edit", name="nos_plats_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NosPlats $nosPlat): Response
    {
        $form = $this->createForm(NosPlats1Type::class, $nosPlat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nos_plats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nos_plats/edit.html.twig', [
            'nos_plats' => $nosPlat,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/nos/plats/{id}", name="nos_plats_delete", methods={"POST"})
     */
    public function delete(Request $request, NosPlats $nosPlat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nosPlat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nosPlat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nos_plats_index', [], Response::HTTP_SEE_OTHER);
    }
}

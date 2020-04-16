<?php

namespace App\Controller;

use App\Entity\Website;
use App\Form\WebsiteType;
use App\Repository\WebsiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(WebsiteRepository $websiteRepo)
    {
        $website = $websiteRepo->findAll();
        return $this->render('admin/admin.html.twig', [
            'websites' => $website
        ]);
    }

    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login(AuthenticationUtils $auth)
    {
        $error = $auth->getLastAuthenticationError();
        return $this->render('admin/login.html.twig', [
            'error' => $error !== null
        ]);
    }

    /**
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logout()
    {
        $this->addFlash('danger', 'Vous avez été déconnecté');
    }

    /**
     * @Route("/admin/new", name="admin_new")
     */
    public function newWebsite(Request $request, EntityManagerInterface $manager)
    {
        $website = new Website();
        $form = $this->createForm(WebsiteType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($website);
            $manager->flush();
            $this->addFlash('success', 'Vous avez ajouté un nouveau site');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}/delete", name="admin_delete")
     */
    public function deleteWebsite(Website $website, EntityManagerInterface $manager)
    {
        $manager->remove($website);
        $manager->flush();
        $this->addFlash('danger', 'Le site  été supprimer de votre dashboard');
        return $this->redirectToRoute('admin_dashboard');
    }

    /**
     * @Route("/admin/{id}/edit", name="admin_edit")
     */
    public function editWebsite(Website $website, EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(WebsiteType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($website);
            $manager->flush();
            $this->addFlash('success', 'Vous avez modifier le website');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Website;
use App\Form\WebsiteType;
use App\Repository\WebsiteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/admin/new", name="admin_new")
     */
    public function newWebsite()
    {
        $website = new Website();
        $form = $this->createForm(WebsiteType::class, $website);
        return $this->render('admin/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

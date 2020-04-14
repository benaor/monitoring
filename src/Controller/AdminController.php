<?php

namespace App\Controller;

use App\Repository\WebsiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(WebsiteRepository $websiteRepo)
    {
        $website = $websiteRepo->findAll();
        return $this->render('admin/admin.html.twig', [
            'websites'=> $website
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\WebsiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(WebsiteRepository $websiteRepo)
    {
        $websites = $websiteRepo->findAll();
        return $this->render('home/index.html.twig', [
            'websites' => $websites,
        ]);
    }

    /**
     * @Route("/website/{id}", name="website_show")
     */
    public function show()
    {
        return $this->render('home/show.html.twig', [
            
        ]);
    }
}

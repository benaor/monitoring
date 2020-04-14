<?php

namespace App\Controller;

use App\Entity\Status;
use App\Entity\Website;
use App\Repository\WebsiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/website/analyse", name="analyse")
     */
    public function analyse(WebsiteRepository $websiteRepo, EntityManagerInterface $manager)
    {
        // Recuperate All websites
        $websites = $websiteRepo->findAll();

        // recuperate status of actualy this one
        foreach ($websites as $key => $site) {
            $url = $site->getUrl();
            $handle = curl_init($url);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($handle);
            $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
            curl_close($handle);
            
            $status = new Status();
            $status->setCode($code)
                    ->setReportedAt(new \DateTime())
                    ->setWebsite($site);
            $manager->persist($status);
        }
        $manager->flush();
        // create new entity status et register in database
        // redirect to route ('home')
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/website/{id}", name="website_show")
     */
    public function show(Website $website)
    {
        return $this->render('home/show.html.twig', [
            'website' => $website
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FrontController extends AbstractController
{
    /**
     * @Route("/front", name="app_homepage")
     */
    public function index(): Response
    {
        return $this->render('front/index.html.twig');
    }

    public static function getSubscribedServices(): array
    {
        return array_merge(parent::getSubscribedServices(), [
            'app.text_format' => 'App\Services\TextFormat',
        ]);
    }

    /**
     * @Route("/service", name="app_service_text_format")
     */
    public function indexAction() {

        $service = $this->get('app.text_format');
        return new Response($service->removeSpecialChar('******esprit $******* *^$ è ; ?'));
    }
}

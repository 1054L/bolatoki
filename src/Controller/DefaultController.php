<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // return $this->render('base.html.twig'); // Renderiza una plantilla (ajusta el nombre)
        return new Response('¡Hola desde la raíz!'); // Devuelve una respuesta simple
    }
}
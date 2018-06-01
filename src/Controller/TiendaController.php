<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TiendaController extends Controller
{
    /**
     * @Route("/tienda", name="tienda_home")
     */
    public function index()
    {
        return $this->render('tienda/index.html.twig', [
            'controller_name' => 'TiendaController',
        ]);
    }
}
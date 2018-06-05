<?php

namespace App\Controller;

use App\Entity\Producto;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TiendaController extends Controller
{
    /**
     * @Route("/tienda", name="tienda_home")
     */
    public function index()
    {
		$repo = $this->getDoctrine()->getRepository(Producto::class);
        $vectorproductos = $repo->findAll();

        return $this->render('tienda/index.html.twig', [
            'productos' =>  $vectorproductos,
        ]);
    }


}
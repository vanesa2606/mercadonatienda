<?php

namespace App\Controller;

use App\Entity\PedidoProductoCantidad;
use App\Form\PedidoProductoCantidadType;
use App\Repository\PedidoProductoCantidadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pedido/producto/cantidad")
 */
class PedidoProductoCantidadController extends Controller
{
    /**
     * @Route("/", name="pedido_producto_cantidad_index", methods="GET")
     */
    public function index(PedidoProductoCantidadRepository $pedidoProductoCantidadRepository): Response
    {
        return $this->render('pedido_producto_cantidad/index.html.twig', ['pedido_producto_cantidads' => $pedidoProductoCantidadRepository->findAll()]);
    }

    /**
     * @Route("/new", name="pedido_producto_cantidad_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $pedidoProductoCantidad = new PedidoProductoCantidad();
        $form = $this->createForm(PedidoProductoCantidadType::class, $pedidoProductoCantidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pedidoProductoCantidad);
            $em->flush();

            return $this->redirectToRoute('pedido_producto_cantidad_index');
        }

        return $this->render('pedido_producto_cantidad/new.html.twig', [
            'pedido_producto_cantidad' => $pedidoProductoCantidad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pedido_producto_cantidad_show", methods="GET")
     */
    public function show(PedidoProductoCantidad $pedidoProductoCantidad): Response
    {
        return $this->render('pedido_producto_cantidad/show.html.twig', ['pedido_producto_cantidad' => $pedidoProductoCantidad]);
    }

    /**
     * @Route("/{id}/edit", name="pedido_producto_cantidad_edit", methods="GET|POST")
     */
    public function edit(Request $request, PedidoProductoCantidad $pedidoProductoCantidad): Response
    {
        $form = $this->createForm(PedidoProductoCantidadType::class, $pedidoProductoCantidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pedido_producto_cantidad_edit', ['id' => $pedidoProductoCantidad->getId()]);
        }

        return $this->render('pedido_producto_cantidad/edit.html.twig', [
            'pedido_producto_cantidad' => $pedidoProductoCantidad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pedido_producto_cantidad_delete", methods="DELETE")
     */
    public function delete(Request $request, PedidoProductoCantidad $pedidoProductoCantidad): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pedidoProductoCantidad->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pedidoProductoCantidad);
            $em->flush();
        }

        return $this->redirectToRoute('pedido_producto_cantidad_index');
    }
}

<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Genre;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/genre")
 */
class GenreController extends Controller
{

    /**
     * @Route("/add")
     */
    public function addAction(Request $request){

        $genre = new Genre();

        $form = $this->createFormBuilder($genre)
        ->add("nom", TextType::class, array(
            "label" => "Genre",
        ))
        ->add("save", SubmitType::class)
        ->getForm();

        $form->handleRequest($request);

        if  ($form->isValid() && $form->isSubmitted()){

            $genre = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush();

            return new Response($genre->getNom() . " à bien été ajouté a la liste des genres");
        }

        return $this->render("addGenre.html.twig", array(
            "formulaire" => $form->createView(),
        ));
    }

    /**
     * @Route("/show")
     */
    public function showAction()
    {
        $liste = $this->getDoctrine()
        ->getRepository(Genre::class)
        ->findAll();

        return $this->render("showGenre.html.twig",array(
            "liste" => $liste,
        ));
    }
    
}
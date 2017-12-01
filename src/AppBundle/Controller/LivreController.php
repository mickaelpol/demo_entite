<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Genre;
use AppBundle\Entity\Livre;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @Route("/livre")
 */
class LivreController extends Controller
{
    

    /**
     * @Route("/add")
     */
    public function addAction(Request $request)
    {
        $livre = new Livre();

        $liste = $this->getDoctrine()
        ->getRepository(Genre::class)
        ->findAll();

        $form = $this->createFormBuilder($livre)
        ->add("nom", TextType::class, array(
            "label" => "nom",
        ))
        ->add("genre", ChoiceType::class, array(
            "choices" => $liste,
            "choice_label" => "nom",
            "choice_value" => "id",
        ))
        ->add("save", SubmitType::class, array(
            "label" => "enregistrer",
        ))
        ->getForm(); 

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){

            $livre = $form->getData();
            $em = $this->getDoctrine()
            ->getManager();
            $em->persist($livre);
            $em->flush();

            return new Response($livre->getNom(). " à bien été ajouté");
            
        }
        
        return $this->render("addLivre.html.twig", array(
            "formulaire" => $form->createView()
        ));
    }

    /**
     * @Route("/show")
     */
    public function showAction()
    {
        $liste = $this->getDoctrine()
        ->getRepository(Livre::class)
        ->findAll();

        //var_dump($liste[0]);
        
        return $this->render("showLivre.html.twig", array(
            "listeLivre" => $liste
        ));
    }
}
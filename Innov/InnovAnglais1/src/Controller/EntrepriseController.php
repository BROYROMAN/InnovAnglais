<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Entreprise;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class EntrepriseController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index()
    {
        return $this->render('abonnements/index.html.twig', [
            'controller_name' => 'AbonnementsController',
        ]);
    }
    
     /**
* @Route("/entreprise_modifier/{id}", name="entreprise_modifier")
*/
    public function modifierEntreprise(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Entreprise::class); 
        $entreprise = $repository->find($request->get('id'));
        $form = $this->createFormBuilder($entreprise)
            ->add('libelle', TextType::class)
                        
            ->add('save', SubmitType::class, array('label' => 'Modifier'))
            ->getForm();
        if ($request->isMethod('POST')){
            $form -> handleRequest ($request);
            if($form->isValid()){
              $em = $this->getDoctrine()->getManager();
              $em->persist($entreprise);
              $em->flush();
        } 
    } 
        return $this->render('entreprise/modifentreprise.html.twig', ['form'=>$form->createView()]);
    }
    
     /**
     * @Route("/entreprise", name="entreprise")
     */
    public function entreprise(Request $request)
    {
        $entreprise = new Entreprise();
         $form = $this->createFormBuilder($entreprise)
        ->add('libelle', TextType::class)
       
                 
         ->add('save', SubmitType::class, array('label' => 'Ajouter'))
         ->getForm();
        if ($request->isMethod('POST')){
            
            $form -> handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                
             
                $em->persist($entreprise);
                                $em->flush();
               
            }
        }   
        
 return $this->render('entreprise/entreprise.html.twig', ['form' => $form->createView()]);
    
    }
    
    
    /**
     * @Route("/listeentreprise", name="listeentreprise")
     */
    public function listeEntreprise(Request $request)
    {
      $repository=$this->getDoctrine()->getManager()->getRepository(Entreprise::class);
       $entreprise = new Entreprise();
        $form = $this->createFormBuilder($entreprise)
        ->add('save', SubmitType::class, array('attr'=>array('class'=>'save'),'label'=>'Supprimer'))
        ->getForm(); 
            if ($request->isMethod('POST')){
            $form -> handleRequest($request);
            if($form->isValid()){
                $cocher = $request->request->get('cocher'); 
                foreach($cocher as $i){
                    $u = $repository->find($i);  
                    $this->getDoctrine()->getManager()->remove($u);      
                }
                $this->getDoctrine()->getManager()->flush();
            }           
        }
      $listeEntreprise=$repository->findAll();
        return $this->render('entreprise/listeentreprise.html.twig',array('liste'=>$listeEntreprise,'form' =>$form->createView(), ['controller_name' => 'AccueilController',
        ]));
    }
    
    
    
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Abonnements;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class AbonnementsController extends AbstractController
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
* @Route("/abonnements_modifier/{id}", name="abonnements_modifier")
*/
    public function modifierAbonnements(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Abonnements::class); 
        $abonnements = $repository->find($request->get('id'));
        $form = $this->createFormBuilder($abonnements)
            ->add('libelle', TextType::class)
            ->add('paiment', TextType::class)            
            ->add('save', SubmitType::class, array('label' => 'Modifier'))
            ->getForm();
        if ($request->isMethod('POST')){
            $form -> handleRequest ($request);
            if($form->isValid()){
              $em = $this->getDoctrine()->getManager();
              $em->persist($abonnements);
              $em->flush();
        } 
    } 
        return $this->render('abonnements/modifabonnements.html.twig', ['form'=>$form->createView()]);
    }
    
     /**
     * @Route("/abonnements", name="abonnements")
     */
    public function abonnements(Request $request)
    {
        $abonnements = new Abonnements();
         $form = $this->createFormBuilder($abonnements)
        ->add('libelle', TextType::class)
       
                 ->add('paiment', ChoiceType::class, array(
                     'mapped'=>true,
            
    'choices'  => array( 'CARTE_BANCAIRE' => 'CARTE_BANCAIRE','PAYPAL' => 'PAYPAL', 'CHEQUE'=>'CHEQUE')
))
         ->add('save', SubmitType::class, array('label' => 'Ajouter'))
         ->getForm();
        if ($request->isMethod('POST')){
            
            $form -> handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                
             
                $em->persist($abonnements);
                                $em->flush();
               
            }
        }   
        
 return $this->render('abonnements/abonnements.html.twig', ['form' => $form->createView()]);
    
    }
    
    
    /**
     * @Route("/listeabonnements", name="listeabonnements")
     */
    public function listeAbonnements(Request $request)
    {
      $repository=$this->getDoctrine()->getManager()->getRepository(Abonnements::class);
       $abonnements = new Abonnements();
        $form = $this->createFormBuilder($abonnements)
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
      $listeAbonnements=$repository->findAll();
        return $this->render('abonnements/listeabonnements.html.twig',array('liste'=>$listeAbonnements,'form' =>$form->createView(), ['controller_name' => 'AccueilController',
        ]));
    }
    
    
    
}

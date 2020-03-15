<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Test;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class TestController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index()
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    
     /**
* @Route("/test_modifier/{id}", name="test_modifier")
*/
    public function modifierTest(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Test::class); 
        $test = $repository->find($request->get('id'));
        $form = $this->createFormBuilder($test)
            ->add('niveau', TextType::class)
            ->add('theme', EntityType::class, array(
        'class' => 'App\Entity\Theme',
        'choice_label' => 'libelle'))            
            ->add('save', SubmitType::class, array('label' => 'Modifier'))
            ->getForm();
        if ($request->isMethod('POST')){
            $form -> handleRequest ($request);
            if($form->isValid()){
              $em = $this->getDoctrine()->getManager();
              $em->persist($test);
              $em->flush();
        } 
    } 
        return $this->render('test/modiftest.html.twig', ['form'=>$form->createView()]);
    }
    
     /**
     * @Route("/test", name="test")
     */
    public function test(Request $request)
    {
        $test = new Test();
         $form = $this->createFormBuilder($test)
        ->add('niveau', TextType::class)
       
                ->add('theme', EntityType::class, array(
        'class' => 'App\Entity\Theme',
        'choice_label' => 'libelle'))  
         ->add('save', SubmitType::class, array('label' => 'Ajouter'))
         ->getForm();
        if ($request->isMethod('POST')){
            
            $form -> handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                
             
                $em->persist($test);
                                $em->flush();
               
            }
        }   
        
 return $this->render('test/test.html.twig', ['form' => $form->createView()]);
    
    }
    
    
    /**
     * @Route("/listetest", name="listetest")
     */
    public function listeTest(Request $request)
    {
      $repository=$this->getDoctrine()->getManager()->getRepository(Test::class);
       $test = new Test();
        $form = $this->createFormBuilder($test)
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
      $listeTest=$repository->findAll();
        return $this->render('test/listetest.html.twig',array('liste'=>$listeTest,'form' =>$form->createView(), ['controller_name' => 'AccueilController',
        ]));
    }
    
    
       /**
     * @Route("/test1/{id}", name="test1")
     */
    public function test1(Request $request)
    {   if (!isset($_SESSION['score'])){
	   $_SESSION['score'] = 0;
	}
        echo 'simple';
        
       echo 'simple2';
      $repository=$this->getDoctrine()->getManager()->getRepository(Test::class);
        $test = $repository->findAllTest();
       // $numero=(int)$_GET["id"];
       $id=$request->get('id');
       $question=$repository->findQuestion($id);
       $choix=$repository->findChoix();
        //$listeTest=$repository->findAll();
        echo 'simple3';
      if ($_POST)  {
            echo 'simple4';
	$number = $_POST['number'];
	$selected_choice = $_POST['choice'];
	$next=$number+1;
	$total=$test['nb'];
        echo $total;
	
        
	//Get correct choice
	$q = $repository->findRep($number);
        $correct_choice=$q["choix_id"];
        
        
	if($correct_choice == $selected_choice){
		$_SESSION['score']++;
	}      
        
      
	if($number == $total){
		 return $this->render('test/fin.html.twig',array('score'=>$_SESSION['score']));
                  
		
	} else {
	        return $this->redirectToRoute('test1',['id' => $next,'score' => $_SESSION['score']]);
        
	}
}
        return $this->render('test/test1.html.twig',array('nombre'=>$test,'numero'=>$id,'question'=>$question,'leschoix'=>$choix,'score'=>$_SESSION['score']));
    }
    
    
    
}

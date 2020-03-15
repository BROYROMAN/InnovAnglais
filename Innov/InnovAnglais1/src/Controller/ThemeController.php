<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Theme;
use App\Repository\ThemeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ThemeController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index()
    {
        return $this->render('theme/index.html.twig', [
            'controller_name' => 'ThemeController',
        ]);
    }
    
     /**
* @Route("/theme_modifier/{id}", name="theme_modifier")
*/
    public function modifierTheme(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Theme::class); 
        $theme = $repository->find($request->get('id'));
        $form = $this->createFormBuilder($theme)
            ->add('libelle', TextType::class)
                   
            ->add('save', SubmitType::class, array('label' => 'Modifier'))
            ->getForm();
        if ($request->isMethod('POST')){
            $form -> handleRequest ($request);
            if($form->isValid()){
              $em = $this->getDoctrine()->getManager();
              $em->persist($theme);
              $em->flush();
        } 
    } 
        return $this->render('theme/modiftheme.html.twig', ['form'=>$form->createView()]);
    }
    
     /**
     * @Route("/theme", name="theme")
     */
    public function theme(Request $request)
    {
        $theme = new Theme();
         $form = $this->createFormBuilder($theme)
        ->add('libelle', TextType::class)
       
                
         ->add('save', SubmitType::class, array('label' => 'Ajouter'))
         ->getForm();
        if ($request->isMethod('POST')){
            
            $form -> handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                
             
                $em->persist($theme);
                                $em->flush();
               
            }
        }   
        
 return $this->render('theme/theme.html.twig', ['form' => $form->createView()]);
    
    }
    
    
    /**
     * @Route("/listetheme", name="listetheme")
     */
    public function listeTheme(Request $request)
    {
      $repository=$this->getDoctrine()->getManager()->getRepository(Theme::class);
       $theme = new Theme();
        $form = $this->createFormBuilder($theme)
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
      $listeTheme=$repository->findAll();
        return $this->render('theme/listetheme.html.twig',array('liste'=>$listeTheme,'form' =>$form->createView(), ['controller_name' => 'AccueilController',
        ]));
    }
     /**
    * @Route("/wsTheme/{id}", name="wsTheme")
    */
    public function wsTheme(Request $request, ThemeRepository $repository)
    {  //$request->get('id')
     $themes = $repository->findAllMotsByTheme($request->get('id'));     
    
       
       return $this->json($themes);
    }
    
    
     /**    * @Route("/wsThemes", name="wsThemes")    */  
    public function wsThemes(Request $request)    {  
        $em = $this->getDoctrine()->getManager();    
        $repository = $em->getRepository(Theme::class);  
        $themes = $repository->findAll(); 
        return $this->json($themes);  
        }
    
}

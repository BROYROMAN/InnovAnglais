<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
    
    
     /**
    * @Route("/inscrire", name="inscrire")
    */
    public function inscrire(Request $request, UserPasswordEncoderInterface $passwordEncoder){
         $user = new User();
         $form = $this->createFormBuilder($user)
         ->add('username', TextType::class)
         ->add('email', TextType::class)
         ->add('nom', TextType::class)
         ->add('prenom', TextType::class)
         ->add('datenaissance', DateType::class,array('widget' => 'single_text','format' => 'yyyy-MM-dd',))
         ->add('password', PasswordType::class)
//        ->add('roles', ChoiceType::class,array(
//            'mapped'=>false,
//            'multiple'=>false,
//           'expanded'=>true,
//            'choices' => array( 'ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_USER'=>'ROLE_USER')
//  ))
                 ->add('roles', ChoiceType::class, array(
                     'mapped'=>false,
            
    'choices'  => array( 'ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_USER'=>'ROLE_USER')
))
         ->add('save', SubmitType::class, array('label' => 'S\'inscrire'))
         ->getForm();
        if ($request->isMethod('POST')){
            
            $form -> handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $user->setRoles(array($request->request->get('form')['roles']));
              $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
                $em->persist($user);
                                $em->flush();
                return $this->redirectToRoute('accueil');
            }
        }   
        
 return $this->render('accueil/inscrire.html.twig', ['form' => $form->createView()]);
    }
}

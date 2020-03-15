<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
         ->add('photo', FileType::class, array('label' => 'Fichier à télécharger'))
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
                 
                  ->add('abonnements', EntityType::class, array(
        'class' => 'App\Entity\Abonnements',
        'choice_label' => 'libelle')) 
                
                ->add('entreprise', EntityType::class, array(
        'class' => 'App\Entity\Entreprise',
        'choice_label' => 'libelle')) 
         ->add('save', SubmitType::class, array('label' => 'S\'inscrire'))
         ->getForm();
        if ($request->isMethod('POST')){
            
            $form -> handleRequest($request);
            
               if ($form->isSubmitted() && $form->isValid()) {
            // La variable  $file sera de type UploadedFile $file 
            $file = $user->getPhoto();
           // On renomme le fichier et on lui redonne son extension pour stocker le tout dans   fileName
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $user->setPhoto($fileName);
            $user->setDate(new \DateTime()); //récupère la date du jour
            $user->setExtension($file->guessExtension()); // Récupère l’extension du fichier
            $user->setTaille($file->getSize()); // getSize contient la taille du fichier envoyé
            $user->setNomoriginalphoto($file->getClientOriginalName()); // getSize contient la taille du fichier envoyé
            try {
                $file->move($this->getParameter('file_directory'),$fileName); // Nous déplaçons le fichier dans le répertoire configuré dans services.yaml
            } catch (FileException $e) {
                // erreur durant l’upload
            } 
        }
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
    
    
     /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
    
}



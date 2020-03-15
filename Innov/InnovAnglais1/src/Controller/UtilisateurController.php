<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use App\Entity\Abonnements;
use App\Entity\Theme;
use App\Entity\Telechargement;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index()
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
    
     /**
* @Route("/utilisateur_modifier/{id}", name="utilisateur_modifier")
*/
    public function modifierUtilisateur(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(User::class); 
        $utilisateur = $repository->find($request->get('id'));
        $form = $this->createFormBuilder($utilisateur)
            ->add('username', TextType::class)
            ->add('email', TextType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('datenaissance', DateType::class,array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',))
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
            ->add('save', SubmitType::class, array('label' => 'Modifier'))
            ->getForm();
        if ($request->isMethod('POST')){
            $form -> handleRequest ($request);
            if($form->isValid()){
              $em = $this->getDoctrine()->getManager();
              $em->persist($utilisateur);
              $em->flush();
        } 
    } 
        return $this->render('utilisateur/modifutilisateur.html.twig', ['form'=>$form->createView()]);
    }
    
     /**
     * @Route("/ajoututilisateur", name="ajoututilisateur")
     */
    public function utilisateur(Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
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
        
 return $this->render('utilisateur/utilisateur.html.twig', ['form' => $form->createView()]);
    
    }
    
    
    /**
     * @Route("/listeutilisateur", name="listeutilisateur")
     */
    public function listeUtilisateur(Request $request)
    {
      $repository=$this->getDoctrine()->getManager()->getRepository(User::class);
       $utilisateur = new User();
        $form = $this->createFormBuilder($utilisateur)
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
      $listeUtilisateur=$repository->findAll();
        return $this->render('utilisateur/listeutilisateur.html.twig',array('liste'=>$listeUtilisateur,'form' =>$form->createView(), ['controller_name' => 'AccueilController',
        ]));
    }
    
    
     /**
     * @Route("/compte", name="compte")
     */
    public function compte(Request $request)
    {
      $repository=$this->getDoctrine()->getManager()->getRepository(User::class);
       $utilisateur = new User();
        $form = $this->createFormBuilder($utilisateur)
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
      $listeUtilisateur=$repository->findAll();
        return $this->render('utilisateur/espacemembre.html.twig',array('liste'=>$listeUtilisateur,'form' =>$form->createView(), ['controller_name' => 'AccueilController',
        ]));
    }
    
     /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
    
      /**
    * @Route("/wsUser", name="wsUser")
    */
    public function wsUser(Request $request)
    {
        $em = $this->getDoctrine()->getManager();  
        $repository = $em->getRepository(User::class);
        $user = $repository->findAll();
       
        for($i=0;$i<count($user);$i++){
         $img_src = $user[$i]->getPhoto();
         $imgbinary = fread(fopen('../public/uploads/fichiers/'.$img_src, "r"), filesize('../public/uploads/fichiers/'.$img_src));
         $user[$i]->setPhoto(base64_encode($imgbinary));
       }
        return $this->json($user);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use App\Entity\Vocabulaire;
use App\Entity\User;
use App\Repository\VocabulaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class VocabulaireController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index()
    {
        return $this->render('vocabulaire/index.html.twig', [
            'controller_name' => 'VocabulaireController',
        ]);
    }
    
     /**
* @Route("/vocabulaire_modifier/{id}", name="vocabulaire_modifier")
*/
    public function modifierVocabulaire(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Vocabulaire::class); 
        $vocabulaire = $repository->find($request->get('id'));
        $form = $this->createFormBuilder($vocabulaire)
            ->add('libelle', TextType::class)
             ->add('categories', ChoiceType::class, array(
                     'mapped'=>true,
            
    'choices'  => array( 'VERBE' => 'VERBE','NOM' => 'NOM', 'ADJECTIF'=>'ADJECTIF')
))    
            ->add('save', SubmitType::class, array('label' => 'Modifier'))
            ->getForm();
        if ($request->isMethod('POST')){
            $form -> handleRequest ($request);
            if($form->isValid()){
              $em = $this->getDoctrine()->getManager();
              $em->persist($vocabulaire);
              $em->flush();
        } 
    } 
        return $this->render('vocabulaire/modifvocabulaire.html.twig', ['form'=>$form->createView()]);
    }
    
     /**
     * @Route("/vocabulaire", name="vocabulaire")
     */
    public function vocabulaire(Request $request)
    {
        $vocabulaire = new Vocabulaire();
         
         $form = $this->createFormBuilder($vocabulaire)        
        ->add('libelle', TextType::class)       
        ->add('categories', ChoiceType::class, array('mapped'=>true,'choices'  => array( 'VERBE' => 'VERBE','NOM' => 'NOM', 'ADJECTIF'=>'ADJECTIF')
))         ->add('nom', FileType::class, array('label' => 'Fichier à télécharger'))
                 ->add('user', EntityType::class, array(
        'class' => 'App\Entity\User',
        'choice_label' => 'nom'))
         ->add('save', SubmitType::class, array('label' => 'Ajouter'))
         ->getForm();
         
         
        if ($request->isMethod('POST')){
            
            $form -> handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
            // La variable  $file sera de type UploadedFile $file 
            $file = $vocabulaire->getNom();
           // On renomme le fichier et on lui redonne son extension pour stocker le tout dans   fileName
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $vocabulaire->setNom($fileName);
            $vocabulaire->setDate(new \DateTime()); //récupère la date du jour
            $vocabulaire->setExtension($file->guessExtension()); // Récupère l’extension du fichier
            $vocabulaire->setTaille($file->getSize()); // getSize contient la taille du fichier envoyé
            $vocabulaire->setNomOriginal($file->getClientOriginalName()); // getSize contient la taille du fichier envoyé
            try {
                $file->move($this->getParameter('file_directory'),$fileName); // Nous déplaçons le fichier dans le répertoire configuré dans services.yaml
            } catch (FileException $e) {
                echo "erreur uploads";
            } 
        }
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                
             
                $em->persist($vocabulaire);
                                $em->flush();
               
            }
         }
        
        
        
                $form1 = $this->createFormBuilder($vocabulaire)
        ->add('vocabulaire', EntityType::class, array('mapped'=>false,
        'class' => 'App\Entity\Vocabulaire',
        'choice_label' => 'libelle')) 
        ->add('theme', EntityType::class, array('mapped'=>false,
        'class' => 'App\Entity\Theme',
        'choice_label' => 'libelle')) 
         ->add('save', SubmitType::class, array('label' => 'Ajouter'))
         ->getForm();
        if ($request->isMethod('POST')){
            
            $form1 -> handleRequest($request);
            if($form1->isValid()){
                $repository = $this->getDoctrine()->getManager()->getRepository(Vocabulaire::class); 
                 $v = $repository->findBy($request->get('id'));
                 $repository2 = $this->getDoctrine()->getManager()->getRepository(Theme::class); 
                 $t = $repository2->findBy($request->get('id'));
//                
//             
               $em->persist($v,$t);
                               $em->flush();
               
            }
        }  
        
        
 return $this->render('vocabulaire/vocabulaire.html.twig', ['form' => $form->createView(),'form1' => $form1->createView()]);
    
    }
    
    /**
     * @Route("/listevocabulaire", name="listevocabulaire")
     */
    public function listeVocabulaire(Request $request)
    {
      $repository=$this->getDoctrine()->getManager()->getRepository(Vocabulaire::class);
       $vocabulaire = new Vocabulaire();
        $form = $this->createFormBuilder($vocabulaire)
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
      $listeVocabulaire=$repository->findAll();
        return $this->render('vocabulaire/listevocabulaire.html.twig',array('liste'=>$listeVocabulaire,'form' =>$form->createView(), ['controller_name' => 'AccueilController',
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
    * @Route("/wsVocabulaire", name="wsVocabulaire")
    */
    public function wsVocabulaire(Request $request)
    {
        $em = $this->getDoctrine()->getManager();  
        $repository = $em->getRepository(Vocabulaire::class);
        $vocabulaire = $repository->findBy(['user' => 1]);
        return $this->json($vocabulaire);
    }
    
    /**
    * @Route("/wsVocabulaire2", name="wsVocabulaire2")
    */
    public function wsVocabulaire2(Request $request,VocabulaireRepository $repository)
    {
        $vocabulaire = $repository->findAllFilesByUser(1);
        return $this->json($vocabulaire);
    }
    
     /**
    * @Route("/wsVocabulaire3/{id}", name="wsVocabulaire3")
    */
    public function wsVocabulaire3(Request $request, VocabulaireRepository $repository)
    {  //$request->get('id')
       $vocabulaires = $repository->findAllFilesByUser($request->get('id'));
       for($i=0;$i<count($vocabulaires);$i++){
         $img_src = $vocabulaires[$i]['nom'];
         $imgbinary = fread(fopen('../public/uploads/fichiers/'.$img_src, "r"), filesize('../public/uploads/fichiers/'.$img_src));
         $vocabulaires[$i]['nom'] = base64_encode($imgbinary);
       }
       return $this->json($vocabulaires);
    }
}

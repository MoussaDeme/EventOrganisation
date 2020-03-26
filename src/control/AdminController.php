<?php


require_once ('view/AdminView.php');
require_once ('model/EventStorage.php');
require_once ('model/AssisterBuilder.php');

/**
 *
 */
class AdminController
{
  private $view;
  private $eventStorage;
  

  function __construct(AdminView $view, EventStorage $evS)
  {
        $this->view = $view;
        $this->eventStorage = $evS;
  }


    public function saveIntervenant(IntervenantBuilder $intervenantBuilder)
    {
      $intervenantBuilder->isValid();
      if ($intervenantBuilder->getError() == null) {

            $intervenant = $intervenantBuilder->createIntervenant();
            
            $avatar = $_FILES['photo'];
            $nom = basename($avatar['name']);
            $chemin = 'upload/' . $nom;
            
          //extesions
          $extensionsValides = array('png','jpeg','gif','jpg');
          $exetensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));       
        
          if(in_array($exetensionUpload,$extensionsValides))
          {
            if (move_uploaded_file($avatar['tmp_name'], $chemin))
            {
                 $intervenant->setPicture($nom);                 
                 $this->eventStorage->createIntervenant($intervenant);                 
                 //var_export($intervenant);      
            }else
            {
                echo 'bonjour';
            }
          }
          else
          {
             echo 'erreur d\'extension';
          }
          $feedback = '<div class="alert alert-success">
          <strong>Ajout réussi!</strong> </div>';
          $this->view->Success($feedback);
          unset($_SESSION['currentNewItervenant']);
      }
      else {
          //var_dump($intervenantBuilder->getData())
          //var_dump($_POST);
        //$this->view->makeIntervenantFormPage($intervenantBuilder);
        $_SESSION['currentNewItervenant']= $intervenantBuilder;
        $this->view->creationIntervenantEchec();

      }
    }

    public function speakersList()
    {
          $list = $this->eventStorage->speakersList();
          $this->view->makeSpeakersListView($list);
    }
    public function showSpeaker($email)
    {
        $intervenant = $this->eventStorage->readSpeaker($email);
        $this->view->makeSpeakerPage($intervenant);
    }

    //
    public function usersList(){
     $this->view->makeUsersListView($this->eventStorage->getUsersList());
    }
    public function showUser($email)
    {
        $user = $this->eventStorage->readUser($email);
        $this->view->makeUserPage($user);
    }

    // formulaire d'un programme
    public function showProgram()
    {
        $list = $this->eventStorage->speakersList();
        $assisterBuilder = new AssisterBuilder(array('date' =>"",'heure_debut' =>"",'heure_fin' =>""));
        $this->view->makeProgramView($assisterBuilder,$list);
    }
    public function saveProgram(AssisterBuilder $assisterBuilder,$content)
    {
        $assisterBuilder->isValid();
        $i = 0;
        if($assisterBuilder->getError()==null)
        {
           $assister = $assisterBuilder->createAssister();
            $this->eventStorage->createProgram($assister,$content);
            $this->view->makeHomePage();
        }else 
        {
          $list = $this->eventStorage->speakersList();
          $i = $this->view->makeProgramView($assisterBuilder,$list);
        }
        return $i;
    }
   
   // liste des progrmmes
    public function showProgramList()
    {
      $list = $this->eventStorage->getProgramList();
      
       $this->view->makeProgramList($list);
    }

    public function formsUpdateSpeaker($email)
       {
            $intervenant = $this->eventStorage->readSpeaker($email);
            $this->view->makeSpeakerUpdatePage($intervenant);
       }
       public function updateSpeaker($email, array $data)
       {
          $intervenant = $this->eventStorage->readSpeaker($email);

          $intervenant->setFirstName($data['nom']);
          $intervenant->setLastName($data['prenom']);
         $intervenant->setAdress($data['adresse']);
          $intervenant->setDiet($data['regimeAlimentaire']);
          $intervenant->setCountry($data['pays']);
          $intervenant->setOrganizaton($data['organisation']);
          $intervenant->setClothingSize($data['tailleVetement']);
          $intervenant->setTelNumber($data['tel']);
          $intervenant->setLogin($data['login']);
          $intervenant->setBio($data['bio']);
          if($_FILES['photo']!==null){
           $avatar = $_FILES['photo'];
            $nom = basename($avatar['name']);
            $chemin = 'upload/' . $nom;
            
          //extesions
          $extensionsValides = array('png','jpeg','gif','jpg');
          $exetensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));       
        
          if(in_array($exetensionUpload,$extensionsValides))
          {
            if (move_uploaded_file($avatar['tmp_name'], $chemin))
            {
                   $intervenant->setPicture($nom);
                    $this->eventStorage->updateSpeaker($email,$intervenant);
                    $this->view->makeHomePage();                     
            }
          //
          }else
          {

            //prevoir une fonction dans la vue pour afficher une erreur d'extexion
            $this->view->makeHomePage();
          }
        }
          
      }
         //
       public function updateProgram($id, $contenu, Assister $assister){
        $this->eventStorage->updateProgram($id, $contenu, $assister);
        $this->view->makeHomePage();
      }

       public function formsUpdateProgram($id, $data)
       {
            $data = $this->eventStorage->readProgram($id);
            $tab2 = $this->eventStorage->readAssister($id);
            foreach ($tab2 as $key => $value) {
                $data[$key] = $value;
            }

            $tab = $this->eventStorage->speakersList();
            
            $this->view->makeUpdateProgramPage($id, $data,$tab);
       }
       public function saveSponsor(SponsorBuilder $sp)
       {
        if ($sp->getError() === null) {
            $sponsor = $sp->createSponsor();
            $avatar = $_FILES['photo'];
            $nom = basename($avatar['name']);
            $chemin = 'upload/' . $nom;
            
          //extesions
          $extensionsValides = array('png','jpeg','gif','jpg');
          $exetensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));       
        
          if(in_array($exetensionUpload,$extensionsValides))
          {
            if (move_uploaded_file($avatar['tmp_name'], $chemin))
            {
                 $sponsor->setPicture($nom);                 
                 $this->eventStorage->createSponsor($sponsor);                 
                 //var_export($intervenant);      
            }else
            {
                echo 'bonjour';
            }
          }
          else
          {
             echo 'erreur d\'extension';
          }
          unset($_SESSION['currentNewSponsors']);
      }
      else {
          //var_dump($intervenantBuilder->getData())
          //var_dump($_POST);
        $this->view->makeSponsorView($sp);
        $_SESSION['currentNewSponsors']= $sp;
        $this->view->creationSponsorsEchec();
      }

   } 
   public function showGenerateExcel()
   {
      $this->eventStorage->generateExcel();
   }
   public function showSponsorList()
   {
      $list = $this->eventStorage->getSponsorList();
      $this->view->makeSponsorList($list);
   }
   public function askingDeletionProgramme($id){
    $this->view->makeProgrammeDeletionPage($id);
   }

   public function deleteProgramme($id){
    $this->eventStorage->deletionProgramme($id);
   }

    public function askingDeletionSpeaker(){
        $this->view->makeSpeakerDeletionPage();
    }

   public function deleteSpeaker(){
        $this->eventStorage->deletionSpeaker();
   }
   public function checkConnexion($data)
   {
    if(key_exists('login', $data)){
       if($this->eventStorage->isConnected($data['login'], $data['pwd']) == true)
       {
           
           $this->view->makeHomePage();
       }else 
       {
          $this->view->connexionAnView();
       }
     }
     else 
     {
        $this->view->connexionAnView();
     }
   }
   public function isConnectedAdmin($data)
   {
      if(key_exists('login',$data) && key_exists('pwd',$data)){
         return $this->eventStorage->isConnected($data['login'], $data['pwd']);
      }
      return false;
   }
   public function deconnexion()
   {
      session_unset();
      session_destroy();
      $this->view->connexionAnView();
   }
  public function formUpdateSponsor(){
      $this->view->sponsorUpdateView();
   }
   public function updateSponsor(){
    $this->eventStorage->updateSponsor();
   }


}


 ?>

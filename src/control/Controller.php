<?php


require_once ('view/View.php');
require_once ('model/EventStorage.php');
/**
 *
 */
class Controller
{
  private $view;
  private $eventStorage;


  function __construct(View $view, EventStorage $evS)
  {
        $this->view = $view;
        $this->eventStorage = $evS;
  }


    public function saveUser(UserBuilder $userBuilder)
    {
      
      $userBuilder->isValid();

      if ($userBuilder->getError() === null) {

            $user = $userBuilder->createUser();
            //var_export($user);
            $avatar = $_FILES['photo'];
            $nom = basename($avatar['name']);
            $chemin = 'upload/' . $nom;
            
          //extesions
          $extensionsValides = array('png','jpeg','gif','jpg','webp');
          $exetensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));       
        
          if(in_array($exetensionUpload,$extensionsValides))
          {
            if (move_uploaded_file($avatar['tmp_name'], $chemin))
            {
                 $user->setPicture($nom);                 
                 $this->eventStorage->create($user);                 
                 //var_export($user);      
            }else
            {
                          }
          }
          else
          {
             
          }
          $this->view->UserCreationSucess();
          unset($_SESSION['currentNewUser']);
      }
      else {
          //var_dump($userBuilder->getData())
          //var_dump($_POST);
        //$this->view->makeUserFormPage($userBuilder);
        $_SESSION['currentNewUser']= $userBuilder;
        $this->view->creationUserEchec();

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

    public function showProgramList()
    {
      $list = $this->eventStorage->getProgramList();
      $this->view->makeProgramList($list);
    }

    public function showSponsorList()
    {
         $list = $this->eventStorage->getSponsorList();
        $this->view->makeSponsorList($list);
    }

}

 ?>

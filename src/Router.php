<?php
    require_once("model/Admin.php");
    require_once("model/User.php");
    require_once("model/Intervenant.php");
    require_once("model/Sponsor.php");
    require_once("view/View.php");
    require_once 'model/UserBuilder.php';
    require_once ('control/Controller.php');
      class Router{
        public function main($bd){


         session_start();

          $feedback = key_exists('feedback', $_SESSION) ? $_SESSION['feedback'] : '';
          $_SESSION['feedback'] ='';
          $tabVide = array('nom' =>"" ,'prenom' =>"" ,'adresse' =>"",'regimeAlimentaire' =>"",'pays' =>"",'allergie' =>"",'tailleVetement' =>"",'tel' =>"",'email' =>"");
           $userBuilder = new UserBuilder($tabVide);
           $newUser= (key_exists("currentNewUser",$_SESSION) )?$_SESSION['currentNewUser']:$userBuilder;
           $view = new View($this,$feedback);
           $eventStorage = new EventStorage($bd);
             $controller = new Controller($view, $eventStorage);
         $action = key_exists('action', $_GET)? $_GET['action']: null;
        switch ($action) {
          case "validationUser":
          
                //var_export($_POST);
                //echo $_POST['nom'];
                //var_export($_FILES);
                $userB = new UserBuilder($_POST);
                $controller->saveUser($userB);
                echo "Apres insertion dans le Router";
           
            break;
          
          case "programme":
            $controller->showProgramList();
            break;
          case "inscription":
            $view->makeUserFormPage($newUser);
            break;
          case "intervenant":
             echo 'page sur les intervenants';
            break;
          case "unIntervenant":
               $controller->showSpeaker($_POST['email']);
            break;
            case "ListIntervenant":
             
             $controller->speakersList();
            break;
          case "sponsors":
             echo 'page sur les sponsors';
            break;
          case "propos":
             echo 'page sur a propos';
            break;
            case "listeSponsors":
              $controller->showSponsorList();
            break;
           case "listProgram":
              
         break;
          default:
            $view->makeHomePage("");
            break;
        }
           $view->render();
          
        }
        public function getUserForm()
        {
           return "index.php?action=validationUser";
        }
        public function getAcceuil()
        {
          return "index.php";
        }
        public function getInscription()
        {
           return "index.php?action=inscription";
        }
        public function getProgramme()
        {
           return "index.php?action=programme";
        }
        
       public function getIntervenant()       {
          return "index.php?action=intervenant";
       }
       public function getSponsors()        {
          return "index.php?action=sponsors";
       }
       public function getApropos()        {
          return "index.php?action=propos";
       }
       public function getSpeakersList()
       {
           return "index.php?action=ListIntervenant";
       }
       public function getSpeaker()
        {
           return "index.php?action=unIntervenant";
        }
        public function getSponsorListUser()
        {
           return "index.php?action=listeSponsors";
        }
        
        public function  POSTredirect($url,$feedback) {
         $_SESSION['feedback']=$feedback;
         return header("Location:".$url,true,303);
       }
    }
 ?>

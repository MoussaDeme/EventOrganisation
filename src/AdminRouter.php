<?php
    require_once("model/Admin.php");
    require_once("model/User.php");
    require_once("model/Intervenant.php");
    require_once("model/Sponsor.php");
    require_once("view/View.php");
    require_once ('model/UserBuilder.php');
    require_once ('model/EventStorage.php');
    
    require_once ('control/Controller.php');
    require_once ('control/AdminController.php');


      class AdminRouter{

        public function main($bd){
         session_start();

         $feedback = key_exists('feedback', $_SESSION) ? $_SESSION['feedback'] : '';
         $_SESSION['feedback'] ='';
           $tabVide = array('nom' =>"" ,'prenom' =>"" ,'adresse' =>"",'regimeAlimentaire' =>"",'pays' =>"",'allergie' =>"",'tailleVetement' =>"",'tel' =>"",'email' =>"",'bio'=>"");
           $tabVideAssister = array('date' =>"",'heure_debut' =>"",'heure_fin' =>"");
           $tabVideSponsor = array('nom' =>"",'contenu' =>"");
           $IntervenantBuilder = new IntervenantBuilder($tabVide);
           $iponsorBuilder = new SponsorBuilder($tabVideSponsor);
           $dataSponsor1 = (key_exists("currentNewSponsors",$_SESSION) )?$_SESSION['currentNewSponsors']:$iponsorBuilder;
           $eventStorage = new EventStorage($bd);

           

           $view = new AdminView($this,$feedback);
           $controller = new AdminController($view,$eventStorage);
           
           $data = (key_exists("nom",$_POST) || key_exists("prenom",$_POST) || key_exists("bio",$_POST))?$_POST:$tabVide;
           $dataAssister = (key_exists("date",$_POST) || key_exists("heure_debut",$_POST) || key_exists("heure_fin",$_POST))?$_POST:$tabVideAssister;
           $data1 = (key_exists('currentNewItervenant',$_SESSION))? $_SESSION['currentNewItervenant']:$IntervenantBuilder;
           $dataSponsor = (key_exists("nom",$_POST) || key_exists("contenu",$_POST))?$_POST:$tabVideSponsor;
           $action = key_exists('action', $_GET)? $_GET['action']: null;
           $controller->isConnectedAdmin($_POST);
         $connect = key_exists('login', $_SESSION) ? $_SESSION['login'] : null;         
          if($connect!=null){          
           switch ($action) {
            case "acceuil":
                $view->makeHomePage();
            break;
          case "validationIntervenant":
          
                $intervenantIn = new IntervenantBuilder($data);
                $controller->saveIntervenant($intervenantIn);          
            break;          
          case "programme":
             echo 'page sur le Programme';
            break;
          case "NouveauParticipant":
             //$intervenant = new IntervenantBuilder($data);
              $view->makeIntervenantFormPage($data1);
            break;
          case "ListIntervenant":
             $controller->speakersList();
            break;
            case "unIntervenant":
               $controller->showSpeaker($_POST['email']);
            break;
            case "usersList":
               $controller->usersList();
            break;
            case "unInscrit":
               $controller->showUser($_POST['email']);
            break;
          
          case "propos":
             echo 'page sur a propos';
            break;
          case "nouveauProgramme":
             $controller->showProgram();
          break;
          case "listProgram":
             $controller->showProgramList();
          break;
          case "saveProgram":
             $assisterB = new AssisterBuilder($dataAssister);
             $tab = array();
             $taille = $controller->saveProgram($assisterB,$_POST['contenu']);
          case "updateSponsorURL":
                  $controller->formUpdateSponsor();
                  break;
          case "updateSuccess":
              $controller->updateSponsor();
                  break;
             
          break;
          case "FormsModif":
               $controller->formsUpdateSpeaker($_POST['speaker']);
          break;
           case "updateSpeaker": 
          $controller->updateSpeaker($_GET['speaker'], $_POST);
        break;
        case "FormsModifProgram":
          $tab=array();
                $controller->formsUpdateProgram($_GET['program'], $tab);
          break;
          case "updateProgram":
                $assisterB = new AssisterBuilder($dataAssister);
                $assister = $assisterB->createAssister();
                $controller->updateProgram($_GET['program'], $_POST['contenu'], $assister);
          break;
           case "deleteSpeaker":
             $view->ConfirmDelete();
          break;
          case "nouveauSponsor":
              echo "ajout de sponsor";
              $sponsorBuilder = new SponsorBuilder($dataSponsor);
              $view->makeSponsorView($sponsorBuilder);
          break;
          case "validationSponsor":               
                $sponsorBui = new SponsorBuilder($dataSponsor);
                $controller->saveSponsor($sponsorBui);
          break;
          case "generateExcel":
              $controller->showGenerateExcel();
          break;
          case "listeSponsors":
             $controller->showSponsorList();
          break;
          case "telechargerLists":
              header('Location: http://localhost/summer-school/DownloadList.php',true,303);
          break;
          case "askDeletionProgram":
              $controller->askingDeletionProgramme($_GET['program']);
          break;
          case 'confirmDeletionProgram':
              $controller->deleteProgramme($_GET['program']);
            break;

          case 'askDeletionSpeaker':
              $controller->askingDeletionSpeaker();
            break;
          case "confirmDeletionSpeaker":
              $controller->deleteSpeaker();
            break;
            case "deconnecter":
              $controller->deconnexion();                
            break;
          default:
            $controller->checkConnexion($_POST);
            break;
        }
       }
        else
        {
            $view->connexionAnView();
        } 
           $view->render();
        
        }
        public function GetHomeUrl()
        {
           return "AdminIndex.php";
        }
        public function GetIntervenantForm()
        {
           return "AdminIndex.php?action=NouveauParticipant";
        }
        public function validationIntervenant()
        {
           return "AdminIndex.php?action=validationIntervenant";
        }
        public function getUserForm()
        {
           return "index.php?action=validationUser";
        }
        public function getSpeakersList()
        {
           return "AdminIndex.php?action=ListIntervenant";
        }
        public function getSpeaker()
        {
           return "AdminIndex.php?action=unIntervenant";
        }
        public function getUsersList(){
          return "AdminIndex.php?action=usersList";
        }
        public function getUser()
        {
           return "AdminIndex.php?action=unInscrit";
        }
        public function acceuilAdmin()
        {
           return "AdminIndex.php?action=acceuil";
        }
        public function addProgram()
        {
           return "AdminIndex.php?action=nouveauProgramme";
        }
        public function saveProgram()
        {
           return "AdminIndex.php?action=saveProgram";
        }
        public function listProgram()
        {
           return "AdminIndex.php?action=listProgram";
        }
       public function getFormsSpeakerUpdateURL()
        {
          return "AdminIndex.php?action=FormsModif";
        }
        public function updateSpeakerUrl($email){
          return "AdminIndex.php?speaker=".$email."&action=updateSpeaker";
        }
        //
        public function getFormsProgramUpdateURL($id)
        {
          return "AdminIndex.php?program=".$id."&action=FormsModifProgram";
        }
        public function updateProgramUrl($id){
          return "AdminIndex.php?program=".$id."&action=updateProgram";
        } 
        public function getFormsSpeakerDeleteURL($email)
        {
          return "AdminIndex.php?speaker=".$email."&action=deleteSpeaker";
        }
        public function addSponsor()
        {
           return "AdminIndex.php?action=nouveauSponsor";
        }
        public function validationSponsor()
        {
           return "AdminIndex.php?action=validationSponsor";
        }
        public function excel()
        {
           return "AdminIndex.php?action=generateExcel";

        }
        public function getSponsorList()
        {
           return "AdminIndex.php?action=listeSponsors";

        }
        public function getProgramDeletaion($id){
          return "AdminIndex.php?program=".$id."&action=confirmDeletionProgram";
        }

        public function getAskDeletionProgrammeURL($id){
          return "AdminIndex.php?program=".$id."&action=askDeletionProgram";
        }

        public function getSpeakerDeletaion(){
          return "AdminIndex.php?action=confirmDeletionSpeaker";
        }

        public function getAskDeletionSpeakerURL(){
          return "AdminIndex.php?action=askDeletionSpeaker";
        }
        public function  POSTredirect($url,$feedback) {
         $_SESSION['feedback']=$feedback;
         return header("Location:".$url,true,303);
       }
       public function disconnect()
       {
          return "AdminIndex.php?action=deconnecter";           
       }

       public function getSoponsorUpdateURL(){
          return "AdminIndex.php?action=updateSponsorURL";
        }

        public function updateSponsor(){
          return "AdminIndex.php?action=updateSuccess";
        }
    }
 ?>

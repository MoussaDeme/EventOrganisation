<?php

require_once("Router.php");
require_once ('model/User.php');
require_once ('model/AssisterBuilder.php');
require_once ('model/IntervenantBuilder.php');
require_once ('model/SponsorBuilder.php');

class AdminView {

	protected $router;
	protected $title;
  protected $content;
  private $menu;
  private $feedback ;
	public function __construct(AdminRouter $router,$feedback) {
		$this->router = $router;
		$this->title = null ;
    $this->content = null ;
    $this->feedback = $feedback;
		
  }
  

    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
      $this->content = $content;
    }
		protected function getMenu(){
			$this->menu = array(
				"Accueil" => $this->router->acceuilAdmin(),
				"intervenants" => $this->router->getSpeakersList(),
				"inscrits" => $this->router->getUsersList(),
				"Nouveau Intervenant" => $this->router->GetIntervenantForm(),
				"ajouter un programme" => $this->router->addProgram(),
				"Liste des programmes" => $this->router->listProgram(),
				"Liste des sponsors" => $this->router->getSponsorList(),
				"Ajouter sponsors" => $this->router->addSponsor(),
				//"deconnexion"=> $this->router->disconnect()
			///	"a propos"=> "#",
			);
			return $this->menu;
		}
    protected function getMenuConnexion()
    {
       $this->menu = array();
       return $this->menu;
    }
    public function setMenu($menu)
    {
      $this->menu = $menu;
    }
    public function getRouter()
    {
        return $this->router;
    }
	/* Affiche la page créée. */
	public function render() {
		include("squelette.php");
    }
	/******************************************************************************/
	/* Méthodes de génération des pages                                           */
	/******************************************************************************/
  public function Success($feedback)
	{
		$this->router->POSTredirect($this->router->acceuilAdmin(),$feedback);
  }
  
  public function speakerCreationSuccess($feedback)
	{
		$this->router->POSTredirect($this->router->acceuilAdmin(),$feedback);
	}

	public  function makeIntervenantFormPage(IntervenantBuilder $pb)
	{ 
    $this->getMenu();
		
          $form = '<form action="'.$this->router->validationIntervenant().'" method = "POST" enctype="multipart/form-data">';
		$form.='<label>  Nom <input type="text" name ="'.IntervenantBuilder::LN_REF.'" value="'.$pb->getData()[IntervenantBuilder::LN_REF].'"  > </label> <br>';
		$form.='<label>  Prenom<input type="text" name ="'.IntervenantBuilder::FN_REF.'"value="'.$pb->getData()[IntervenantBuilder::FN_REF].'" > </label> <br>';
		$form.='<label>  Email<input type="mail" name ="'.IntervenantBuilder::MAIL_REF.'"value="'.$pb->getData()[IntervenantBuilder::MAIL_REF].'" > </label> <br>';
		$form.='<label>  Pays <input type="mail" name ="'.IntervenantBuilder::COUNTRY_REF.'" value="'.$pb->getData()[IntervenantBuilder::COUNTRY_REF].'" > </label> <br>';
		
		$form.='<label>  Adresse <input type="text" name ="'.IntervenantBuilder::ADRESS_REF.'" value="'.$pb->getData()[IntervenantBuilder::ADRESS_REF].' "> </label> <br>';
		$form.='<label>  Alimentation (particulière) <input type="mail" name ="'.IntervenantBuilder::DIET_REF.'" value="'.$pb->getData()[IntervenantBuilder::DIET_REF].'" > </label> <br>';
		$form.= '<label>  Allergies <input type="text" name ="'.IntervenantBuilder::ALLERGY_REF.'"value="'.$pb->getData()[IntervenantBuilder::ALLERGY_REF].'" > </label> <br>';
		
		$form.= '<label>  Tailles Vêtements <select name ="'.IntervenantBuilder::SIZE_REF.'" value="'.$pb->getData()[IntervenantBuilder::SIZE_REF].'">
														<option>S</option>
														<option>M</option>
														<option>L</option>
														<option>Xl</option>
														<option>XXl</option>
														</select>
		 </label> <br>';
		$form.='<label>  Téléphone <input type="tel" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" name = "'.IntervenantBuilder::TEL_REF.'" value="'.$pb->getData()[IntervenantBuilder::TEL_REF].'"> </label> <br>';
	

         $form.='<input type="file"   name = "photo" ><br> <br>';
		 $form.='<textarea    name = "bio" ></textarea>';
		 $form.='<input type="submit"  value = "soumettre"  name = "soumettre" >';
        
 
		$form.='</form>';


    $this->title = "formulaire";
		$this->content = $form;

         // Formulaire d'un intervenant


			}

	public function  makeHomePage(){
    $this->getMenu();
		$this->title = "Bienvenue !";
		$this->content = "site de event organization.";
	}
	public function makeUnexpectedErrorPage() {
    $this->getMenu();
		$this->title = "Erreur";
		$this->content = "Une erreur inattendue s'est produite.";
	}

	public function makeSpeakersListView($list)
	{
    $this->getMenu();
		$this->title = 'listes des intervenants';
		$s = '';
		?><script>
          function submitform(email)
         {
       		 document.getElementById("email").value = email;
            document.getElementById("myForm").submit();	 

         }
                                                         
        </script>
         
                <?php
            $s='<section class="listIntervenant">
            <br> <br> <br> <br> <br> <br>';       
            $s.='<div class="row">';
            foreach ($list as $key => $value) {
              $s.=  '<form method="post" action="'.$this->router->getSpeaker().'" id="myForm">
                  <input id="email" type="hidden" name="email" value="rien" /><br/>
                </form>';?>
              <?php
                
                $s.='<div onclick="submitform(\''.$value->getEmail().'\')" style="color:blue;">
                     
                    <div class="col">   
                    <div class="card cardsHeader">
                   <img class="card-img-top cardsImage" src="upload/'.$value->getPicture().'" alt="Card image" style="width:100%">
                   <div class="card-body">
                   <h4 class="card-title"><span>'.$value->getFirstname().' '.$value->getLastname().'</span></h4>
                </div> 
              </div>
           <br>
           </div>
             </div>
               ';        
            }
            $s.='</div>
           </section>';
        $this->content = $s;
	}
	public function makeSpeakerPage(Intervenant $intervenant)
	{
         
         $s = '';
         $this->title = 'intervenant ';
         $s.='<div class="container-fluid bg-1 text-center">
             <br><br><br>
              <img class="rounded-circle" src="upload/'.$intervenant->getPicture().'"  alt="Bird" width="350" height="350">';
              $s.= '<h2>'.$intervenant->getFirstname().' '.$intervenant->getLastName().'</h2>';
             $s.= '<p>BIOGRAPHIE : <br><span class="pBioSpeaker">'.$intervenant->getBio().'</span></p>';
     $s.='</div>';
         /*$s.='<a href="'.$this->router->getFormsSpeakerUpdateURL($intervenant->getEmail()).'"> modifier </a>'
              .'<a href="'.$this->router->getFormsSpeakerDeleteURL($intervenant->getEmail()).'"> supprimmer </a>';*/
          $s.='<div class="row"><div class="col-sm-2"><form method="post" action="'.$this->router->getFormsSpeakerUpdateURL().'" id="myForm">
                  <input id="speaker" type="hidden" name="speaker" value="'.$intervenant->getEmail().'" /><br/>
                <td><button class="btn btn-primary" type="submit" name="details">Modifier</button></td>
                </form></div>';
          $s.='<div class="col"><form method="post" action="'.$this->router->getAskDeletionSpeakerURL().'" id="myForm">
                  <input id="speaker" type="hidden" name="speaker" value="'.$intervenant->getEmail().'" /><br/>
                <td><button class="btn btn-primary" type="submit" name="details">Supprimmer</button></td>
                </form></div></div>';
                $this->getMenu();    
         $this->content = $s;
	}

	// utilisateur
	public function makeUsersListView($list)
	{
    $this->getMenu();
		$this->title = 'listes des inscrits';
		$s = '';
		?><script>
          function submitform(email)
         {
       		 document.getElementById("email").value = email;
            document.getElementById("myForm").submit();	 

         }                                                         
        </script>
         
        <?php
             $s.='<h2>Listes des Inscrits</h2>';
            $s.='<table class="tableList table table-striped">
    <thead>
      <tr>
        <th>NOM</th>
        <th>PRENOM</th>
        <th></th>
      </tr>
    </thead>
    <tbody>';
            foreach ($list as $key => $value) {
              ?>
              <tr>      
              <?php
                $s.='<td>'.$value->getLastname().'</td>
                <td>'.$value->getFirstname().'</td>';
                $s.=  '<form method="post" action="'.$this->router->getUser().'" id="myForm">
                  <input id="email" type="hidden" name="email" value="'.$value->getEmail().'" />
                <td><button class="btn btn-primary" type="submit" name="details">Details</button></td>
                </form>';
              $s.='</tr>';
            }
            $s.='</tbody></table>';        
        $this->content = $s; 
	}
   //page d'un utilisateur

	
	public function makeUserPage(User $user)
	{
    $this->getMenu();
         $this->title = 'inscrit ';
         $s="";
           $s.='<div>
                <h2>details de l\'inscrit '.$user->getFirstname().' '.$user->getLastname().'</h2>
               <table class="table">
               <thead>
               <tr>
               <th></th>
               <th></th>
               </tr>
               </thead>
               <tbody>
               <tr><td>NOM : </td><strong><td>'.$user->getFirstname().'</strong></td></tr> 
               <tr><td>PRENOM : </td><strong><td>'.$user->getLastName().'</strong></td></tr> 
               <tr><td>EMAIL : </td><strong><td>'.$user->getEmail().'</strong> <br></td></tr>
               <tr><td>ALIMENTATION : </td><strong><td>'.$user->getDiet().'</strong></td></tr> 
               <tr><td>ADRESSE : </td><strong><td>'.$user->getAdress().'</strong></td></tr>
               <tr><td>PAYS : </td><strong><td>'.$user->getCountry().'</strong></td></tr>
               <tr><td>ORGANISATION : </td><strong><td>'.$user->getOrganization().'</strong></td></tr> 
               <tr><td>VETEMENT : </td><strong><td>'.$user->getClothingSize().'</strong></td></tr> 
               <tr><td>TELEPHONE : </td><strong><td>'.$user->getTelNumber().'</strong></td></tr> 
               </tbody>
               </table>

            </div>';
         
         $this->content = $s;
	}
	public function connexionAnView()
	{
		$form = '<form action="'.$this->router->GetHomeUrl().'" method = "POST" enctype="multipart/form-data" class="was-validated">';
		$form.= '
     <div class="form-group">
    <div class="col-sm-6">
      <label for="uname">Nom d\'utilisateur:</label>
      <input type="text" class="form-control" id="uname" placeholder="NOM D utilisateur" name="login" required>
      <div class="valid-feedback">Valide.</div>
      <div class="invalid-feedback">Champs incorrect.</div>
    </div>
    </div>
    <div class="form-group">
    <div class="col-sm-6">
      <label for="pwd">Mot de passe:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter Votre mot de passe" name="pwd" required>
      <div class="valid-feedback">Valide.</div>
      <div class="invalid-feedback">Champs incorrect.</div>
    </div>
    </div>
    <button type="submit" class="btn btn-primary" name="valider">Valider</button>
    ';
		$form.='</form>';

    $this->getMenuConnexion();
    $this->title = "formulaire de connexion admin";
		$this->content = $form;
		
	}
	// nouveau programme
	public function makeProgramView(AssisterBuilder $pb,$tab)
	{
    $this->getMenu();
       $this->title = "AJOUT D'UN PROGRAMME";
       $form = '<form action="'.$this->router->saveProgram().'" method = "POST" enctype="multipart/form-data">';
	    $form.='<label>  CONTENU <textarea  name ="contenu"   ></textarea> </label> <br>';
	  	$form.='<label>  DATE ET HEURE<input type="date" name ="'.AssisterBuilder::DATE_REF.'" value="'.$pb->getData()[AssisterBuilder::DATE_REF].'" > </label> <br>';
		  $form.='<label>  HEURE DE DEBUT<input type="time" name ="'.AssisterBuilder::HEURE_DEBUT_REF.'" value="'.$pb->getData()[AssisterBuilder::HEURE_DEBUT_REF].'" > </label> <br>';
		  $form.='<label>  HEURE DE FIN<input type="time" name ="'.AssisterBuilder::HEURE_FIN_REF.'" value="'.$pb->getData()[AssisterBuilder::HEURE_FIN_REF].'" > </label> <br>';
		 $i =0;
         foreach($tab as $key => $value)
             {
                  $form.='<input type="checkbox" id="intervenant'.$i.'" name="intervenant'.$i.'" value="'.$value->getEmail().'">';
                  $form.='<label for="'.$value->getFirstname().'">'.$value->getFirstname().' '.$value->getLastname().'</label>';
                  $i++;   	
             }
		 $form.='<input type="submit"  value = "valider"  name = "valider" >';
		$form.='</form>';
		$this->content = $form;

		return $i;
	}

	// view pour la liste des programmes
	public function makeProgramList($list)
	{
      
    $s="";
    $iter = 2;
    $side = "left";
    $s.='<div class="programs">';
    $s.='<div class="timeline">';
        foreach ($list as $key => $value) {
          $s.='<div class="conteneur '.$side.'" > <div class="content"><h2>'.$value['date'].'</h2>';
        	//$s.="DATE :".$value['date'];
        	$s.='<p> De <strong>'.$value["heure_debut"].' </strong> à  <strong>'.$value['heure_fin'].' </strong> <br>';
        	$s.="<strong>INTERVENANTS :</strong>".$value['nom'].'  '.$value['prenom'].'<br>'; 
        	$s.="<strong>CONTENU DU PROGRAMME : </strong><br>".$value['contenu'].'<br>';
       		$s.='<a href="'.$this->router->getFormsProgramUpdateURL($key).'"> modifier<a>';
          $s.='<a href="'.$this->router->getAskDeletionProgrammeURL($key).'"> supprimmer<a>';
          $s.='</p> </div> </div>';
          $iter +=1;
          if ($iter % 2 === 0) {
            $side = "left";
          }
          else {
            $side = "right";
          }
        }
        $s.='</div>';
        $s.='</div>';
        $this->getMenu();
        $this->content = $s;
	}

	public function makeSpeakerUpdatePage(Intervenant $int){
          $this->getMenu();
          $this->title = 'Modification d\' un intervenant';

      $s='';
    
     $s.= '<form action="'.$this->router->updateSpeakerUrl($int->getEmail()).'" method="POST" enctype="multipart/form-data">';

              $s.='<label > Nom : <input type="text" name="nom" value="'.$int->getFirstname().'" /> </label> <br/>';
              $s.='<label > Prénom : <input type="text" name="prenom" value="'.$int->getLastname().'" /> </label> <br/>';
              $s.='<label > Adresse : <input type="text" name="adresse" value="'.$int->getAdress().'" /> </label> <br/>';
              $s.='<label >Régime Alimentaire : <input type="text" name="regimeAlimentaire" value="'.$int->getDiet().'"/> </label> <br/>';
               $s.='<label >Pays: <input type="text" name="pays" value="'.$int->getCountry().'"/> </label> <br/>';
                $s.='<label >Organization: <input type="text" name="organisation" value="'.$int->getOrganization().'"/> </label> <br/>';
                $s.='<label >Taille des vêtements: <input type="text" name="tailleVetement" value="'.$int->getClothingSize().'"/> </label> <br/>';
                $s.='<label >Numéro de Téléphone: <input type="text" name="tel" value="'.$int->getTelNumber().'"/> </label> <br/>';
                $s.='<label >Pseudo: <input type="text" name="login" value="'.$int->getLogin().'"/> </label> <br/>';
                $s.='<label >Biographie <input type="text" name="bio" value="'.$int->getBio().'"/> </label> <br/>';
                $s.='<label >Photo : <input type="file" name="photo" value="'.$int->getPicture().'"/> </label> <br/>';

              $s.='<button type="submit" name="modifier">modifier</button>';
           $s.='</form>';
           $this->content = $s;
    }

    //
    /*public function makeProgramList($list)
	{
		$s="";
		 
        foreach ($list as $key => $value) {
        	$s.="DATE :".$value['date'];
        	$s.="HEURE DE DEBUT :".$value['heure_debut'];
        	$s.="HEURE FIN :".$value['heure_fin'];
        	$s.="INTERVENANTS :".$value[_intervenant'];
       		$s.="CONTENU DU PROGRAMME :".$value['contenu'];
       		$s.='<a href="'.$this->router->getFormsProgramUpdateURL($key).'"> modifier<a>';
        }
         
        $this->content = $s;
	}*/

 public function makeUpdateProgramPage($id, $data, $tab){
  $this->getMenu();
    	 $this->title = "AJOUT D'UN PROGRAMME";

    	 $form= '<form action="'.$this->router->updateProgramUrl($id).'"method="POST">';
        
		$form.='<label>  CONTENU <textarea  name ="contenu">'.$data['contenu'].'</textarea> </label> <br>';
		
		$form.='<label>  DATE ET HEURE<input type="date" name ="date" value="'.$data['date'].'" > </label> <br>';
		$form.='<label>  HEURE DE DEBUT<input type="time" name ="heure_debut" value="'. $data['heure_debut'].'" > </label> <br>';
		$form.='<label>  HEURE DE FIN<input type="time" name ="heure_fin" value="'.$data['heure_fin'].'" > </label> <br>';
		 $i =0;
         foreach($tab as $key => $value)
             {
                  $form.='<input type="checkbox" id="intervenant'.$i.'" name="intervenant'.$i.'" value="'.$value->getEmail().'">';
                  $form.='<label for="'.$value->getFirstname().'">'.$value->getFirstname().' '.$value->getLastname().'</label>';
                  $i++;   	
             }
            
		$form.='<input type="submit"  value = "modifier"  name = "modifier" >';
		$form.='</form>';
		$this->content = $form;
    }
    public function ConfirmDelete()
    {
    	$s = '';
    	$s.= '<form>
              <input type="submit" name="confirmer" value="confirmer">
    	</form>';
      $this->getMenu();
    	$this->content = $s;
    }

    // vue formulaire d'un sponsor
    public function makeSponsorView(SponsorBuilder $sp)
    {
           //
                  $form = '<div class="formUser">';
    $form.= '<form action="'.$this->router->validationSponsor().'" method = "POST" enctype="multipart/form-data">';
   
      
    $form.='<div class="form-group col-md-3"><label class="label">  Nom </label><div class="input-group mb-2"><div class="input-group-prepend">
      
        </div><input class="form-control" type="text" name ="'.SponsorBuilder::NAME_REF.'" value="'.$sp->getData()[SponsorBuilder::NAME_REF].'" placeholder="Nom"></div></div>';

   
    
    $form.='<div class="form-row">';
         $form.='<div class="custom-file form-group col-md-6"> 
             <label class="custom-file-label" for="validatedCustomFile">Chosi une photo</label>
             <input  type="file" class="custom-file-input form-control" name="photo" id="validatedCustomFile"  required>
           </div>
         ';
         $form.='</div>';
         $form.='<textarea    name = "contenu" ></textarea>';
     $form.='<input type="submit"  value = "soumettre"  name = "soumettre" class="btn btn-primary bouton" >';
        

    $form.='</form>';
    $form.='</div>';
    $this->getMenu();
    $this->title = "formulaire";
    $this->content = $form;
 

            //
    }

    // sponsor list
    /*public function makeSponsorList($list)
    {
      $this->getMenu();
        $this->title = "liste des sponsors";
        $s = '';
    ?><script>
          function submitform(id)
         {
           document.getElementById("id").value = id;
            document.getElementById("myForm").submit();  

         }
                                                         
        </script>
         
                <?php
            $s='<section class="listIntervenant">
            <br> <br> <br> <br> <br> <br>';       
            $s.='<div class="row">';
            foreach ($list as $key => $value) {
              
              $s.=  '<form method="post" action="'.$this->router->getSpeaker().'" id="myForm">
                  <input id="id" type="hidden" name="id" value="rien" /><br/>
                </form>';?>
              <?php
                
                $s.='<div onclick="submitform(\''.$key.'\')" style="color:blue;">
                     
                    <div class="col">   
                    <div class="card cardsHeader">
                   <img class="card-img-top cardsImage" src="upload/'.$value->getPicture().'" alt="Card image" style="width:100%">
                   <div class="card-body">
                   <h4 class="card-title"><span>'.$value->getName().'</span></h4>
                </div> 
              </div>
           <br>
           </div>
             </div>
               ';        
            }
            $s.='</div>
           </section>';
        $this->content = $s;
    }*/
    public function makeSponsorList($list)
    {
        $this->title = "liste des sponsors";
        $s = '';
    ?><script>
          function submitform(id)
         {
           document.getElementById("id").value = id;
            document.getElementById("myForm").submit();  

         }
                                                         
        </script>
         
                <?php
            $s='<section class="listIntervenant"> <br>';       
            $s.='<div class="row">';
            foreach ($list as $key => $value) {
              
              $s.=  '<form method="post" action="'.$this->router->getSoponsorUpdateURL().'">
                
                </form>';?>
              <?php
                $s.=  '<form method="post" action="'.$this->router->getSoponsorUpdateURL().'">';
                $s.='<div onclick="submitform(\''.$key.'\')" style="color:blue;">
                  
                    <div class="col">   
                    <div class="card cardsHeader">
                   <img class="card-img-top cardsImage" src="upload/'.$value->getPicture().'" alt="Card image" style="width:100%">
                   <div class="card-body">
                   <h4 class="card-title"><span>'.$value->getContent().'</span></h4>
                   <input type="hidden" name="nom" value="'.$value->getName().'">
                    <input type="hidden" name="contenu" value="'.$value->getContent().'">
                   <input type="hidden" name="image" value="'.$value->getPicture().'">
                   <input type="hidden" name="id" value="'.$key.'">
                   <input type="submit" name="modifier" value="modifier">
                   


                </div>  
              </div>
           <br>
           </div>
             </div>
               ';        
            }

            $s.='</div>
           </section> </form>';
          $this->getMenu();
        $this->content = $s;
    }
    //
     public function makeProgrammeDeletionPage($id)
        {
          $this->getMenu();
          $this->title =  'page de suppression d\'un programme';
          $s =  '<form action="'.$this->router->getProgramDeletaion($id).'" method="POST">';
         $s.= "<button>Confirmer</button>\n</form>\n";
         $this->content = $s;
        }

       public function makeSpeakerDeletionPage()
        {
          $this->getMenu();
          $this->title =  'page de suppression d\'un intervenant';
          $s =  '<form action="'.$this->router->getSpeakerDeletaion().'" method="POST">';
         $s.= '<button name="speaker" value="'.$_POST['speaker'].'">Confirmer</button></form>';
         $this->content = $s;
    }

    public function sponsorUpdateView(){
      $this->title="<h2> Modification d'un sponsor </h1>";
                   $form = '<div class="formUser">';
    $form.= '<form action="'.$this->router->updateSponsor().'" method = "POST" enctype="multipart/form-data">';
   
      
    $form.='<div class="form-group col-md-3"><label class="label">  Nom </label><div class="input-group mb-2"><div class="input-group-prepend">
      
        </div><input class="form-control" type="text" name ="'.SponsorBuilder::NAME_REF.'" value="'.$_POST[SponsorBuilder::NAME_REF].'" placeholder="Nom"></div></div>';

   
    
    $form.='<div class="form-row">';
         $form.='<div class="custom-file form-group col-md-6"> 
             <label class="custom-file-label" for="validatedCustomFile">Chosi une photo</label>
             <input  type="file" class="custom-file-input form-control" name="photo" id="validatedCustomFile">
           </div>
         ';
         $form.='</div>';
         $form.='<textarea name ='.SponsorBuilder::CONTENT_REF.'>'.$_POST[SponsorBuilder::CONTENT_REF].'</textarea>';
         $form.='<input type="hidden" name="id" value='.$_POST['id'].'>';
     $form.='<input type="submit"  value = "soumettre"  name = "soumettre" class="btn btn-primary bouton" >';
    $form.='</form>';
    $form.='</div>';
    $this->title = "formulaire";
    $this->content = $form;
 
    }
    public function creationIntervenantEchec(){
 $this->router->POSTredirect($this->router->GetIntervenantForm(),"Veuillez remplir tous les champs ");
 }

 public function creationSponsorsEchec(){
 $this->router->POSTredirect($this->router->addSponsor(),"Veuillez remplir tous les champs ");
 }
}
?>


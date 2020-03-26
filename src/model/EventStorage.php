<?php

class EventStorage
{
    private $bd;
    public function __construct($bd)
     {
       $this->bd = $bd;
     }    public function read($id)
     {


     }

    public function create(User $user)
    {

       $req = $this->bd->prepare('INSERT INTO users (email, nom, prenom, adresse, regime_Alimentaire, pays, allergies, taille_vetement, tel,photo, identifiant, login_admin, organisation) VALUES (:email, :nom, :prenom, :adresse, :regime_Alimentaire, :pays, :allergies, :taille_vetement, :tel,:photo ,:identifiant, :login_admin, :organisation)');

        $req->bindParam(':email', $email);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':adresse', $adresse);
        $req->bindParam(':regime_Alimentaire', $regime_Alimentaire);
        $req->bindParam(':pays', $pays);
        $req->bindParam(':allergies', $allergies);
        $req->bindParam(':taille_vetement', $taille_vetement);
        $req->bindParam(':tel', $tel);
        $req->bindParam(':photo', $photo);
        $req->bindParam(':identifiant', $identifiant);
        $req->bindParam(':login_admin', $login_admin);
        $req->bindParam(':organisation', $organisation);
                

        $email = $user->getEmail();
        $nom = $user->getFirstName();
        $prenom = $user->getLastName();
        $adresse = $user->getAdress();
        $regime_Alimentaire = $user->getDiet();
        $pays = $user->getCountry();
        $allergies = $user->getAllergy();
        $taille_vetement = $user->getClothingSize();
        $tel = $user->getTelNumber();
        $photo = $user->getPicture();
        $identifiant = 1341;
        $login_admin = 'admin';
        $organisation = 'testOrga';
        
       $req->execute();
    }

    public function usersList(){

          $requete = 'SELECT * FROM users;';
          $stmt = $this->bd->query($requete);
          $valeurs = $stmt->fetchAll();
  	      $list = array();

            /*foreach ($valeurs as $key => $value) {
              'nom' =>"" ,'prenom' =>"" ,'adresse' =>"",'regimeAlimentaire' =>"",'pays' =>"",'allergie' =>"",'tailleVetement' =>"",'tel' =>"",'email' =>"", "organization"=>"");
              $list[$value['id']] = new Users($value['$nom'],$value['prenom'],$value['adresse'],$value['regimeAlimentaire'], $value['pays'], $_value['tailleVetement'], $value['tel'], $value['email'], $value['organization']);
            }*/

          return $list;
    }
 

  
    public function speakersList()
    {
         $requete = 'SELECT * FROM intervenant ,users where intervenant.email_user=users.email;';
        $stmt = $this->bd->query($requete);
        $valeurs = $stmt->fetchAll();
          $list = array();


        foreach ($valeurs as $key => $value) {
          $list[$value['email_user']] = new Intervenant($value['nom'],$value['prenom'],$value['adresse'],$value['regime_Alimentaire'],$value['pays'],$value['allergies'],$value['taille_vetement'],$value['tel'],$value['email_user'],null,$value['photo'],$value['organisation'],$value['biographie']);
        }
        return $list;    
    }



    public function delete($id){

    }



        public function getCarId(){

        }

        public function createIntervenant(Intervenant $intervenant)
    {

       $req = $this->bd->prepare('INSERT INTO users (email, nom, prenom, adresse, regime_Alimentaire, pays, allergies, taille_vetement, tel,photo, identifiant, login_admin, organisation) VALUES (:email, :nom, :prenom, :adresse, :regime_Alimentaire, :pays, :allergies, :taille_vetement, :tel,:photo ,:identifiant, :login_admin, :organisation)');

        $req->bindParam(':email', $email);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':adresse', $adresse);
        $req->bindParam(':regime_Alimentaire', $regime_Alimentaire);
        $req->bindParam(':pays', $pays);
        $req->bindParam(':allergies', $allergies);
        $req->bindParam(':taille_vetement', $taille_vetement);
        $req->bindParam(':tel', $tel);
        $req->bindParam(':photo', $photo);
        $req->bindParam(':identifiant', $identifiant);
        $req->bindParam(':login_admin', $login_admin);
        $req->bindParam(':organisation', $organisation);
                

        $email = $intervenant->getEmail();
        $nom = $intervenant->getFirstName();
        $prenom = $intervenant->getLastName();
        $adresse = $intervenant->getAdress();
        $regime_Alimentaire = $intervenant->getDiet();
        $pays = $intervenant->getCountry();
        $allergies = $intervenant->getAllergy();
        $taille_vetement = $intervenant->getClothingSize();
        $tel = $intervenant->getTelNumber();
        $photo = $intervenant->getPicture();
        $identifiant = 1341;
        $login_admin = 'admin';
        $organisation = 'testOrga';
       
       $reqIntervenant = $this->bd->prepare('INSERT INTO intervenant (biographie, email_user) VALUES (:biographie, :email_user)'); 
        $reqIntervenant->bindParam(':biographie', $biographie);
        $reqIntervenant->bindParam(':email_user', $email_user);

        $biographie = $intervenant->getBio();
        $email_user = $intervenant->getEmail();
        
       $req->execute();
       $reqIntervenant->execute();
       
    }
    public function readSpeaker($email)
    {

        $req = "select *FROM intervenant ,users where intervenant.email_user=users.email and intervenant.email_user=:email;";
        $stmt = $this->bd->prepare($req);
        $data = array(":email" => $email);
        $stmt->execute($data);
        $value = $stmt->fetch(PDO::FETCH_ASSOC);

        return  new Intervenant($value['nom'],$value['prenom'],$value['adresse'],$value['regime_Alimentaire'],$value['pays'],$value['allergies'],$value['taille_vetement'],$value['tel'],$value['email_user'],null,$value['photo'],$value['organisation'],$value['biographie']);

    }

    //liste des inscript
    public function getUsersList(){

          $requete = 'SELECT * FROM users;';
          $stmt = $this->bd->query($requete);
          $valeurs = $stmt->fetchAll();
          $list= array();
          foreach ($valeurs as $key => $value) {
            $list[$value['email']] = new User($value['nom'],$value['prenom'],$value['adresse'],$value['regime_Alimentaire'], $value['pays'],$value['allergies'], $value['taille_vetement'], $value['tel'],$value['email'],null, $value['photo'], null);
          }
          return $list;
    }
                
                
    public function readUser($email)
    {

        $req = "select *FROM users where users.email=:email;";
        $stmt = $this->bd->prepare($req);
        $data = array(":email" => $email);
        $stmt->execute($data);
        $value = $stmt->fetch(PDO::FETCH_ASSOC);

        return  new User($value['nom'],$value['prenom'],$value['adresse'],$value['regime_Alimentaire'],$value['pays'],$value['allergies'],$value['taille_vetement'],$value['tel'],$value['email'],null,$value['photo'],$value['organisation']);
    }
     // insertion d'un programme et ses intervenant
    public function createProgram(Assister $as,$content)
    {

        $req = $this->bd->prepare('INSERT INTO programme (contenu) VALUES (:contenu)');
        $req->bindParam(':contenu', $content);
        
        $req->execute();
        // insertion dans la table assiter 
        $tab = array();
        foreach ($_POST as $key => $value) {
           
           if($key!='date' && $key!='heure_debut' && $key!='heure_fin' && $key!='contenu'  && $key!='valider')
           {
              array_push($tab, $value);
           }
        }
       
        $i = 1;
       
        $reqAssit = $this->bd->prepare('INSERT INTO assister(date,heure_debut,heure_fin,email_intervenant,id_programme) VALUES (:date,:heure_debut,:heure_fin,:email_intervenant,:id_programme)');
        $reqAssit->bindParam(':date', $date);
        $reqAssit->bindParam(':heure_debut', $heure_debut);
        $reqAssit->bindParam(':heure_fin', $heure_fin);
        $reqAssit->bindParam(':email_intervenant', $email_intervenant);
        $reqAssit->bindParam(':id_programme', $id_programme);
        
        $date = $as->getDate();
        $heure_debut = $as->getHeureDebut();
        $heure_fin = $as->getHeureFin();
        $id_programme = $this->bd->lastInsertId();   
        foreach ($tab as $value) {
        $email_intervenant = $value;
           
        $reqAssit->execute();
        
      }
    }

    //requete liste des pro
    public function getProgramList(){

          $requete = 'SELECT *FROM programme,assister where id=id_programme ORDER BY date ASC;';
          $stmt = $this->bd->query($requete);
          $valeurs = $stmt->fetchAll();

          $list= array();
          
          foreach ($valeurs as $key => $value) {
            $intervenant = $this->readSpeaker($value['email_intervenant']); 
            $list[$value['id_programme']] = array('date'=>$value['date'],'heure_debut'=>$value['heure_debut'],'heure_fin'=>$value['heure_fin'],'email_intervenant'=>$value['email_intervenant'],'contenu'=>$value['contenu'],'prenom'=>$intervenant->getFirstName(),'nom'=>$intervenant->getLastName());
          } 
          
          return $list;
    }

     public function updateSpeaker($email, Intervenant $int) {
          if ($this->readSpeaker($email)!=null) {

          $req= $this->bd->prepare("UPDATE intervenant SET biographie= :biographie 
                                                        WHERE email_user=:email;");
          $data = array(':biographie'=>$int->getBio(), ':email' => $email);
          $req->execute($data);

          $requete = $this->bd->prepare("UPDATE users SET nom=:nom,
                                                          prenom=:prenom,
                                                          adresse=:adresse,
                                                          regime_Alimentaire=:regime_Alimentaire,
                                                          pays=:pays,
                                                          allergies=:allergies,
                                                          taille_vetement=:taille_vetement,
                                                          tel=:tel,
                                                          photo=:photo,
                                                          organisation=:organisation
                                                      WHERE email=:email;");

        $dataTab = array(':nom'=>$int->getFirstName(),
                     ':prenom'=>$int->getLastName(),
                     ':adresse'=>$int->getAdress(),
                     ':regime_Alimentaire'=>$int->getDiet(),
                     ':pays'=>$int->getCountry(),
                     ':allergies'=>$int->getAllergy(),
                     ':taille_vetement'=>$int->getClothingSize(),
                     ':tel'=>$int->getTelNumber(),
                     ':photo'=>$int->getPicture(),
                     ':organisation'=>$int->getOrganization(),
                     ':email'=>$int->getEmail()
                   );
        $requete->execute($dataTab);
            return true;
          }
          return false;
        }

        //
        public function updateProgram($id, $contenu, Assister $as){
      $requete = $this->bd->prepare('UPDATE  programme SET contenu = :contenu WHERE id = :id');
      $requete->bindParam( ":id" , $id);
      $requete->bindParam(":contenu", $contenu);
      $requete->execute(); 


    $tab = array();

    foreach ($_POST as $key => $value) {
       if($key!='date' && $key!='heure_debut' && $key!='heure_fin' && $key!='contenu' && $key!='modifier')
       {
          array_push($tab, $value);
       }
    }
   
    $i = 1;

    /*$reqAssit = $this->bd->prepare('UPDATE  assister SET date = :date , heure_debut = :heure_debut , heure_fin = :heure_fin, email_intervenant =:email_intervenant where id_programme =:id_programme ;');
    $reqAssit->bindParam(':date', $date);
    $reqAssit->bindParam(':heure_debut', $heure_debut);
    $reqAssit->bindParam(':heure_fin', $heure_fin);
    $reqAssit->bindParam(':email_intervenant', $email_intervenant);
    $reqAssit->bindParam(':id_programme', $id);

    $date = $as->getDate();
    $heure_debut = $as->getHeureDebut();
    $heure_fin = $as->getHeureFin();
    
    $bool = false;
   
    foreach ($tab as $value) {
    $email_intervenant = $value;
    var_dump($email_intervenant); 
    $bool = $reqAssit->execute();    
  }*/
  $reqAssit1 = $this->bd->prepare('DELETE FROM assister WHERE id_programme=:idtest');
  $reqAssit1->bindParam(':idtest', $id);
  $reqAssit1->execute();
 
 //
  $reqAssit = $this->bd->prepare('INSERT INTO assister(date,heure_debut,heure_fin,email_intervenant,id_programme) VALUES (:date,:heure_debut,:heure_fin,:email_intervenant,:id_programme)');
  $reqAssit->bindParam(':date', $date);
    $reqAssit->bindParam(':heure_debut', $heure_debut);
    $reqAssit->bindParam(':heure_fin', $heure_fin);
    $reqAssit->bindParam(':email_intervenant', $email_intervenant);
    $reqAssit->bindParam(':id_programme', $id);

    $date = $as->getDate();
    $heure_debut = $as->getHeureDebut();
    $heure_fin = $as->getHeureFin();
    
    $bool = false;
   
    foreach ($tab as $value) {
    $email_intervenant = $value;
    var_dump($email_intervenant); 
    $bool = $reqAssit->execute();   
  }

  
}


  public function readProgram($id){
        $req = "select *FROM programme where programme.id=:id;";
        $stmt = $this->bd->prepare($req);
        $data = array(":id" => $id);
        $stmt->execute($data);
        $value = $stmt->fetch(PDO::FETCH_ASSOC);
        return $value;
    }

    public function readAssister($idProgramme){
        $req = "select *FROM assister where assister.id_programme=:id_programme;";
        $stmt = $this->bd->prepare($req);
        $data = array(":id_programme" => $idProgramme);
        $stmt->execute($data);
        $value = $stmt->fetch(PDO::FETCH_ASSOC);
        return $value;
    }
  
    // cree un sponsor
    public function createSponsor(Sponsor $sp)
    {

         $req = $this->bd->prepare('INSERT INTO sponsors (nom,image,contenu,login_admin)VALUES(:nom,:image,:contenu,:login)');
          $req->bindParam(':nom', $nom);
          $req->bindParam(':image', $image);
          $req->bindParam(':contenu', $contenu);
          $req->bindParam(':login', $login);

          $nom = $sp->getName();
          $image = $sp->getPicture();
          $contenu = $sp->getContent(); 
          $login = 'admin';
          $bool = $req->execute();
          var_dump($bool);
    }   

    //   generation du fichier excel

        public function cleanData(&$str)
        {
             $str = preg_replace("/\t/", "\\t", $str);
           $str = preg_replace("/\r?\n/", "\\n", $str);
          if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
       }
       public function generateExcel()
       {
            $filename = "website_data_" . date('Ymd') . ".xls";

           header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Type: application/vnd.ms-excel");
 
          $flag = false;
           $requete = 'SELECT nom,prenom,adresse FROM users;';
          $stmt = $this->bd->query($requete);
          $valeurs = $stmt->fetchAll();
          foreach($valeurs as $row) {
            if(!$flag) {
       // display field/column names as first row
           echo implode("\t", array_keys($row)) . "\r\n";
           $flag = true;
       }
         array_walk($row, array($this,'cleanData'));
         echo implode("\t", array_values($row)) . "\r\n";
      }
      }
    // fin generation du fichier excel
      // liste des sponsor
      public function getSponsorList(){

          $requete = 'SELECT * FROM sponsors;';
          $stmt = $this->bd->query($requete);
          $valeurs = $stmt->fetchAll();
          $list= array();
          foreach ($valeurs as $key => $value){
            $list[$value['id']] = new Sponsor($value['nom'],$value['contenu'],$value['image'],$value['login_admin']);
          }
          return $list;
    }
    //
    public function deletionProgramme($id){

        $req=$this->bd->prepare('delete from assister where id_programme= :id');
        $req->execute(array('id'=>$id)); 

        $req2=$this->bd->prepare('delete from programme where id= :id');
        $req2->execute(array('id'=>$id)); 
      }

      public function  deletionSpeaker(){
        $req=$this->bd->prepare('delete from intervenant where email_user= :email');       
        $bool = $req->execute(array('email'=>$_POST['speaker'])); 
        var_dump($bool);
        //suppression a verifier
      }
      public function isConnected($login, $password)
        {
            $req = "select *FROM admin where login=:login AND pwd=:pwd;";
            $stmt = $this->bd->prepare($req);
            $data = array(":login" => $login,":pwd" => $password);
            $stmt->execute($data);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            if($res['login']!=null && $res['pwd']!=null){
              $_SESSION['login'] = $login;
              $_SESSION['pwd'] = $password;
               return true;
           }else{
            return false;
          }
        }
        
          public function updateSponsor() {
          $req = $this->bd->prepare("UPDATE sponsors SET nom= :nom, contenu= :contenu
                                                      WHERE id= :idSponsor; ");
          $data = array(":nom"=>$_POST['nom'], ":contenu"=>$_POST['contenu'], ":idSponsor"=>$_POST['id']);

          $req->execute($data);
        }
 }
?>

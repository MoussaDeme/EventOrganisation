<?php 
    require_once("model/Assister.php");
	
  class AssisterBuilder{

		private $data;
	    private $error;
		const DATE_REF = "date";
		const HEURE_DEBUT_REF = "heure_debut";
		const HEURE_FIN_REF = "heure_fin";
		//const EMAIL_INTERVENANT = "email_intervenant";
		

		

		 public function __construct($d){
				$this->data = $d;
				$this->error = null;
            }

          public function createAssister(){
                $assister = new Assister(htmlspecialchars($this->data[self::DATE_REF]), htmlspecialchars($this->data[self::HEURE_DEBUT_REF]), htmlspecialchars($this->data[self::HEURE_FIN_REF]), null, null);
                   return $assister;
            }


           public function getData(){
                return $this->data;
            } 
           public function getError(){
              return $this->error;
          	}

          	 public function isValid(){
                 if(($this->data[self::DATE_REF]!="") && ($this->data[self::HEURE_DEBUT_REF]!="") && ($this->data[self::HEURE_FIN_REF]!="")){
                $this->error=null;
              }else{
                if($this->data[self::DATE_REF]==""){
                  $this->error .= "Le chmaps date doit être rempli ";
                }
                if($this->data[self::HEURE_DEBUT_REF]==""){
                  $this->error .= "Le champs heure de debut doit être rempli ";
                }
                if($this->data[self::HEURE_FIN_REF]==""){
                  $this->error .= "Le champs heure de fin doit être rempli";
                }
              }
           }


	}
 ?>
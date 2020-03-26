<?php
		class UserBuilder{
			protected $data;
			protected $error;
			const LN_REF = "nom";
			const FN_REF = "prenom";
			const ADRESS_REF = "adresse";
            const DIET_REF = "regimeAlimentaire";
            const COUNTRY_REF = "pays";
            const ALLERGY_REF = "allergie";
            const SIZE_REF = "tailleVetement";
            const TEL_REF = "tel";
            const MAIL_REF = "email";
            const LOGIN_REF = "login_admin";
            const ID_REF = "identifiant";
            const PICTURE_REF = "picture";
            const ORGANIZATION_REF = "organisation";

            public function __construct($d){
				$this->data = $d;
				$this->error = null;
            }
            public function createUser(){
                $user = new User(htmlspecialchars($this->data[self::FN_REF]), htmlspecialchars($this->data[self::LN_REF]),htmlspecialchars($this->data[self::ADRESS_REF]),
                htmlspecialchars($this->data[self::DIET_REF]),htmlspecialchars($this->data[self::COUNTRY_REF]),htmlspecialchars($this->data[self::ALLERGY_REF]),
                htmlspecialchars($this->data[self::SIZE_REF]),htmlspecialchars($this->data[self::TEL_REF]),
                htmlspecialchars($this->data[self::MAIL_REF]),
                 null,null,null
              );                
                   return $user;
            }
            public function getData(){
                return $this->data;
            }         
            public function isValid(){
                 if(($this->data[self::LN_REF]!="") && ($this->data[self::FN_REF]!="") && ($this->data[self::ADRESS_REF]!="") && ($this->data[self::DIET_REF]!="") && ($this->data[self::COUNTRY_REF]!="") && ($this->data[self::SIZE_REF]!="") && ($this->data[self::TEL_REF]!="") && ($this->data[self::MAIL_REF]!="")){
                        $this->error=null;
              }else{
                if($this->data[self::LN_REF]==""){
                  $this->error .= "Le champs nom doit être rempli ";
                }
                if($this->data[self::FN_REF]==""){
                    $this->error .= "Le champs prenom doit être rempli ";
                  }
                  if($this->data[self::ADRESS_REF]==""){
                    $this->error .= "Le champs adresse doit être rempli ";
                  }
                  if($this->data[self::COUNTRY_REF]==""){
                    $this->error .= "Le champs pays doit être rempli ";
                  }
                  if($this->data[self::ALLERGY_REF]==""){
                    $this->error .= "Le champs allergie doit être rempli ";
                  }
                  if($this->data[self::SIZE_REF]==""){
                    $this->error .= "Le champs taille vetement doit être rempli ";
                  }
                  if($this->data[self::TEL_REF]==""){
                    $this->error .= "Le champs telephone doit être rempli ";
                  }
                  if($this->data[self::MAIL_REF]==""){
                    $this->error .= "Le champs e-mail doit être rempli ";
                  }
              }
           }
          public function getError(){
              return $this->error;
          }
      }
   ?>

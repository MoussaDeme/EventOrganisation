<?php
		class AdminBuilder{
			private $data;
			private $error;
			const NAME_REF = "name";
			const LOGIN_REF = "login";
			const PASSWORD_REF = "pwd";
            
            public function __construct($d){
				$this->data = $d;
				$this->error = null;
            }
            public function createAdmin(){
                $admin = new Admin(htmlspecialchars($this->data[self::NAME_REF]), htmlspecialchars($this->data[self::LOGIN_REF]),
                              htmlspecialchars($this->data[self::PASSWORD_REF]));
                   return $admin;
            }
            public function getData(){
                return $this->data;
            }         
            public function isValid(){
                 if(($this->data[self::NAME_REF]!="") && ($this->data[self::LOGIN_REF]!="") && ($this->data[self::PASSWORD_REF]!="")){
                $this->error=null;
              }else{
                if($this->data[self::NAME_REF]==""){
                  $this->error .= "Le chmaps nom doit être rempli ";
                }
                if($this->data[self::LOGIN_REF]==""){
                  $this->error .= "Le champs pseudo doit être rempli ";
                }
                if($this->data[self::PASSWORD_REF]==""){
                  $this->error .= "Le champs mot de passe doit être rempli";
                }
              }
           }
  
          public function getError(){
              return $this->error;
          }
      }
   ?>

<?php
		class SponsorBuilder{
			private $data;
			private $error;
			const NAME_REF = "nom";
            const PICTURE_REF = "image";
			const CONTENT_REF = "contenu";
        
            public function __construct($d){
				$this->data = $d;
				$this->error = null;
            }
            public function createSponsor(){
                $sponsor = new Sponsor(htmlspecialchars($this->data[self::NAME_REF]),htmlspecialchars($this->data[self::CONTENT_REF]),null,null);                
                   return $sponsor;
            }
            public function getData(){
                return $this->data;
            }         
            public function isValid(){
                 if(($this->data[self::NAME_REF]!="")  && ($this->data[self::CONTENT_REF]!="")){
                        $this->error=null;
              }else{
                if($this->data[self::NAME_REF]==""){
                  $this->error .= "Le champs nom doit être rempli ";
                }
                if($this->data[self::CONTENT_REF]==""){
                    $this->error .= "Le champs contenu doit être rempli ";
                  }                  
              }
           }
          public function getError(){
              return $this->error;
          }
      }
   ?>

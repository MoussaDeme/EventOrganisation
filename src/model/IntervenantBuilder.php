 <?php
		class IntervenantBuilder extends UserBuilder{
			
			const BIOGRAPHY_REF = "bio";
        
            public function __construct($d){
				       parent::__construct($d);
            }
            public function createIntervenant(){
                $intervenant = new Intervenant(htmlspecialchars($this->data[parent::FN_REF]), htmlspecialchars($this->data[parent::LN_REF]),htmlspecialchars($this->data[parent::ADRESS_REF]),
                htmlspecialchars($this->data[parent::DIET_REF]),htmlspecialchars($this->data[parent::COUNTRY_REF]),htmlspecialchars(
                  $this->data[parent::ALLERGY_REF]),
                htmlspecialchars($this->data[parent::SIZE_REF]),htmlspecialchars($this->data[parent::TEL_REF]),
                htmlspecialchars($this->data[parent::MAIL_REF]),
                 null,null,null, htmlspecialchars($this->data[self::BIOGRAPHY_REF]));                
                   return $intervenant;
            }
            public function getData(){
                return $this->data;
            }         
            public function isValid(){
                 if(($this->data[self::LN_REF]!="") && ($this->data[self::FN_REF]!="") && ($this->data[self::ADRESS_REF]!="") && ($this->data[self::DIET_REF]!="") && ($this->data[self::COUNTRY_REF]!="") && ($this->data[self::SIZE_REF]!="") && ($this->data[self::TEL_REF]!="") && ($this->data[self::MAIL_REF]!="")){
                        $this->error=null;
              }else{
                if($this->data[self::LN_REF]==""){
                  $this->error .= "Le champs prenom doit être rempli ";
                }
                if($this->data[self::FN_REF]==""){
                    $this->error .= "Le champs nom doit être rempli ";
                  }                  
                  if($this->data[self::BIOGRAPHY_REF]==""){
                    $this->error .= "Le champs biographie doit être rempli ";
                  }
              }
           }
          public function getError(){
              return $this->error;
          }
      }
   ?>

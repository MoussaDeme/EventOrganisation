<?php 
	class Intervenant extends User{

		
		protected $bio;
		


		public function __construct($firstName, $lastName, $adress, $diet, $country, $allergy, $clothingSize, $telNumber,  $email, $login,$picture,$organization,$bio){
			parent::__construct($firstName, $lastName, $adress, $diet, $country, $allergy, $clothingSize, $telNumber,  $email, $login,$picture,$organization);
			$this->bio = $bio;
		}

		
		public function setBio($bio){
			$this->bio = $bio;
		}
		
		public function getBio(){
			return $this->bio;
		}
		

	}
 ?>
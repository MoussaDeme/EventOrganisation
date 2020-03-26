<?php 
	class Assister{
		private $date;
		private $heureDebut;
		private $heureFin;
		private $emailIntervenant;
		private $idProgramme;

		function __construct($date, $heureDebut, $heureFin, $emailIntervenant, $idProgramme){
			$this->date = $date;
			$this->heureDebut = $heureDebut;
			$this->heureFin = $heureFin;
			$this->emailIntervenant = $emailIntervenant;
			$this->idProgramme = $idProgramme;
		}

		public function getDate(){
			return $this->date;
		}
		public function getHeureDebut(){
			return $this->heureDebut;
		}
		public function getHeureFin(){
			return $this->heureFin;
		}
		public function getEmailIntervenant(){
			return $this->emailIntervenant;
		}
		public function getIdProgramme(){
			return $this->idProgramme;
		}

		public function setDate($date){
			$this->date = $date;
		}
		public function setHeureDebut($h){
			$this->heureDebut = $h;
		}
		public function setHeureFin($h){
			$this->heureFin = $h;
		}
		public function setEmailIntervenant($email){
			$this->emailIntervenant = $email;
		}
		public function setIdProgramme($id){
			$this->idProgramme = $id;
		}

	}
 ?>
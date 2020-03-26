<?php

class Sponsor
{

		private $name;
		private $content;
		private $picture;
		private $login;

		public function __construct($name, $content, $picture,$login){
			$this->name = $name;
			$this->content = $content;
			$this->picture = $picture;
			$this->login = $login;
		}

		public function setName($name){
			$this->name = $name;
		}
		public function setContent($content){
			$this->content = $content;
		}
		public function setPicture($picture){
			$this->picture = $picture;
		}

		public function getName(){
			return $this->name;
		}
		public function getContent(){
			return $this->content;
		}
		public function getPicture(){
			return $this->picture;
		}

	}
 ?>
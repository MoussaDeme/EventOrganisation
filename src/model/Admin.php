<?php 
		class Admin
		{
			private $name;
			private $login;
			private $passWord;

			function __construct($name, $login, $passWord)
			{
				$this->name = $name;
				$this->login = $login;
				$this->passWord = $passWord;
			}

			public function getName(){
				return $this->name;
			}
			public function getLogin(){
				return $this->login;
			}
			public function getPassWord(){
				return $this->passWord;
			}

			public function setName($name){
				$this->name = $name;
			}
			public function setLogin($login){
				$this->login = $login;
			}
			public function setPassWord($pwd){
				$this->passWord = $pwd;
			}
			public function newFunctionCreated()
            {

            }
		}
 ?>
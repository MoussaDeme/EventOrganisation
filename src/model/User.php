<?php

class User
{

    private   $firstName;
    private   $lastName;
    private   $adress;
    private   $diet; // Régime alimentaire
    private   $country;
    private   $organization;
    private   $allergy;
    private   $clothingSize;
    private   $telNumber;
    private   $email;
    private   $login;
    private   $picture;

    public function __construct($firstName, $lastName, $adress, $diet, $country, $allergy, $clothingSize, $telNumber,  $email, $login,$picture,$organization) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->adress = $adress;
        $this->diet = $diet;
        $this->country = $country;
        $this->allergy = $allergy;
        $this->clothingSize = $clothingSize;
        $this->telNumber = $telNumber;
        $this->email = $email;
        $this->login = $login;
        $this->picture = $picture;
        $this->organization = $organization;

    }


    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    public function setAdress($adress) {
        $this->adress = $adress;
    }
    public function setDiet($diet) {
        $this->diet = $diet;
    }
    public function setCountry($country) {
        $this->country = $country;
    }
    public function setOrganizaton($organization ){
      $this->organization = $organization;
    }
    public function setAllergy($allergy) {
        $this->allergy = $allergy;
    }
    public function setClothingSize($clothingSize) {
        $this->clothingSize = $clothingSize;
    }
    public function setTelNumber($telNumber) {
        $this->telNumber = $telNumber;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setLogin($login) {
        $this->login = $login;
    }
    public function setPicture($picture){
    	$this->picture = $picture;
    }


    public function getFirstName() {
        return $this->firstName;
    }
    public function getLastName() {
        return $this->lastName;
    }
    public function getAdress() {
        return $this->adress;
    }
    public function getDiet() {
        return $this->diet;
    }
    public function getCountry() {
        return $this->country;
    }
    public function getOrganization(){
      return $this->organization;
    }
    public function getAllergy() {
        return $this->allergy;
    }
    public function getClothingSize() {
        return $this->clothingSize;
    }
    public function getTelNumber() {
        return $this->telNumber;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getLogin() {
        return $this->login;
    }
    public function getPicture(){
    	return $this->picture;
    }

}

?>

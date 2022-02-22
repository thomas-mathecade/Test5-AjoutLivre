<?php
require_once "Mediatheque.php";
/**
 * 
 * Classe metier definissant l'objet livre
 * @author pascal
 *
 */
class Livre {
	/**id du livre*/
	private int $id;
	/**tite du livre*/
	private ?string $titre;
	/**edition  du livre*/
	private ?string $edition;
	/**information*/
	private ?string $information;
	/**auteur*/
	private ?string $auteur;

	//constructeur
	public function __construct(int $id, string $titre, string $edition, string $information, string $auteur){
		$this->id=$id;
		$this->titre=$titre;
		$this->edition=$edition;
		$this->information=$information;
		$this->auteur=$auteur;
	}
	//getteurs
	public function getId(){
		return $this->id;
	}
	public function getTitre(){
		return $this->titre;
	}
	public function getEdition(){
		return $this->edition;
	}
	public function getInformation(){
		return $this->information;
	}
	public function getAuteur(){
		return $this->auteur;
	}
	//setteurs
	public function setId(int $id){
		if($id!=null){
			$this->id=$id;
		}
	}
	public function setTitre(string $titre){
		if($titre!=null && is_string($titre)){
			$this->titre=$titre;
		}
	}
	public function setEdition(string $edition){
		if($edition!=null && is_string($edition)){
			$this->edition=$edition;
		}
	}
	public function setInformation(string $information){
		if($information!=null && is_string($information)){
			$this->information=$information;
		}
	}
	public function setAuteur(string $auteur){
		if($auteur!=null && is_string($auteur)){
			$this->auteur=$auteur;
		}
	}

	//methode toString
	public function __toString(){
			return '[' .$this->getId().', '
			.$this->getTitre(). ','
			.$this->getEdition(). ','
			.$this->getInformation(). ','
			.$this->getAuteur(). ']';
			
		}
}
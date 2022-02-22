<?php
require_once "Constantes.php";
require_once "metier/Livre.php";
require_once "MediathequeDB.php";

class LivreDB extends MediathequeDB
{
	private $db; // Instance de PDO
	public $lastId;
	//TODO implementer les fonctions
	public function __construct($db)
	{
		$this->db=$db;
	}
	/**
	 * 
	 * fonction d'Insertion de l'objet Livre en base de donnee
	 * @param Livre $l
	 */
	public function ajout(Livre $l) {
		$q = $this->db->prepare('INSERT INTO livre(titre, edition, information, auteur) VALUES (:titre, :edition, :information, :auteur)');
		$q->bindValue(':titre',$l->getTitre());
		$q->bindValue(':edition',$l->getEdition());
		$q->bindValue(':information',$l->getInformation());
		$q->bindValue(':auteur',$l->getAuteur());
		$q->execute();	

    	$this->lastId=$this->db->lastInsertId();
		$q->closeCursor();
		$q = NULL;
	}
/**
	 * 
	 * fonction d'update de l'objet Livre en base de donnee
	 * @param Livre $l
	 */
	public function update(Livre $l) {
		try {
			$q = $this->db->prepare('UPDATE livre SET titre=:t, edition=:e, information=:n, auteur=:a WHERE id=:i');
			$q->bindValue(':i', $l->getId());	
			$q->bindValue(':t', $l->getTitre());	
			$q->bindValue(':e', $l->getEdition());	
			$q->bindValue(':n', $l->getInformation());	
			$q->bindValue(':a', $l->getAuteur());	
			$q->execute();	

			$q->closeCursor();
			$q = NULL;
		} catch(Exception $e){
			throw new Exception(Constantes::EXCEPTION_DB_LIV_UP); 
		}
	}
    /**
     * 
     * fonction de Suppression de l'objet Livre
     * @param Livre $l
     */
	public function suppression(Livre $l) {
		$q = $this->db->prepare('DELETE FROM adresse WHERE id=:id');
		$q->bindValue(':id', $l->getId());
		$res=$q->execute();	
			
		$q->closeCursor();
		$q = NULL;
        return $res;
	}
/**
	 * 
	 * Fonction qui retourne toutes les livres
	 * @throws Exception
	 */
	public function selectAll(){
		$query = 'SELECT id, titre, edition, information, auteur FROM livre';
		$q = $this->db->prepare($query);
		$q->execute();
		
		$arrAll = $q->fetchAll(PDO::FETCH_ASSOC);
		
		if(empty($arrAll)){
			throw new Exception(Constantes::EXCEPTION_DB_LIVRE);
		}
		
		$result=$arrAll;

		$q->closeCursor();
		$q = NULL;
		return $result;
	}

	public function selectLivre($id){
		$query = 'SELECT id, titre, edition, information, auteur FROM livre WHERE id=:id ';
		$q = $this->db->prepare($query);

		$q->bindValue(':id', $id);
		$q->execute();
		
		$arrAll = $q->fetch(PDO::FETCH_ASSOC);

		if(empty($arrAll)){
			throw new Exception(Constantes::EXCEPTION_DB_LIVRE); 
		}
		
		$q->closeCursor();
		$q = NULL;
		$res= $this->convertPdoLiv($arrAll);
		return $res;
	}

        /**
	 * 
	 * Fonction qui convertie un PDO Livre en objet Livre
	 * @param $pdoLivr
	 * @throws Exception
	 */
	public function convertPdoLiv($pdoLivr){
		if(empty($pdoLivr)){
			throw new Exception(Constantes::EXCEPTION_DB_CONVERT_LIVR);
		}
		
		try {
			$obj=(object)$pdoLivr;
			$i=(int)$obj->id;

			$livr=new Livre($i, $obj->titre, $obj->edition, $obj->information, $obj->auteur);
			$livr->setId($obj->id);
			return $livr;	 
		
		}catch(Exception $e){
			throw new Exception(Constantes::EXCEPTION_DB_CONVERT_LIVR.$e);
		}
	}
}
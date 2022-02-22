<?php
use PHPUnit\Framework\TestCase;
require_once "Constantes.php";
require_once "metier/Livre.php";
require_once "PDO/LivreDB.php";


class LivreDBTest extends TestCase {

    /**
     * @var LivreDB
     */
    protected $object;
    protected $pdodb;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp():void {
        //parametre de connexion à la bae de donnée
        $strConnection = Constantes::TYPE . ':host=' . Constantes::HOST . ';dbname=' . Constantes::BASE;
        $arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $this->pdodb = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam); //Ligne 3; Instancie la connexion
        $this->pdodb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown():void {

    }

    /**
     * @covers LivreDB::ajout
     * @todo   Implement testAjout().
     */
    public function testAjout() {
        try {
            $this->livre = new LivreDB($this->pdodb);
            $l = new Livre(99, "livre de Flaubert", "Galimard", "titre ajout", "Flaubert");

            $this->livre->ajout($l, 4);

            $livr=$this->livre->selectLivre($l->getId());
            $this->assertEquals($l->getTitre(), $livr->getTitre());
            $this->assertEquals($l->getEdition(), $livr->getEdition());
            $this->assertEquals($l->getInformation(), $livr->getInformation());
            $this->assertEquals($l->getAuteur(), $livr->getAuteur());
            $this->livre->suppression($livr);
        } catch (Exception $e) {
            echo 'Exception recue : ', $e->getMessage(), "\n";
        }
    }

    /**
     * @covers LivreDB::update
     * @todo   Implement testUpdate().
     */
    public function testUpdate() {
        $this->livre = new LivreDB($this->pdodb);

        $l = new Livre(100, "Seigneur des anneaux", "Plomb", "titre update", "JRR Tolkien");
        $l->setId(99);

        $this->livre->ajout($l);

        $l = new Livre(101, "Anéantir", "Flammarion", "titre update", "Michel Houellebecq");

        $lastId = $this->pdodb->lastInsertId();
        $l->setId($lastId);
        $this->livre->update($l);  

        $livr=$this->livre->selectLivre($l->getId());
        $this->assertEquals($l->getTitre(), $livr->getTitre());
        $this->assertEquals($l->getEdition(), $livr->getEdition());
        $this->assertEquals($l->getInformation(), $livr->getInformation());
        $this->assertEquals($l->getAuteur(), $livr->getAuteur());
    }

    /**
     * @covers LivreDB::suppression
     * @todo   Implement testSuppression().
     */
    public function testSuppression() {
        $this->livre = new LivreDB($this->pdodb);

        $livr1=$this->livre->selectLivre(2);
        $this->livre->suppression($livr1);
        $livr2=$this->livre->selectLivre(2);

        if($livr2!=null){
            $this->markTestIncomplete("La suppression de l'enreg livre a echoué");
        }
    }

    /**
     * @covers LivreDB::selectAll
     * @todo   Implement testSelectAll().
     */
    public function testSelectAll() {
        $this->livre = new LivreDB($this->pdodb);
        $res=$this->livre->selectAll();
        $i=0; 
        $ok=true;

        foreach ($res as $key=>$value) {
            $i++; 
        }
    
            
        if($i==0){
            $this->markTestIncomplete('Pas de résultats');
            $ok=false;
        }

        $this->assertTrue($ok);
        print_r($res);
    }

    /**
     * @covers LivreDB::selectLivre
     * @todo   Implement testSelectLivre().
     */
    public function testSelectLivre() {
        $this->livre = new LivreDB($this->pdodb);
        $l=$this->livre->selectLivre(2);
        $livr=$this->livre->selectLivre($l->getId());

        $this->assertEquals($l->getTitre(), $livr->getTitre());
        $this->assertEquals($l->getEdition(), $livr->getEdition());
        $this->assertEquals($l->getInformation(), $livr->getInformation());
        $this->assertEquals($l->getAuteur(), $livr->getAuteur());
    }

    public function testconvertPdoLiv() {
        $tab["id"]="2";
        $tab["titre"]="L’Étranger";
        $tab["edition"]="Galimard";
        $tab["information"]="";
        $tab["auteur"]="Albert Camus";

        $this->livre = new LivreDB($this->pdodb);
        $livr= $this->livre->convertPdoLiv($tab);
        $this->assertEquals($tab["titre"],$livr->getTitre());
        $this->assertEquals($tab["edition"],$livr->getEdition());
        $this->assertEquals($tab["information"],$livr->getInformation());
        $this->assertEquals($tab["auteur"],$livr->getAuteur());
        
       }

}

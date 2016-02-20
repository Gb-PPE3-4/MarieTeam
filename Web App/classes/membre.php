<?PHP
	// Classe membre 
	class Membre{
		
		// $utilisateur = unserialize($_SESSION['utilisateur']) ;   *********** ACCES APRES SEIRALISATION DANS $_SESSION
		// $utilisateur->getNom() ;
		
		private $id ;
		private $login ;
		private $nom ;
		var $prenom ;
		var $mail ;
		var $droit ;			// 0 (droits de base, basique, droits limités, modifications des données mais suivis des modifs)
								// ou 1 (droits complets : ajouts, modification, suprresion membres en plus du reste)
		var $dateInsc ;
		
		// Constructeur classe Membre
		public function Membre($id, $mdp) {
			
			$num_rows = 0 ;
			$identifiant = 'id' ;
			
			$identifiant = $this->idOrLogin($id) ;
			$req= "SELECT * FROM membre WHERE ".$identifiant."= '".$id."' AND mdp= '".$mdp."'";
			$base = connexion() ;
			
			try {
				$resReq = $base->query($req); 							//query pour lecture, exec pour ecriture, modif
			}catch (PDOException $e) {
				echo 0 ;
			}															// requête SQL de selection du membre se connectant en comparant son ID et son MDP
            if(PDO_num_rows($req)==1){									// un seule utilisateur se connecte, donc il n'y à qu'une ligne à vérifier, si il y en a plus, c'est une erreur.
				$jE = $resReq->fetchAll(PDO::FETCH_ASSOC);				//$contenue  récupère untableau de valeur contenant les valeur du membre se connectant
				foreach ($jE as $table => $row) {
					if(isset($row['id']) && $row['id'] != ""){
						$this->id = $row['id'] ;
						$this->login = $row['login'] ;
						$this->nom = $row['nom'] ;
						$this->prenom = $row['prenom'] ;
						$this->mail = $row['mail'] ;
						$this->droit = $row['droit'] ;
						$this->dateInsc = $row['dateInsc'] ;
						
						$this->membreActuel();		   						//le nouveaux membre utilisateur devient un membreActuel.
					}
				}
				$base = null ; 		//************** DECONNEXION BASE DE DONNEES **************\\	                
			}else{
				return null;
			}
		}

		function membreActuel(){										// Etabli l'instance Membre comme étant celle utilisée par la session
			$_SESSION['droit'] = $this->droit ;
			$_SESSION['ID'] = $this->id ;
			$_SESSION['login'] = $this->login ;
			$_SESSION['nom'] = $this->nom ;
			$_SESSION['prenom'] = $this->prenom ;
		}
	
		function idOrLogin($id){
			// identification : deux methodes, avec id, avec login
			// renvoie id ou login selon le type du parametre
			$retour = '' ;
			if(strval($id) == strval(intval($id,10))){
				$retour = 'id' ;
			}else{
				$retour = 'login' ;
			}
			return $retour ;
		}
		
		function getNom(){
			return $this->nom ;
		}
		
		function getPrenom(){
			return $this->prenom ;
		}
		function getLogin(){
			return $this->login ;
		}
		
		function getMail(){
			return $this->mail ;
		}
			
		
		function getDroit(){
			return $this->droit ;
		}
		
		function getDateInsc(){
			return $this->dateInsc ;
		}
		
		function setNom(){
			$nom = $this->nvNom ;
		}
		
		function setPrenom(){
			$prenom = $this->nvPrenom ;
		}
		
		function setMail(){
			$mail = $this->nvMail ;
		}
		
		function setDroit(){
			$droit = $this->nvDroit ;
		}
		function setDateInsc(){
			$dateInsc = $this->nvdateInsc ;
		}
		
	}
?>
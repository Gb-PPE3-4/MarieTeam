<?PHP
	if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
	{
		$_REQUEST['fonction']($_REQUEST);
	}
	
	function connexion(){
		
		$base = null ;
		
		try{
			$dsn = 'mysql:host=localhost;dbname=marieteam_bd';
			$username = 'root';
			$password = '';
			$options = array(
			// prise en compte de l'UTF8 
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$base = new PDO($dsn, $username, $password, $options);
			
		}catch (PDOException $e) {
			// En cas d'erreur, on affiche un message et on arrete tout
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}finally{
			return $base ;
		}
	}
	
	// ATTR_CURSOR et CURSOR_SCROLL : options du driver permettant de demander un curseur scrollable à la construction du statement ;
	function retourneStatementSelect($sql){
		$base = connexion() ;										// connexion a la bdd
		$stmt = $base->prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL)); // preparation du statement avec requete SQL
		$stmt->execute();											// execution du statement (pret pour exploitation avec fetch)
		$base = null;												// ferme la connexion a la bdd
		return $stmt ;												// retourne objet statement pret pour exploitation avec while fetch
	}
	
	function PDO_num_rows($sql){
		
		$numRows = 0 ;	$stmt = retourneStatementSelect($sql) ;
		
		// var_dump($results);									// Fetch asssoc permet de recupere un tableau associatif
																// dont le deplacement du curseur ligne par ligne effectue par le fetch
																// est possible grace a ATTR_CURSOR et CURSOR_SCROLL
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){	$numRows = $numRows + 1;	}
		$stmt = null ;
		return $numRows ;
	}
		
	function afficheSecteurs(){
		// Recuperation des secteurs a afficher en liste laterale gauche // Appelee dans header/ul class=sidebar-nav
		$stmt = retourneStatementSelect("SELECT nom, idsecteur FROM secteur") ;
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				echo '	<li><a href="consultation.php?secteur='.$resultat['idsecteur'].'">'.$resultat['nom'].'</a></li>';
		}
		$stmt = null ;
	}
		
	function afficheLiaisonSelect($idSecteur){
		// Selection des liaisons du secteur choisi a afficher en liste
		$lignes = '' ;	$selected = '' ;
		if(isset($_GET['secteur']) && $_GET['secteur'] != ""){	$idSecteur=$_GET['secteur'] ;
		}else if(!isset($_GET['secteur']) || $idSecteur==''){$idSecteur = 1;}
		
		if(!isset($_GET['idliaison'])){	$lignes .= '<option selected="selected">Choisissez une liaison ici</option>' ;
		}else if(isset($_GET['idliaison']) && $_GET['idliaison'] != ''){	$idliaison = $_GET['idliaison'] ;	}	// pre-selectionne si get avec valeur
		
		// Recuperation de ts les ports
		$stmt = retourneStatementSelect("SELECT idport, nom FROM port") ;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			if($row != null){	$ports[$row['idport']] = $row['nom'] ;	}
		}
		$stmt = null;
		
		// Recuperation de ttes les liaisons
		$sql = "SELECT * FROM liaison WHERE idsecteur ='".$idSecteur."'" ;
		
		//S'il y a bien des liaisons pour ce secteur	
		if(PDO_num_rows($sql)>0){ 
			$stmt = retourneStatementSelect($sql) ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC)) {				
				if($idliaison == $resultat['code']){$selected = 'selected="selected"' ;}				
				$lignes .= '<option '.$selected.' value="'.$resultat['code'].'" attr_idportdepart="'.$resultat['idportdepart'].'" attr_idportarrivee="'.$resultat['idportarrivee'].'">' ;
				foreach($ports as $key => $unPort){
					if($key == $resultat['idportdepart']){	$lignes .=  $unPort ;	}
				}
				foreach($ports as $key => $unPort){
					if($key == $resultat['idportarrivee']){		$lignes .=  ' - '.$unPort ;	}
				}
				$selected = '' ;
				$lignes .=  '</option>' ;
			}
		}else{$lignes = '<option value="0">Aucune liaison dans ce secteur</option>';}
		$stmt = null;
		echo $lignes ;
	}	
	
	function afficheDateTraverseeSelect($idLiaison){
		
		$selected = '' ;	$date = '' ;	$svDate = "" ;
		// svDate > sauvegarde de l date precedente pour eviter de la mettre plus d'une fois	
		
		$lignes = '<div class="col-lg-4 noMargin">	<select class="form-control" id="slct_dateLiaison">' ;
		
		// pre-selectionne si get avec valeur
		if(!isset($_GET['date'])){	$lignes .= '<option selected="selected">Choisissez une date ici</option>' ;
		}else if(isset($_GET['date']) && $_GET['date'] != ''){	$date = $_GET['date'] ;	}
		
		// Selection des liaisons du secteur choisi a afficher en liste
		$sql = "SELECT dateTraversee FROM traversee WHERE idliaison = ".$idLiaison." ORDER BY dateTraversee" ;
		if(PDO_num_rows($sql)>0){ //S'il y a bien des dates (traversées) pour cette liaison	
			$stmt = retourneStatementSelect($sql) ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				if($svDate != $resultat['dateTraversee']){
					if($date == $resultat['dateTraversee']){$selected = 'selected="selected"' ;}
					$lignes .= '	<option '.$selected.' value="'.$resultat['dateTraversee'].'">'.setDateFormatLecture($resultat['dateTraversee']).'</option>';
					$svDate = $resultat['dateTraversee'] ;
				}
				$selected = '' ;
			}
			$stmt = null ;
			
		}else{$lignes .= '<option value="0">Aucune date disponible pour cette liaison</option>';}
		$lignes .= '</select>	</div>' ;
		echo $lignes ;
	}	
	
	function afficheTraverseeTableCheck(){
		
		$lignes = "" ;
		// Recupeeration des donnees de filtrage /idliaison et date
		if(isset($_GET['idliaison']) && $_GET['idliaison'] != "" && isset($_GET['date']) && $_GET['date'] != ""){
			$idLiaison=$_GET['idliaison'] ;
			$date=$_GET['date'] ;
		
		// Preparation de la table /HTML
		$lignes .= '	<div class="col-lg-8 noMargin"><h5></h5></div>
						<div id="desc_options" class="col-lg-4 noMargin">
							<h4>OU</h4><h5>choisir une</h5>
							<div class="page-header" id="header_tableTraversee">
								<legend>Traversée</legend>
							</div>
						</div>
						<!-- Table dynamique avec plusieurs options voire head pour plus, Table Master -->
						<div class="container theme-showcase" id="div_tableTraversee" role="main">
							<div class="row">
								<div class="col-lg-12">
									<table
										data-toggle="table"
										data-mobile-responsive="true"
										data-check-on-init="true"
										data-show-toggle="true"
									class="table table-striped">' ;
		// Entête de la table
		$lignes .= '<thead><tr>
							<th data-checkbox="true"></th>
							<th data-sortable="true">N° Traversée</th>
							<th data-sortable="true">Date</th>
							<th>Heure</th>
							<th data-sortable="true">Bateau</th>
							<th data-sortable="true">Distance</th>
					</tr></thead>' ;
						
			
			// Selection des traversees de la liaison choisie a la date choisie / mise en forme tr td
			$sql = "SELECT * FROM traversee WHERE idliaison='".$idLiaison."' AND dateTraversee='".$date."' ORDER BY dateTraversee, num" ;
			
			$stmt = retourneStatementSelect($sql) ;
			$lignes .= '<body>' ;
			// data-nom utilisee pour echapper la valeur de l'attribut a la generation du code par bootstrap
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignes .= '<tr id="'.$resultat['num'].'" class="row_traversee">
								<td></td>
								<td data-nom="num">'.$resultat['num'].'</td>
								<td data-nom="dateTraversee">'.setDateFormatLecture($resultat['dateTraversee']).'</td>
								<td data-nom="heure">'.$resultat['heure'].'</td>';
				// Recupere le du bateau
				$stmtBateau = retourneStatementSelect("SELECT nom FROM bateau WHERE idbateau='".$resultat['idbateau']."'") ;
				while( $resultatBateau = $stmtBateau->fetch(PDO::FETCH_ASSOC) ){
					$lignes .= '<td data-nom="nomBateau">'.$resultatBateau['nom'].'</td>';
				}
				$stmtBateau = null;
				// Recupere la distance de la liaison
				$stmtDistance = retourneStatementSelect("SELECT distance FROM liaison WHERE code='".$idLiaison."'") ;
				while( $resultatDistance = $stmtDistance->fetch(PDO::FETCH_ASSOC) ){
					$lignes .= '<td data-nom="distance">'.$resultatDistance['distance'].' km</td>';
				}
				$stmtDistance = null;
				$lignes .= '</tr>' ;
			}
			$lignes .= '</body>' ;
			$stmt = null;
			
			$lignes .= '</table>	</div>	</div>	</div>' ;
		}
		echo $lignes ;
	}	
	
	function recupPrix($idliaison, $date){
		
		$prix = '' ;
		$connexion = connexion() ;
		if($date == 'yes' || $date == 'y'){
			// Seléction des prix à afficher en liste
			$resultats=$connexion->query("SELECT T.idperiode, lettre, num, tarif FROM `tarifer` AS T, `periode` AS P WHERE idliaison=".$idliaison." AND T.idperiode=P.idperiode ORDER BY T.idperiode, lettre, num");
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while( $resultat = $resultats->fetch() ){
				if($resultat->tarif != '' && $resultat->tarif!=null){
					$prix[$resultat->idperiode.'-'.$resultat->lettre.$resultat->num] = $resultat->tarif ;
				}
			}
			$resultats->closeCursor();
		}else{
			
			// Selection des prix à afficher en liste / renvoie un tableau avec la categ+type et le prix
			$resultats=$connexion->query("SELECT idliaison, T.idperiode, lettre, num, tarif FROM `tarifer` AS T, `periode` AS P WHERE idliaison=".$idliaison." AND T.idperiode=P.idperiode AND (P.datedeb < '".$date."' OR P.datedeb = '".$date."')AND (P.datefin > '".$date."'  OR P.datedeb = '".$date."') ORDER BY lettre, num");
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while( $resultat = $resultats->fetch() ){
					$prix[$resultat->lettre.$resultat->num] = $resultat->tarif ;
			}
			$resultats->closeCursor();
		}
		$connexion = null ;
		return $prix ;
	}

	function recupPlacesRestantes($data){
		
		$placesRestantes = array() ;
		$idtraversee = $data['params']['idtraversee'] ;
		// Recup des données de filtrage
		if(isset($idtraversee) && $idtraversee != "" && $idtraversee != 0 && $idtraversee != "0"){
			
			// Selection des traversées de la liaison choisie à la date choisie
			$sql = "SELECT C.lettre, C.capaciteMax AS places FROM `traversee` AS T, `contenir` AS C WHERE T.idbateau = C.idbateau	AND T.num=".$idtraversee ;
			$stmt = retourneStatementSelect($sql) ;				
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$placesRestantes[$resultat['lettre']] = intval($resultat['places']) ;
			}
			$stmt = null;
				
			$sql = "SELECT E.lettre, SUM(E.quantite) AS NbPlaces FROM `reservation` AS R, `enregistrer` AS E WHERE R.idreservation=E.idreservation AND R.idtraversee=".$idtraversee." GROUP BY E.lettre" ;
			$stmt = retourneStatementSelect($sql) ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				if(isset($resultat['NbPlaces']) && $resultat['NbPlaces'] != 0 && $resultat['NbPlaces'] != null){
					$placesRestantes[$resultat['lettre']] = intval($placesRestantes[$resultat['lettre']]) - intval($resultat['NbPlaces']) ;
				}
			}
			$stmt = null;
		}
		/*
			array (size=3)
			  0 => int 233
			  1 => int 118
			  2 => int 59
		*/
		// var_dump($placesRestantes);
		$indexed = array_values($placesRestantes);
		echo substr(json_encode($indexed), 1, strlen(json_encode($indexed))-2) ;
	}	
	
	function retourneTabReservation($data){
		// recupere le tableau de valeurs fourni en ajax / renvoie une table (avec input) avec les valeurs et les prix recuperes par recupPrix
		$idliaison = $data['params']['idliaison'] ;
		$date = $data['params']['date'] ;
		$idtraversee = $data['params']['idtraversee'] ;
		$prix = '' ;
		$prix = recupPrix($idliaison,$date)  ;
		
		if(isset($prix['A1']) && $prix['A1']!= '' && $prix['A1'] != null){
			$lignes = '			<div class="col-lg-12 col-md-2">
									<form class="form-horizontal">
										<fieldset>
											<div class="form-group">
												<h3>Sélectionner les options de votre réservation :</h3>
												<div class="col-lg-1"><label for="txt_nomR" class="control-label">Nom <span class="txt_red">*</span></label></div>
												<div class="col-lg-2">
													<input id="txt_nomR" name="txt_nomR" placeholder="Votre nom" type="text" class="form-control" required="required">
												</div>
												<div class="col-lg-1"><label for="txt_adresseR" class="control-label">Adresse <span class="txt_red">*</span></label></div>
												<div class="col-lg-2">
													<input id="txt_adresseR" name="txt_adresseR" placeholder="Votre adresse" type="text" class="form-control" required="required">
												</div>
												<div class="col-lg-1"><label for="txt_cpR" class="control-label">CP <span class="txt_red">*</span></label></div>
												<div class="col-lg-2">
													<input id="txt_cpR" name="txt_cpR" placeholder="Code Postal" type="number" class="form-control" min="10000" step="1" required="required">
												</div>
												<div class="col-lg-1"><label for="txt_villeR" class="control-label">Ville <span class="txt_red">*</span></label></div>
												<div class="col-lg-2">
													<input id="txt_villeR" name="txt_villeR" placeholder="Votre ville" type="text" class="form-control" required="required">
												</div>
											</div>
											
											<div class="form-group">
												<table id="tabTableReserv" class="table table-striped table-bordered table-hover table-condensed"> 
													<tr>
														<th id="idliaison">Liaison n°'.$idliaison.'</th>
														<th>Période</th>
														<th>Places</th>
														<th>Type</th>
														<th id="th_qteTableReserv">Quantité <span class="txt_red">*</span></th>
														<th><span class="pc">Prix </span>€</th>
													</tr>
													<tr>
														<td rowspan="10">Traversée n°'.$idtraversee.'</td>
														<td id="date" rowspan="10">'.setDateFormatLecture($date).'</td>
													</tr>
													<tr>
														<td rowspan="3"><span id="A" class="placesRest">310</span></td>
														<td>A1 <span class="pc">- Adulte</span></td>
														<td>
																<input id="A1qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixA1" class="prix">'.$prix['A1'].'</td>
													</tr>
													<tr>
														<td>A2 <span class="pc">- Junior 8 à  18 ans</span></td>
														<td>
																<input id="A2qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixA2" class="prix">'.$prix['A2'].'</td>
													</tr>
													<tr>
														<td>A3 <span class="pc">- Enfant 0 à 7 ans</span></td>
														<td>
																<input id="A3qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixA3" class="prix">'.$prix['A3'].'</td>
													</tr>
													<tr>
														<td rowspan="2"><span id="B" class="placesRest">310</span></td>
														<td>B1 <span class="pc">- Voiture à longueur inférieure à 4m</span></td>
														<td>
																<input id="B1qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixB1" class="prix">'.$prix['B1'].'</td>
													</tr>
													<tr>
														<td>B2 <span class="pc">- Voiture à longueur inférieure à 5m</span></td>
														<td>
																<input id="B2qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixB2" class="prix">'.$prix['B2'].'</td>
													</tr>
													<tr>
														<td rowspan="3"><span id="C" class="placesRest">310</span></td>
														<td>C1 <span class="pc">- Fourgon</span></td>
														<td>
																<input id="C1qte" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixC1" class="prix">'.$prix['C1'].'</td>
													</tr>
													<tr>
														<td>C2 <span class="pc">- Camping Car</span></td>
														<td>
																<input id="C2qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixC2" class="prix">'.$prix['C2'].'</td>
													</tr>
													<tr>
														<td>C3 <span class="pc">- Camion</span></td>
														<td>
																<input id="C3qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixC3" class="prix">'.$prix['C3'].'</td>
													</tr>
												</table>
												</div>
												<div class="col-lg-2"><h3></h3></div>
												<div class="col-lg-1"><label for="txt_totalPrix" class="control-label">Total HT €</label></div>
												<div class="col-lg-2">
													<input disabled id="txt_totalPrix" name="" value="0" type="number" class="form-control">
												</div>
												<div class="col-lg-3"><a data-toggle="modal" data-target="#div_confirmReserv" id="btn_validerRservation" style="width:100%;" class="btn btn-success">Valider la réservation</a></div>
												<div class="col-lg-3"><a id="btn_retourVersTraversee" style="width:100%;" class="btn btn-warning">Retour</a></div>
											</div>
										</fieldset>
									</form>
								</div>';
		}else{
			$lignes = '<div class="col-lg-6"><a id="btn_retourVersTraversee" style="width:100%;" class="btn btn-warning">Retour</a></div><div class="col-lg-6">Pas de tarification à jour. </div>' ;
		}
		echo $lignes ;
	}
	
	function retourneStatementInsertReservation($data){
		$base = connexion() ;
		$stmt = $base->prepare("INSERT INTO reservation (idreservation, nom, adresse, cp, ville, idtraversee, dateEnregistrement) VALUES ('',:nom, :adresse, :cp, :ville, :idtraversee, NOW())");
		$stmt->bindParam(':nom', $nom);
		$stmt->bindParam(':adresse', $adresse);
		$stmt->bindParam(':cp', $cp);
		$stmt->bindParam(':ville', $ville);
		$stmt->bindParam(':idtraversee', $idtraversee);
		
		$nom = $data['params']['nom'] ;
		$adresse = $data['params']['adresse'] ;
		$cp = $data['params']['cp'] ;
		$ville = $data['params']['ville'] ;
		$idtraversee = $data['params']['idtraversee'] ;
		
		$stmt->execute();
		$base = null ;
		return $stmt ;
	}
	
	function retourneStatementInsertEnregistrer($data){
		$base = connexion() ;
		$stmtID = retourneStatementSelect("SELECT MAX(idreservation) as ID FROM reservation WHERE nom='".$data['params']['nom']."'") ;
		while( $resultat = $stmtID->fetch(PDO::FETCH_ASSOC) ){
				$idreservation = $resultat['ID'] 	;
		}
		$stmtID = null ;
		
		$stmt = $base->prepare("INSERT INTO enregistrer (lettre, num, idreservation, quantite) VALUES (:lettre, :num, ".$idreservation.", :quantite)");
		$stmt->bindParam(':lettre', $lettre);
		$stmt->bindParam(':num', $num);
		$stmt->bindParam(':quantite', $quantite);
		
		foreach($data['params']['tab'] as $key => $val){
			$lettre = $key[0] ;
			$num = $key[1] ;
			$quantite = $val ;
			
			$stmt->execute();
		}
		
		$base = null ;
		return $stmt ;
	}

	function enregistrerNouvelleReserv($data){
		
		$stmtReserv = retourneStatementInsertReservation($data) ;
		$stmtEnr = retourneStatementInsertEnregistrer($data) ;
		
		if($stmtReserv == false || $stmtEnr == false){
			echo 'false ' ;
		}else{
			echo 'true' ;
		}
		
		$stmtReserv = null ;
		$stmtEnr = null ;
	}
		
	function setDateFormatInsertion($date){														// Prend le format DATE JJ/MM/AAAA retourné par l'user et renvoie
		$ResDate = explode('/',$date) ;															// le format DATE AAAA-MM-JJ utilisé par la BDD
		return $ResDate[2].'-'.$ResDate[1].'-'.$ResDate[0] ;									// -> Utilisée pour l'insertion de la date dans la BDD
	}
	function setDateFormatLecture($date){														// Prend le format DATE AAAA-MM-JJ utilisé par la BDD et renvoie
		$ResDate = explode('-',$date) ;															// le format DATE JJ/MM/AAAA utilisé par l'user
		return $ResDate[2].'/'.$ResDate[1].'/'.$ResDate[0] ;									// -> Utilisée pour la lecture de la date dans l'IHM
	}
	
?>	
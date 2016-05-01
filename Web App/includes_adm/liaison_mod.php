<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;
	$nomPortDepart = "" ;	$nomPortArrivee = "" ;	$selectedDepart = "" ;	$selectedArrivee = "" ;

	if(isset($_GET['mod']) && $_GET['mod'] != ""){
		$lignes = ' 			<form method="post" class="form-horizontal">
									  <legend>Choisissez un liaison à modifier :</legend>
								  <fieldset class="col-lg-4">
									<div class="form-group">
									  <div>
										<select class="form-control" name="select_liaison" id="select_liaison">' ;
		
		$stmtLiaison = retourneStatementSelect('SELECT code, idsecteur, idportdepart, idportarrivee, distance FROM liaison') ;
		while( $resultatLiaison = $stmtLiaison->fetch(PDO::FETCH_ASSOC) ){
			$stmtPort = retourneStatementSelect('SELECT idport, nom FROM port') ;
			while( $resultatPort = $stmtPort->fetch(PDO::FETCH_ASSOC) ){
				if($resultatLiaison['idportdepart'] == $resultatPort['idport']){$nomPortDepart = $resultatPort['nom'] ;}
				if($resultatLiaison['idportarrivee'] == $resultatPort['idport']){$nomPortArrivee = $resultatPort['nom'] ;}
			}
			$lignes .= '	<option value="'.$resultatLiaison['code'].'">'.$nomPortDepart.' - '.$nomPortArrivee.'</option>';
		}
		$lignes .= '
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_nom" control-label">Nom du liaison</label>
									  <div>
										<input type="text" class="form-control" name = "input_nom" id="input_nom" value="">
									  </div>
									</div>
									<div class="form-group">
									  <div>
									    <label for="select_depart" control-label">Port de départ</label>
										<select class="form-control" name="select_depart" id="select_depart">' ;
		
		$stmt = retourneStatementSelect('SELECT idport, nom FROM port') ;
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
			//if($resultat['idport'] == $resultatLiaison['idportdepart']){$selectedDepart = 'selected="selected"' ;}else{$selectedDepart = '' ;}
			$lignes .= '	<option value="'.$resultat['idport'].'" '.$selectedDepart.'>'.$resultat['nom'].'</option>';
		}
		$lignes .= '
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <div>
									    <label for="select_arrivee" control-label">Port d\'arrivée</label>
										<select class="form-control" name="select_arrivee" id="select_arrivee">' ;
		
		$stmt = retourneStatementSelect('SELECT idport, nom FROM port') ;
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
			//if($resultat['idport'] == $resultatLiaison['idportarrivee']){$selectedArrivee = 'selected="selected"' ;}else{$selectedArrivee = '' ;}
			$lignes .= '	<option value="'.$resultat['idport'].'" '.$selectedArrivee.'>'.$resultat['nom'].'</option>';
		}
		$lignes .= '
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_dist" control-label">Distance en km</label>
									  <div>
										<input type="text" class="form-control" name = "input_dist" id="input_dist" value="">
									  </div>
									</div>
									<div>
										<button type="" id="crea_choixSect" class="btn btn-primary">Valider</button>
										<button type="" id="upd_choixSect" class="btn btn">Mettre à jour</button>
										<button type="" id="del_choixSect" class="btn btn-warning">Supprimer</button>
									</div>
								  </fieldset>
							</form>';
							
	}
		echo $lignes ;
?>
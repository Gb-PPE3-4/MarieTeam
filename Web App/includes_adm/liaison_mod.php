<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;

	/******* RECUPERATION DES VALEURS & INIT  *******/
	
		/**** FORM UPDATE liaison ****/
		if(isset($_POST['select_Choix']) && $_POST['select_Choix'] != ""){
			
			$ID = $_POST['select_Choix'] ;
			$stmtliaison = retourneStatementSelect('SELECT code, idsecteur, idportdepart, idportarrivee, distance FROM liaison WHERE code='.$ID) ;
			while( $resultatliaison = $stmtliaison->fetch(PDO::FETCH_ASSOC) ){
				$NOM = returnNomLiaison($resultatliaison['idportdepart'], $resultatliaison['idportarrivee']) ;
				$IDSect = $resultatliaison['idsecteur'] ;
				$IDPDep = $resultatliaison['idportdepart'] ;
				$IDPArr = $resultatliaison['idportarrivee'] ;
				$Dist = $resultatliaison['distance'] ;
			}	
			
			$lignes = ' 			<form method="post" id="update_liaison_form" class="form-horizontal col-lg-4">
										  <legend>Modifier une liaison</legend>
									  <fieldset>
										<div class="form-group">
										  <label for="input_code" control-label">Code de la liaison</label>
										  <div>
											<input type="hidden" class="form-control" table = "liaison" champs_id ="code" name = "input_id" id="input_id" value="'.$ID.'">
										  </div>
										  <div>
											<input disabled="true" type="text" class="form-control" name = "input_code" id="input_code" value="'.$ID.'">
										  </div>
										</div>
										<div class="form-group">
										  <div>
											<label for="select_secteur" control-label">Secteur</label>
											<select class="form-control" name="select_secteur" id="select_secteur">' ;
			
			$stmt = retourneStatementSelect('SELECT idsecteur, nom FROM secteur') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				if($resultat['idsecteur'] == $IDSect){$selectedSect = 'selected="selected"' ;}else{ $selectedSect = "" ;}
				$lignes .= '	<option '.$selectedSect.' value="'.$resultat['idsecteur'].'">'.$resultat['nom'].'</option>';
			}
			$lignes .= '
											</select>
										  </div>
										</div>
										<div class="form-group">
										  <div>
											<label for="select_depart" control-label">Port de départ</label>
											<select class="form-control" name="select_depart" id="select_depart">' ;
			
			$stmt = retourneStatementSelect('SELECT idport, nom FROM port') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				if($resultat['idport'] == $IDPDep){$selectedPDep = 'selected="selected"' ;}else{ $selectedPDep = "" ;}
				$lignes .= '	<option '.$selectedPDep.' value="'.$resultat['idport'].'">'.$resultat['nom'].'</option>';
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
				if($resultat['idport'] == $IDPArr){$selectedPArr = 'selected="selected"' ;}else{ $selectedPArr = "" ;}
				$lignes .= '	<option '.$selectedPArr.' value="'.$resultat['idport'].'">'.$resultat['nom'].'</option>';
			}
			$lignes .= '
											</select>
										  </div>
										</div>
										<div class="form-group">
										  <label for="input_dist" control-label">Distance en km</label>
										  <div>
											<input type="text" class="form-control" name = "input_dist" id="input_dist" value="'.$Dist.'">
										  </div>
										</div>
										<div>
											<button class="btn btn-blueish">Valider</button>
											<a id="del_choix" class="btn btn-reddish">Supprimer</a>
										</div>
									  </fieldset><br>
									  <span id="updt_liaison_msg"></span>
									  <span id="del_msg"></span>
								</form>';
			echo $lignes ;
							
		}else{
			/**** FORM SELECT ID ******/
			$lignesFormChoix = '<form method="post" class="form-horizontal">
									<legend>Choisissez un liaison à modifier</legend>
									<fieldset class="col-lg-4">
									<div class="form-group">
										<select class="form-control" name="select_Choix" id="select_Choix">' ;
										
			$stmt = retourneStatementSelect('SELECT code, idsecteur, idportdepart, idportarrivee, distance FROM liaison') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignesFormChoix .= '			<option value="'.$resultat['code'].'">'.$resultat['code'].' - '.returnNomLiaison($resultat['idportdepart'], $resultat['idportarrivee']).'</option>';
			}			
			$lignesFormChoix .= '		</select>
									</div>
									<div>
										<button type="submit" class="btn btn-blueish">Modifier cet élément</button>
									</div>
								</form>' ;
			echo $lignesFormChoix ;
		}
?>
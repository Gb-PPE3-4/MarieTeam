<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;

	/******* RECUPERATION DES VALEURS & INIT  *******/
	
		/**** FORM UPDATE traversee ****/
		if(isset($_POST['select_Choix']) && $_POST['select_Choix'] != ""){
			
			$ID = $_POST['select_Choix'] ;
			$stmttraversee = retourneStatementSelect('SELECT num, dateTraversee, heure, idliaison, idbateau FROM traversee WHERE num='.$ID) ;
			while( $resultattraversee = $stmttraversee->fetch(PDO::FETCH_ASSOC) ){
				$dateTraversee = $resultattraversee['dateTraversee'] ;
				$heure = $resultattraversee['heure'] ;
				$idliaison = $resultattraversee['idliaison'] ;
				$idbateau = $resultattraversee['idbateau'] ;
			}	
			
			$lignes = ' 			<form method="post" id="update_traversee_form" class="form-horizontal col-lg-4">
									  <legend>Modifier une traversée</legend>
								  <fieldset>
											<div class="form-group">
											  <div>
												<input type="hidden" class="form-control" table = "traversee" champs_id ="num" name = "input_id" id="input_id" value="'.$ID.'">
											  </div>
											</div>
									<div class="form-group">
									  <label for="input_date" control-label">Date de la traversée</label>
									  <div>
										<input type="text" class="form-control" name = "input_date" id="input_date" value="'.setDateFormatLecture($dateTraversee).'">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_heure" control-label">Heure de la traversée</label>
									  <div>
										<input type="text" class="form-control" name = "input_heure" id="input_heure" placeholder="9:30" value="'.$heure.'">
									  </div>
									</div>
									<div class="form-group">
									  <div>
									    <label for="select_liaison" control-label">Liaison effectuée</label>
										<select class="form-control" name="select_liaison" id="select_liaison">' ;
		
		$stmt = retourneStatementSelect('SELECT code, idportdepart, idportarrivee FROM liaison') ;
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
			if($resultat['code'] == $idliaison){$selectedLiaison = 'selected="selected"' ;}else{ $selectedLiaison = "" ;}
			$lignes .= '	<option '.$selectedLiaison.' value="'.$resultat['code'].'">'.returnNomLiaison($resultat['idportdepart'], $resultat['idportarrivee']).'</option>';
		}
		$lignes .= '
										</select>
									  </div>
									</div>
									<div class="form-group">
									  <div>
									    <label for="select_bateau" control-label">Bateau utilisé</label>
										<select class="form-control" name="select_bateau" id="select_bateau">' ;
		
		$stmt = retourneStatementSelect('SELECT idbateau, nom FROM bateau') ;
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
			if($resultat['idbateau'] == $idbateau){$selectedBateau = 'selected="selected"' ;}else{ $selectedBateau = "" ;}
			$lignes .= '	<option '.$selectedBateau.' value="'.$resultat['idbateau'].'">'.$resultat['nom'].'</option>';
		}
		$lignes .= '
										</select>
									  </div>
									</div>
									<div>
											<button type="" id="upd_choixTraversee" class="btn btn-blueish">Mettre à jour</button>
											<a id="del_choix" class="btn btn-reddish">Supprimer</a>
									</div>
								  </fieldset><br>
									<span id="crea_traversee_msg"></span>
									<span id="del_msg"></span>
							</form>';
			echo $lignes ;
		}else{
			/**** FORM SELECT ID ******/
			$lignesFormChoix = '<form method="post" class="form-horizontal">
									<legend>Choisissez une traversee à modifier</legend>
									<fieldset class="col-lg-4">
									<div class="form-group">
										<select class="form-control" name="select_Choix" id="select_Choix">' ;
										
			$stmt = retourneStatementSelect('SELECT num FROM traversee ORDER BY num') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignesFormChoix .= '			<option value="'.$resultat['num'].'">'.$resultat['num'].'</option>';
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
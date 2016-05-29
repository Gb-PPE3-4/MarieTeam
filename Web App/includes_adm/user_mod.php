<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;

	/******* RECUPERATION DES VALEURS & INIT  *******/
	
		/**** FORM UPDATE membre ****/
		if(isset($_POST['select_Choix']) && $_POST['select_Choix'] != ""){
			
			$ID = $_POST['select_Choix'] ;
			$stmtmembre = retourneStatementSelect('SELECT id, login, nom, prenom, mail, droit, dateInsc FROM membre WHERE id='.$ID) ;
			while( $resultatmembre = $stmtmembre->fetch(PDO::FETCH_ASSOC) ){
				$login = $resultatmembre['login'] ;
				$nom = $resultatmembre['nom'] ;
				$prenom = $resultatmembre['prenom'] ;
				$mail = $resultatmembre['mail'] ;
				$droit = $resultatmembre['droit'] ;
				$dateInsc = $resultatmembre['dateInsc'] ;
			}	
			
			$lignes = ' 			<form method="post" id="update_membre_form" class="form-horizontal">
										  <legend>Membre à modifier inscrit le : '.setTimestampFormatLecture($dateInsc).'</legend>
									  <fieldset class="col-lg-4">
											<div class="form-group">
											  <label for="input_login" control-label">Login du membre</label>
											  <div>
												<input type="hidden" class="form-control" table = "membre" champs_id ="id" name = "input_id" id="input_id" value="'.$ID.'">
											  </div>
											  <div>
												<input type="text" class="form-control" name = "input_login" id="input_login" value="'.$login.'">
											  </div>
											</div>
											<div class="form-group">
											  <label for="input_nom" control-label">Nom du membre</label>
											  <div>
												<input type="text" class="form-control" name = "input_nom" id="input_nom" value="'.$nom.'">
											  </div>
											</div>
											<div class="form-group">
											  <label for="input_prenom" control-label">Prénom du membre</label>
											  <div>
												<input type="text" class="form-control" name = "input_prenom" id="input_prenom" value="'.$prenom.'">
											  </div>
											</div>
											<div class="form-group">
											  <label for="input_mail" control-label">Mail du membre</label>
											  <div>
												<input type="text" class="form-control" name = "input_mail" id="input_mail" value="'.$mail.'">
											  </div>
											</div>
											<div class="form-group">
											  <label for="input_droit" control-label">Droits du membre (0 base ; 1 admin)</label>
											  <div>
												<input type="text" class="form-control" name = "input_droit" id="input_droit" value="'.$droit.'">
											  </div>
											</div>
										<div>
											<button type="" id="upd_choixMembre" class="btn btn-blueish">Mettre à jour</button>
											<a id="del_choix" class="btn btn-reddish">Supprimer</a>
										</div>
									  </fieldset><br>
									  <span id="updt_membre_msg"></span>
									  <span id="del_msg"></span>
								</form>';	
			echo $lignes ;
		}else{
			/**** FORM SELECT ID ******/
			$lignesFormChoix = '<form method="post" class="form-horizontal">
									<legend>Choisissez un membre à modifier</legend>
									<fieldset class="col-lg-4">
									<div class="form-group">
										<select class="form-control" name="select_Choix" id="select_Choix">' ;
										
			$stmt = retourneStatementSelect('SELECT id, login FROM membre') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignesFormChoix .= '			<option value="'.$resultat['id'].'">'.$resultat['login'].'</option>';
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
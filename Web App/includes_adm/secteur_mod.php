<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;

	/******* RECUPERATION DES VALEURS & INIT  *******/
	
		/**** FORM UPDATE SECTEUR ****/
		if(isset($_POST['select_Choix']) && $_POST['select_Choix'] != ""){
			
			$ID = $_POST['select_Choix'] ;
			$stmtSecteur = retourneStatementSelect('SELECT idsecteur, nom FROM secteur WHERE idsecteur='.$ID) ;
			while( $resultatSecteur = $stmtSecteur->fetch(PDO::FETCH_ASSOC) ){
				$NOM = $resultatSecteur['nom'] ;
			}	
			
			$lignes = ' 			<form method="post" id="update_secteur_form" class="form-horizontal">
										  <legend>Choisissez un secteur à modifier :</legend>
									  <fieldset class="col-lg-4">
										<div class="form-group">
										  <label for="input_nom" control-label">Nom du secteur</label>
										  <div>
											<input type="hidden" class="form-control" table = "secteur" champs_id ="idsecteur" name = "input_id" id="input_id" value="'.$ID.'">
										  </div>
										  <div>
											<input type="text" class="form-control" name = "input_nom" id="input_nom" value="'.$NOM.'">
										  </div>
										</div>
										<div>
											<button type="" id="upd_choixSect" class="btn btn-blueish">Mettre à jour</button>
											<a id="del_choix" class="btn btn-reddish">Supprimer</a>
										</div>
									  </fieldset><br>
									  <span id="updt_secteur_msg"></span>
								</form>';
								
			echo $lignes ;
		}else{
			/**** FORM SELECT ID ******/
			$lignesFormChoix = '<form method="post" class="form-horizontal">
									<legend>Choisissez un secteur à modifier</legend>
									<fieldset class="col-lg-4">
									<div class="form-group">
										<select class="form-control" name="select_Choix" id="select_Choix">' ;
										
			$stmt = retourneStatementSelect('SELECT idsecteur, nom FROM secteur') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignesFormChoix .= '			<option value="'.$resultat['idsecteur'].'">'.$resultat['nom'].'</option>';
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
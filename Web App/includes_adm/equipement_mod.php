<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;

	/******* RECUPERATION DES VALEURS & INIT  *******/
	
		/**** FORM UPDATE equipement ****/
		if(isset($_POST['select_Choix']) && $_POST['select_Choix'] != ""){
			
			$ID = $_POST['select_Choix'] ;
			$stmtequipement = retourneStatementSelect('SELECT idequip, libequip FROM equipement WHERE idequip='.$ID) ;
			while( $resultatequipement = $stmtequipement->fetch(PDO::FETCH_ASSOC) ){
				$libequip = $resultatequipement['libequip'] ;
			}	
			
			$lignes = ' 			<form method="post" id="update_equipement_form" class="form-horizontal">
										  <legend>Choisissez un equipement à modifier :</legend>
									  <fieldset class="col-lg-4">
										<div class="form-group">
										  <label for="input_libequip" control-label">Nom de l\'équipement</label>
										  <div>
											<input type="hidden" class="form-control" table = "equipement" champs_id ="idequip" name = "input_id" id="input_id" value="'.$ID.'">
										  </div>
										  <div>
											<input type="text" class="form-control" name = "input_libequip" id="input_libequip" value="'.$libequip.'">
										  </div>
										</div>
										<div>
											<button type="" id="upd_choixSect" class="btn btn-blueish">Mettre à jour</button>
											<a id="del_choix" class="btn btn-reddish">Supprimer</a>
										</div>
									  </fieldset><br>
									  <span id="updt_equipement_msg"></span>
									  <span id="del_msg"></span>
								</form>';
								
			echo $lignes ;
		}else{
			/**** FORM SELECT ID ******/
			$lignesFormChoix = '<form method="post" class="form-horizontal">
									<legend>Choisissez un equipement à modifier</legend>
									<fieldset class="col-lg-4">
									<div class="form-group">
										<select class="form-control" name="select_Choix" id="select_Choix">' ;
										
			$stmt = retourneStatementSelect('SELECT idequip, libequip FROM equipement') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignesFormChoix .= '			<option value="'.$resultat['idequip'].'">'.$resultat['libequip'].'</option>';
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
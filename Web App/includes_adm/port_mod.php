<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;

	/******* RECUPERATION DES VALEURS & INIT  *******/
	
		/**** FORM UPDATE port ****/
		if(isset($_POST['select_Choix']) && $_POST['select_Choix'] != ""){
			
			$ID = $_POST['select_Choix'] ;
			$stmtport = retourneStatementSelect('SELECT idport, nom FROM port WHERE idport='.$ID) ;
			while( $resultatport = $stmtport->fetch(PDO::FETCH_ASSOC) ){
				$NOM = $resultatport['nom'] ;
			}	
			
			$lignes = ' 			<form method="post" id="update_port_form" class="form-horizontal">
										  <legend>Choisissez un port à modifier :</legend>
									  <fieldset class="col-lg-4">
										<div class="form-group">
										  <label for="input_nom" control-label">Nom du port</label>
										  <div>
											<input type="hidden" class="form-control" table = "port" champs_id ="idport" name = "input_id" id="input_id" value="'.$ID.'">
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
									  <span id="updt_port_msg"></span>
									  <span id="del_msg"></span>
								</form>';
								
			echo $lignes ;
		}else{
			/**** FORM SELECT ID ******/
			$lignesFormChoix = '<form method="post" class="form-horizontal">
									<legend>Choisissez un port à modifier</legend>
									<fieldset class="col-lg-4">
									<div class="form-group">
										<select class="form-control" name="select_Choix" id="select_Choix">' ;
										
			$stmt = retourneStatementSelect('SELECT idport, nom FROM port') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignesFormChoix .= '			<option value="'.$resultat['idport'].'">'.$resultat['nom'].'</option>';
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
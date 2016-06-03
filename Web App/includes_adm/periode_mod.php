<?PHP
	$lignes = 'Désolé, le site vient de rencontrer une erreur.' ;

	/******* RECUPERATION DES VALEURS & INIT  *******/
	
		/**** FORM UPDATE periode ****/
		if(isset($_POST['select_Choix']) && $_POST['select_Choix'] != ""){
			
			$ID = $_POST['select_Choix'] ;
			$stmtperiode = retourneStatementSelect('SELECT datedeb, datefin FROM periode WHERE idperiode='.$ID) ;
			while( $resultatperiode = $stmtperiode->fetch(PDO::FETCH_ASSOC) ){
				$DDEB = $resultatperiode['datedeb'] ;
				$DFIN = $resultatperiode['datefin'] ;
			}	
			
		$lignes = ' 			<form method="post" id="update_periode_form" class="form-horizontal col-lg-4">
									  <legend>Ajoutez une période</legend>
								  <fieldset>
										  <div>
											<input type="hidden" class="form-control" table = "periode" champs_id ="idperiode" name = "input_id" id="input_id" value="'.$ID.'">
										  </div>
									<div class="form-group">
									  <label for="input_datedeb" control-label">Date de début de la période</label>
									  <div>
										<input type="text" placeholder="15/01/2016" class="form-control" name = "input_datedeb" id="input_datedeb" value="'.setDateFormatLecture($DDEB).'">
									  </div>
									</div>
									<div class="form-group">
									  <label for="input_datefin" control-label">Date de fin</label>
									  <div>
										<input type="text" placeholder="15/06/2016" class="form-control" name = "input_datefin" id="input_datefin" value="'.setDateFormatLecture($DFIN).'">
									  </div>
									</div>
									<div>
										<button class="btn btn-blueish">Mettre à jour</button>
										<a id="del_choix" class="btn btn-reddish">Supprimer</a>
									</div>
								  </fieldset><br>
								  <span id="updt_periode_msg"></span>
									  <span id="del_msg"></span>
							</form>';
								
			echo $lignes ;
		}else{
			/**** FORM SELECT ID ******/
			$lignesFormChoix = '<form method="post" class="form-horizontal">
									<legend>Choisissez un periode à modifier</legend>
									<fieldset class="col-lg-4">
									<div class="form-group">
										<select class="form-control" name="select_Choix" id="select_Choix">' ;
										
			$stmt = retourneStatementSelect('SELECT idperiode, datedeb, datefin FROM periode') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignesFormChoix .= '			<option value="'.$resultat['idperiode'].'">'.setDateFormatLecture($resultat['datedeb']).' - '.setDateFormatLecture($resultat['datefin']).'</option>';
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
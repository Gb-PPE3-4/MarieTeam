<?php
			
			if(isset($_POST['select_Action'])){ 
				$WHERE = 'WHERE action="'.$_POST['select_Action'].'"' ; 
				$ACTION = $_POST['select_Action'] ;
			}else{ 
				$WHERE = "" ;
				$ACTION = "*" ;
			}
			
			/**** choix du type d'action ****/
			$lignesFormChoix = ' 			<form method="post" id="choixAction_form">
										  <legend>Action : '.$ACTION.'</legend>
										  <div class="col-lg-4"></div>
										  <fieldset class="col-lg-4">
											<div class="form-group">
											<select class="form-control" name="select_Action" id="select_Action">' ;
										
			$stmtAction = retourneStatementSelect('SELECT distinct(action) as type_action FROM modifications') ;
			while( $resultatAction = $stmtAction->fetch(PDO::FETCH_ASSOC) ){
				if($resultatAction['type_action'] == $ACTION){$selected = 'selected="selected"' ;}else{$selected = "" ;}
				$lignesFormChoix .= '			<option '.$selected.' value="'.$resultatAction['type_action'].'">'.$resultatAction['type_action'].'</option>';
			}	
				
				$lignesFormChoix .= '		</select>
											</div>
											<div>
												<button type="submit" id="choixAction" class="btn btn-blueish" style="margin-bottom:30px;">Valider</button>
											</div>
										  </fieldset>
										  <div class="col-lg-4"></div>
									</form>';
								
			$lignes = $lignesFormChoix ;
			
			/****** affichage des modifications *****/
			$stmt = retourneStatementSelect('SELECT idmodif, iduser, nom_prenom, table_modifiee, action, donnees, date_modif FROM modifications '.$WHERE.' ORDER BY idmodif DESC') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignes .= '<div class="bloc_reservation" style="clear:both">' ;
				
				$lignes .= '<br><span><b>'.$resultat['nom_prenom'].'</b>, modification du <b>'.setTimestampFormatLecture($resultat['date_modif']).'</b></span>' ;
				$lignes .= '<br>sur la table "'.$resultat['table_modifiee'].'" a été opérée une action de <b>'.$resultat['action'].'</b> avec les données suivantes :<br><br>' ;
				// .$resultat['donnees'].'<br>' ;
				foreach(json_decode($resultat['donnees']) as $key => $value){
					if($key != "CHAMPS_ID"){
						$lignes .= '['.$key.']'.' => '.$value.'<br>' ;
					}
				}
				$lignes .= '<br></div>' ;
			}
			echo $lignes ;
?>
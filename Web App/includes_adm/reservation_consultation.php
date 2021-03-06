<?php
			
			if(isset($_POST['select_Trav'])){ $WHERE = 'WHERE idtraversee='.$_POST['select_Trav'] ; }else{ $_POST['select_Trav'] = "*" ; $WHERE = "" ;} ;
			
			/**** choix de la traversée ****/
			$lignesFormChoix = ' 			<form method="post" id="choixTrav_form">
										  <legend>Traversée n° '.$_POST['select_Trav'].' :</legend>
										  <div class="col-lg-4"></div>
										  <fieldset class="col-lg-4">
											<div class="form-group">
											<select class="form-control" name="select_Trav" id="select_Trav">' ;
										
			$stmtReserv = retourneStatementSelect('SELECT distinct(idtraversee) as id FROM reservation') ;
			while( $resultatReserv = $stmtReserv->fetch(PDO::FETCH_ASSOC) ){
			
				$stmt = retourneStatementSelect('SELECT num FROM traversee WHERE num ='.$resultatReserv['id']) ;
				while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
					$lignesFormChoix .= '			<option value="'.$resultat['num'].'">'.$resultat['num'].'</option>';
				}		
				
			}	
				
				$lignesFormChoix .= '		</select>
											</div>
											<div>
												<button type="submit" id="choixTrav" class="btn btn-blueish" style="margin-bottom:30px;">Valider traversée</button>
											</div>
										  </fieldset>
										  <div class="col-lg-4"></div>
									</form>';
								
			$lignes = $lignesFormChoix ;
			
			/****** affichage des reservations *****/
			$stmt = retourneStatementSelect('SELECT idreservation, nom, adresse, cp, ville, idtraversee, dateEnregistrement FROM reservation '.$WHERE.' ORDER BY dateEnregistrement DESC') ;
			while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$lignes .= '<div class="bloc_reservation" style="clear:both">' ;
				
				$lignes .= '<br><br><span><b>'.$resultat['nom'].'</b>, réservation du <b>'.setTimestampFormatLecture($resultat['dateEnregistrement']).'</b></span>' ;
				$lignes .= '<br>'.$resultat['adresse'].' '.$resultat['cp'].' '.$resultat['ville'].'<br>' ;
				
				$stmtTraversee = retourneStatementSelect('Select dateTraversee, heure, idliaison, idbateau From traversee WHERE num ='.$resultat['idtraversee']) ;
				while( $resultatTraversee = $stmtTraversee->fetch(PDO::FETCH_ASSOC)){
					$lignes .= 'Réservation pour le '.setDateFormatLecture($resultatTraversee['dateTraversee']).' à '.$resultatTraversee['heure'] ;
					
					$stmtLiaison = retourneStatementSelect('Select code, idsecteur, idportdepart, idportarrivee, distance From liaison WHERE code ='.$resultatTraversee['idliaison']) ;
					while( $resultatLiaison = $stmtLiaison->fetch(PDO::FETCH_ASSOC)){
						$lignes .= ' pour la liaison '.returnNomLiaison($resultatLiaison['idportdepart'],$resultatLiaison['idportarrivee']) ;
					}
				}
				
				$lignes .= '<br><table class="table table-striped><thead colspan="8"><b>Places</b></thead><tbody>' ;
				$lignes .= '<tr>' ;
				$stmtTickettes = retourneStatementSelect('Select lettre, num, quantite From enregistrer WHERE idreservation ='.$resultat['idreservation']) ;
				while( $resultatTickettes = $stmtTickettes->fetch(PDO::FETCH_ASSOC)){
					$lignes .= '<th>'.$resultatTickettes['lettre'].$resultatTickettes['num'].'</th>' ;
				}
				$lignes .= '</tr><tr>' ;
				$stmtTickettes = retourneStatementSelect('Select lettre, num, quantite From enregistrer WHERE idreservation ='.$resultat['idreservation']) ;
				while( $resultatTickettes = $stmtTickettes->fetch(PDO::FETCH_ASSOC)){
					if($resultatTickettes['quantite'] == 0){
						$lignes .= '<td>-</td>' ;
					}else{
						$lignes .= '<td>'.$resultatTickettes['quantite'].'</td>' ;
					}
					
				}
				$lignes .= '</tr>' ;
				$lignes .= '</tbody></table>' ;
				
				
				
				
				
				$lignes .= '</div>' ;
			}
			echo $lignes ;
?>
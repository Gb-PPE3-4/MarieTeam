<?php
		$lignes = "" ;
	
		$stmt = retourneStatementSelect('SELECT idreservation, nom, adresse, cp, ville, idtraversee, dateEnregistrement FROM reservation ORDER BY dateEnregistrement DESC') ;
		while( $resultat = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$lignes .= '<div class="bloc_reservation">' ;
			
			$lignes .= '<br><br><span><b>'.$resultat['nom'].'</b>, réservation du <b>'.$resultat['dateEnregistrement'].'</b></span>' ;
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
<?PHP
	include 'includes/head.php' ; ; 	
	include 'includes/header.php' ; 
?>
	<div id = "wrapper_main">
		<?PHP
			$idLiaison = '' ;
			$prix = '' ;
			if(isset($_GET['idliaison']) && $_GET['idliaison'] != ''){
				$idLiaison = $_GET['idliaison'] ;
			}else if(!isset($idLiaison) || $idLiaison == ""){
				$idLiaison=15 ;
			}
			echo '
			<form  style="text-align:left;" class="form-horizontal">
				  <fieldset id="choixLiaison">
					<h4>Sélectionner la liaison et la date souhaitée :</h4>
					  <div class="col-lg-4 noMargin">
							<select class="form-control" id="slct_idLiaison" style="width:100%;">' ;
			echo 				afficheLiaisonSelect($_GET['secteur'])
							.'</select>
						</div>';
			
			// Selection des prix a afficher en liste
			$nbPeriodes = PDO_num_rows('SELECT * FROM periode') ;
			$periodes = array() ;
			$catypes = array() ;
			
				$lignes =  	'<div id="separateur"><div id="separateur">
							<div class="col-lg-12">
								<form class="form-horizontal">
									<fieldset>
										<div class="form-group">
											<h4>Tarifs de la liaison numéro '.$idLiaison.' :</h4>
											<table class="table table-striped table-bordered">
												<tr>
													<th colspan="6">Liaison Ports départ-arrivée</th>
												</tr>
												<tr>
													<th rowspan="2">Catégorie</th>
													<th rowspan="2">Type</th>
													<th colspan="'.$nbPeriodes.'">Période</th>
												</tr>
												<tr>';
				// RECUP CATYPE 'A1' 'A3' etc + libelle type		
				$stmtCatype = retourneStatementSelect('SELECT CONCAT(lettre, num) as catype, libelle FROM type') ;				
				while( $resultatCatype = $stmtCatype->fetch(PDO::FETCH_ASSOC) ){
					$catypes['ID'][] =  $resultatCatype['catype'] ;
					$catypes[$resultatCatype["catype"]] =  $resultatCatype['libelle'] ;
				}
				$stmtCatype = null;
				
				// RECUP LES ID PERIODE
				$stmtPeriode = retourneStatementSelect('SELECT * FROM periode') ;				
				while( $resultatPeriode = $stmtPeriode->fetch(PDO::FETCH_ASSOC) ){
					$lignes .= '<td>'.setDateFormatLecture($resultatPeriode['datedeb']).' au '.setDateFormatLecture($resultatPeriode['datefin']).'</td>' ;
					$periodes[] =  $resultatPeriode['idperiode'] ;
				}
				$stmtPeriode = null;
				
				$lignes .= '					</tr>';
													// <td rowspan="3">A <span class="pc">- Passager</span></td>
													// <td>1 <span class="pc">- Adulte</span></td>
				foreach($catypes['ID'] as $CATYP){
					
					$lignes .= '<tr>' ;
					switch ($CATYP){
						case 'A1' :
							$lignes .= '<td rowspan="3">A <span class="pc">- Passager</span></td>
										<td>1 <span class="pc">- '.$catypes[$CATYP].'</span></td>' ;
							break ;
						case 'A2' :
							$lignes .= '<td>2 <span class="pc">- '.$catypes[$CATYP].'</span></td>' ;
							break ;
						case 'A3' :
							$lignes .= '<td>3 <span class="pc">- '.$catypes[$CATYP].'</span></td>' ;
							break ;
						case 'B1' :
							$lignes .= '<td rowspan="2">B <span class="pc">- Véhicule inférieur à 2m</span></td>
										<td>1 <span class="pc">- '.$catypes[$CATYP].'</span></td>' ;
							break ;
						case 'B2' :
							$lignes .= '<td>2 <span class="pc">- '.$catypes[$CATYP].'</span></td>' ;
							break ;
						case 'C1' :
							$lignes .= '<td rowspan="3">C <span class="pc">- Véhicule supérieur à 2m</span></td>
										<td>1 <span class="pc">- '.$catypes[$CATYP].'</span></td>' ;
							break ;
						case 'C2' :
							$lignes .= '<td>2 <span class="pc">- '.$catypes[$CATYP].'</span></td>' ;
							break ;
						case 'C3' :
							$lignes .= '<td>3 <span class="pc">- '.$catypes[$CATYP].'</span></td>' ;
							break ;
					}
					foreach($periodes as $ID){
						$lignes .= '<td>'.prixTarif($idLiaison, $CATYP, $ID).' €</td>' ;
					}
					$lignes .= '</tr>' ;
				}
				$lignes .= '					</tr>
											</table>
											</div>
										</div>
									</fieldset>
								</form>
							</div></div>
						</div>';
				echo $lignes ;
				
			include 'includes/popup_connexion.php' ;
       					  ?>
		<!-- /#wrapper main -->
		<div id="separateur"></div>
<?PHP
	include 'includes/footer.php' ;
?>
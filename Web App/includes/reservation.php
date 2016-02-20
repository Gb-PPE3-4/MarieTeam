<?PHP
	if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
	{
		$_REQUEST['fonction']($_REQUEST);
	}
	
	function prix($idliaison, $date){
		$prix = '' ;
		
		if(isset($_GET['idliaison']) && $_GET['idliaison'] != ''){
			// pré-sélectionne si get avec valeur
			$idliaison = $_GET['idliaison'] ;
		}else{$idliaison = 15 ;}
		
		// Seléction des prix à afficher en liste
		$dsn = 'mysql:host=localhost;dbname=marieteam_bd';
			$username = 'root';
			$password = '';
			$options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
		$connexion = new PDO($dsn, $username, $password, $options);
		$resultats=$connexion->query("SELECT idliaison, T.idperiode, lettre, num, tarif FROM `tarifer` AS T, `periode` AS P WHERE idliaison=".$idliaison." AND T.idperiode=P.idperiode AND (P.datedeb < '".$date."' OR P.datedeb = '".$date."')AND (P.datefin > '".$date."'  OR P.datedeb = '".$date."')");
		$resultats->setFetchMode(PDO::FETCH_OBJ);
		while( $resultat = $resultats->fetch() )
		{
				$prix[$resultat->lettre.$resultat->num] = $resultat->tarif ;
		}
		$resultats->closeCursor();
		$connexion = null ;
		return $prix ;
	}
	
	function retourneTabReservation($data){
		$idliaison = $data['params']['idliaison'] ;
		$date = $data['params']['date'] ;
		$prix = '' ;
		$prix = prix($idliaison,$date)  ;
		
		if(isset($prix['A1']) && $prix['A1']!= '' && $prix['A1'] != null){
			$lignes = '
								<div id="tabReservation" class="col-lg-12 col-md-2">
									<form id="tabForm" class="form-horizontal">
										<fieldset id="">
											<div class="form-group">
												<h3>Sélectionner les options de votre réservation :</h3>
												<div class="col-lg-1"><label for="nomR" class="control-label">Nom</label></div>
												<div class="col-lg-2">
													<input id="nomR" name="nomR" placeholder="Votre nom" type="text" class="form-control" required>
												</div>
												<div class="col-lg-1"><label for="adresseR" class="control-label">Adresse</label></div>
												<div class="col-lg-2">
													<input id="adresseR" name="adresseR" placeholder="Votre adresse" type="text" class="form-control" required>
												</div>
												<div class="col-lg-1"><label for="cpR" class="control-label">Code Postal</label></div>
												<div class="col-lg-2">
													<input id="cpR" name="cpR" placeholder="Code Postal" type="number" class="form-control" min="10000" step="1" required>
												</div>
												<div class="col-lg-1"><label for="villeR" class="control-label">Ville</label></div>
												<div class="col-lg-2">
													<input id="villeR" name="villeR" placeholder="Votre ville" type="text" class="form-control" required>
												</div>
											</div>
											
											<div class="form-group">
												<table id="tabTableReserv" class="table table-striped table-bordered table-hover table-condensed"> 
													<tr>
														<th>Liaison</th>
														<th>Période</th>
														<th>Type</th>
														<th>Quantité</th>
														<th><span class="pc">Prix </span>€</th>
														<th id="">310 Places</th>
													</tr>
													<tr>
														<td id="idliaison" rowspan="10">'.$idliaison.'</td>
														<td id="date" rowspan="10">'.$date.'</td>
													</tr>
													<tr>
														<td>A1 <span class="pc">- Adulte</span></td>
														<td>
																<input id="A1qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixA1" class="prix">'.$prix['A1'].'</td>
													</tr>
													<tr>
														<td>A2 <span class="pc">- Junior 8 à  18 ans</span></td>
														<td>
																<input id="A2qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixA2" class="prix">'.$prix['A2'].'</td>
													</tr>
													<tr>
														<td>A3 <span class="pc">- Enfant 0 à 7 ans</span></td>
														<td>
																<input id="A3qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixA3" class="prix">'.$prix['A3'].'</td>
													</tr>
													<tr>
														<td>B1 <span class="pc">- Voiture à longueur inférieure à 4m</span></td>
														<td>
																<input id="B1qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixB1" class="prix">'.$prix['B1'].'</td>
													</tr>
													<tr>
														<td>B2 <span class="pc">- Voiture à longueur inférieure à 5m</span></td>
														<td>
																<input id="B2qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixB2" class="prix">'.$prix['B2'].'</td>
													</tr>
													<tr>
														<td>C1 <span class="pc">- Fourgon</span></td>
														<td>
																<input id="C1qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixC1" class="prix">'.$prix['C1'].'</td>
													</tr>
													<tr>
														<td>C2 <span class="pc">- Camping Car</span></td>
														<td>
																<input id="C2qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixC2" class="prix">'.$prix['C2'].'</td>
													</tr>
													<tr>
														<td>C3 <span class="pc">- Camion</span></td>
														<td>
																<input id="C3qte" name="" value="0" type="number" class="form-control qte" min="0" step="1">
														</td>
														<td id="prixC3" class="prix">'.$prix['C3'].'</td>
													</tr>
												</table>
												</div>
												<div class="col-lg-2"><h3></h3></div>
												<div class="col-lg-1"><label for="totalPrix" class="control-label">Total HT €</label></div>
												<div class="col-lg-2">
													<input disabled id="totalPrix" id_traversee="0" name="" value="0" type="number" class="form-control">
												</div>
												<div class="col-lg-3"><a id="valider" style="width:100%;" class="btn btn-success">Valider la réservation</a></div>
												<div class="col-lg-3"><a id="retourReserv" style="width:100%;" class="btn btn-warning">Retour</a></div>
											</div>
										</fieldset>
									</form>
								</div>';
		}else{$lignes = '<div class="col-lg-6"><a id="retourReserv" style="width:100%;" class="btn btn-warning">Retour</a></div><div class="col-lg-6">Pas de tarification à jour. </div>' ;}
		echo $lignes ;
	}
	
?>	
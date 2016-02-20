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
			$prix = recupPrix($idLiaison,'yes');
			
			if(isset($prix['1-A1']) && $prix['1-A1'] != null  && $prix['1-A1'] != ''){
				echo  	'<div id="separateur"><div id="separateur">
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
													<th colspan="3">Période</th>
												</tr>
												<tr>
													<td>01/09/2014 au 15/06/2015</td>
													<td>16/06/2015 au 15/09/2015</td>
													<td>16/09/2015 au 31/05/2016</td>
												</tr>
												<tr>
													<td rowspan="3">A <span class="pc">- Passager</span></td>
													<td>1 <span class="pc">- Adulte</span></td>
													<td id="prixA1">'.$prix['1-A1'].' €</td>
													<td id="prixA1">'.$prix['2-A1'].' €</td>
													<td id="prixA1">'.$prix['3-A1'].' €</td>
												</tr>
												<tr>
													<td>2 <span class="pc">- Junior 8 à  18 ans</span></td>
													<td id="prixA2">'.$prix['1-A2'].' €</td>
													<td id="prixA2">'.$prix['2-A2'].' €</td>
													<td id="prixA2">'.$prix['3-A2'].' €</td>
												</tr>
												<tr>
													<td>3 <span class="pc">- Enfant 0 à 7 ans</span></td>
													<td id="prixA3">'.$prix['1-A3'].' €</td>
													<td id="prixA3">'.$prix['2-A3'].' €</td>
													<td id="prixA3">'.$prix['3-A3'].' €</td>
												</tr>
												<tr>
													<td rowspan="2">B <span class="pc">- Véhicule inférieur à 2m</span></td>
													<td>1 <span class="pc">- Voiture à longueur inférieure à 4m</span></td>
													<td id="prixB1">'.$prix['1-B1'].' €</td>
													<td id="prixB1">'.$prix['2-B1'].' €</td>
													<td id="prixB1">'.$prix['3-B1'].' €</td>
												</tr>
												<tr>
													<td>2 <span class="pc">- Voiture à longueur inférieure à 5m</span></td>
													<td id="prixB2">'.$prix['1-B2'].' €</td>
													<td id="prixB2">'.$prix['2-B2'].' €</td>
													<td id="prixB2">'.$prix['3-B2'].' €</td>
												</tr>
												<tr>
													<td rowspan="3">C <span class="pc">- Véhicule supérieur à 2m</span></td>
													<td>1 <span class="pc">- Fourgon</span></td>
													<td id="prixC1">'.$prix['1-C1'].' €</td>
													<td id="prixC1">'.$prix['2-C1'].' €</td>
													<td id="prixC1">'.$prix['3-C1'].' €</td>
												</tr>
												<tr>
													<td>2 <span class="pc">- Camping Car</span></td>
													<td id="prixC2">'.$prix['1-C2'].' €</td>
													<td id="prixC2">'.$prix['2-C2'].' €</td>
													<td id="prixC2">'.$prix['3-C2'].' €</td>
												</tr>
												<tr>
													<td>3 <span class="pc">- Camion</span></td>
													<td id="prixC3">'.$prix['1-C3'].' €</td>
													<td id="prixC3">'.$prix['2-C3'].' €</td>
													<td id="prixC3">'.$prix['3-C3'].' €</td>
												</tr>
											</table>
											</div>
										</div>
									</fieldset>
								</form>
							</div></div>
						</div>';
			}else{echo '<br>Tarifs non disponibles pour cette liaison !' ;}
			include 'includes/popup_connexion.php' ;
       					  ?>
		<!-- /#wrapper main -->
		<div id="separateur"></div>
<?PHP
	include 'includes/footer.php' ;
?>
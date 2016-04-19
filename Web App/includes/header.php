<body>
<div id="wrapper">
	 <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
					<a href="#" id = "close_secteur_panel"class="menu-toggle" >
						<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
					</a>
                    Choisissez un secteur
                </li>
                <?PHP afficheSecteurs() ; ?>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
	<header>
		<img id = "banniere" alt = "Banniere MarieTeam" src = "images/gouvernail.ico">
		<h1>MarieTeam</h1>
	</header>
	<main>
		<nav class="navbar navbar-default" style = "border-radius:0;">
			<div class="container-fluid"  style = "margin : 0 3% ;">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand contains_logo" href="index.php">MarieTeam</a></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<?PHP 
					if(isset($_SESSION['ID'])  && $_SESSION['droit'] != "" && $_SESSION['droit'] != null){
						echo '	<ul class="nav navbar-nav">
									<li class="dropdown">
										<a href="#" tabindex="0" data-toggle="dropdown" data-submenu="">
											Modifier les données <span class="caret"></span>
										</a>
										<ul class="dropdown-menu">
											<li class="dropdown-submenu">
												<a href="#" tabindex="0">Ajouter</a>
												<ul class="dropdown-menu">
													<li><a href="admin.php?data=secteur_ajout" tabindex="0">Secteurs</a></li>
													<li><a href="admin.php?data=port_ajout" tabindex="0">Ports</a></li>
													<li><a href="admin.php?data=liaison_ajout" tabindex="0">Liaisons</a></li>
													<li><a href="admin.php?data=periode_ajout" tabindex="0">Périodes</a></li>
													<li><a href="admin.php?data=bateau_ajout" tabindex="0">Bateaux</a></li>
													<li><a href="admin.php?data=traversee_ajout" tabindex="0">Traversées</a></li>
													<li><a href="admin.php?data=tarif_ajout" tabindex="0">Tarifs</a></li>
													<li class="divider"></li>
												</ul>
											</li>
											<li class="dropdown-submenu">
												<a href="#" tabindex="0">Modifier</a>
												<ul class="dropdown-menu">
													<li><a href="admin.php?data=secteur_mod" tabindex="0">Secteurs</a></li>
													<li><a href="admin.php?data=port_mod" tabindex="0">Ports</a></li>
													<li><a href="admin.php?data=liaison_mod" tabindex="0">Liaisons</a></li>
													<li><a href="admin.php?data=periode_mod" tabindex="0">Périodes</a></li>
													<li><a href="admin.php?data=bateau_mod" tabindex="0">Bateaux</a></li>
													<li><a href="admin.php?data=traversee_mod" tabindex="0">Traversées</a></li>
													<li><a href="admin.php?data=tarif_mod" tabindex="0">Tarifs</a></li>
												</ul>
											</li>
											<li class="divider"></li>
										</ul>
									</li>
									<li><a href="admin.php?data=reservation_consultation">Réservations</a></li>
									<li><a href="admin.php?data=mdp">Changer de mot de passe</a></li>	';
						if($_SESSION['droit'] == 1){			
							echo'	<li><a href="admin.php?data=modif_consultation">Consulter les modifications</a></li>
									<li><a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										Administrer les utilisateurs <span class="caret"></span>
									</a>
										<ul class="dropdown-menu">
											<li><a href="admin.php?data=user_ajout">Ajouter un utilisateur</a></li>
											<li><a href="admin.php?data=user_mod">Modifier un utilisateur</a></li>
											<li role="separator" class="divider"></li>
										</ul>
									</li>';
						}
						echo '	</ul>
								<ul class="nav navbar-nav navbar-right">
									<li>
										<a href="includes/login_deconnexion.php" class="btn btn-success">
											Déconnexion
										</a>
									</li>
								</ul>' ;
					}else{
						echo '	<ul class="nav navbar-nav">
									<li><a href="#menu-toggle" class = "menu-toggle">Tarifs & Réservation</a></li>
									<li><a href="engangements.php">Nos engagements</a></li>
									<li><a href="services.php">FAQ</a></li>
									<li><a href="contact.php">Contact</a></li>
								</ul>
								<ul class="nav navbar-nav navbar-right">
									<li><a href="#" data-toggle="modal" data-target="#modal_connexion">Connexion</a></li>
								</ul>' ;
					}
				?>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
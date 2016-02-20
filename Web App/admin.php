<?PHP
	include 'includes/head.php' ; 
	include 'includes/header.php' ; 
?>
		<div id = "wrapper_main">
			<!--
			<div class="col-lg-12"><h2>MarieTeam vous transport en toute sécurité à destination, vous ou vos marchandises.</h2></div>
			<div class="col-lg-12"><h3 style="font-style:italic;">"Le transport avec MarieTeam c'est un voyage à part entière."</h3></div>
			<br style="clear:both;">
			<div class="col-lg-6">
				<p style="text-align:left; padding:10px;">Les îles du litttoral français desservies sont Belle-Île-en-mer, Houat, Ile de Groix, Ouessant, Molène, Sein, Bréhat, Batz, Aix et Yeu.</p>
			</div>
			<div class="col-lg-6">
				<img style="width:100%; border-radius:25px;" alt="Voyager avec MarieTeam" src="images/voyage.png">
			</div>-->
			
			
			<?PHP
				if(isset($_GET['data']) && $_GET['data'] != ''){
					include 'includes_adm/'.$_GET['data'].'.php' ;
				}
			?>
			
		</div>
		<!-- /#wrapper main -->
		<div id="separateur"></div>
<?PHP
	include 'includes/footer.php' ;
?>
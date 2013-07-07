<?php 
$t = new equipes();
$team = $t->getRecord($_GET['idteam']);
//echo "<pre>"; var_dump($joueur);
?>
		<div class="pageheader">
            <h1 class="pagetitle">Delete this team</h1>
            <span class="pagedesc">Click "OK" to delete the team</span>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	<div id="validation" class="subcontent">
				<form id="form1" class="stdform" method="post" action="controller/deleteteam.php?idteam=<?php echo $_GET['idteam']; ?>">
					<p style="clear: right; float : left; margin : 0">
						<span style="font-weight:bold;float:left; width:450px; margin : 3px 5px 3px 50px; padding : 2px 5px">Do you want to delete the team <?php echo $team->nom_equipe; ?> and all its games and<br />
						players<br /><br /><br />
						Click "OK" to delete <?php echo $team->nom_equipe; ?>
						</span>
						
					</p>

					<br /><br />
					
					
					<p style="margin-top : 0; float:left; clear : left" class="">
						<button class="submit radius2">OK</button>
						
					</p>
				</form>

            </div><!--subcontent-->
        
        </div><!--contentwrapper-->
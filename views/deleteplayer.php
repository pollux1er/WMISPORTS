<?php 
$j = new joueurs();
$joueur = $j->getRecord($_GET['idplayer']);
//echo "<pre>"; var_dump($joueur);
?>
		<div class="pageheader">
            <h1 class="pagetitle">Delete player</h1>
            <span class="pagedesc">Click "OK" to delete the plqyer</span>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	<div id="validation" class="subcontent">
				<form id="form1" class="stdform" method="post" action="controller/deleteplayer.php?idteam=<?php echo $_GET['idteam']; ?>&idplayer=<?php echo $_GET['idplayer']; ?>">
					<p style="clear: right; float : left; margin : 0">
						<span style="font-weight:bold;float:left; width:450px; margin : 3px 5px 3px 50px; padding : 2px 5px">Do you want to delete the player : <?php echo $joueur->noms ?> (<?php echo $joueur->email ?>)</span>
						
					</p>

					<br /><br />
					
					
					<p style="margin-top : 0; float:left; clear : left" class="">
						<button class="submit radius2">OK</button>
						
					</p>
				</form>

            </div><!--subcontent-->
        
        </div><!--contentwrapper-->
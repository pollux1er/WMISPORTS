<?php 
$j = new joueurs();
$joueur = $j->getPlayerInfo($_GET['idplayer']);
$r = new rencontres();
$game = $r->getRecord($_GET['game']);
//echo "<pre>"; var_dump($_GET);

?>

		<div class="pageheader">
            <h1 class="pagetitle">Invite player</h1>
            <span class="pagedesc">Invite <?php echo $joueur->noms; ?> via email for the game on <?php echo $game->date ?>.</span>
            
        
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	<div id="validation" class="subcontent">
            	<div class="contenttitle2">
					<span><b>Invite <?php echo $joueur->noms; ?> via email.</b><br />
					If you want, enter a custom invite message<br />
					</span>
				</div><!--contenttitle-->
				<form id="form1" class="stdform" method="post" action="controller/inviteplayer.php?game=<?php echo $_GET['game']; ?>&player=<?php echo $_GET['idplayer']; ?>&idteam=<?php echo $_GET['idteam']; ?>">
					<p>
						<label><b>To :</b> </label>
						<span class="field" style="line-height: 32px;"><?php echo $joueur->noms; ?> (<?php echo $joueur->email; ?>)</span>
						<input type="hidden" name="email" value="<?php echo $joueur->email; ?>" />
					</p>
					<p>
						<label><b>Subject :</b> </label>
						<span class="field" style="line-height: 32px;"><input type="text" name="subject" /></span>
					</p>					
					<p>
						<label>Message :</label>
						<span class="field" style=""><textarea cols="80" name="message" rows="5" class="longinput"></textarea></span> 
					</p>
				
					<p>
						<span class="formwrapper1">
							<input type="checkbox" name="priority" value="yes" /> High importance<br />
						</span>
						
					</p><br />
				
					
					<br />
					
					<p class="stdformbutton">
						<button class="submit radius2">SEND</button>
					</p>
				</form>

            </div><!--subcontent-->
        
        </div><!--contentwrapper-->
<script type="text/javascript">
	
</script>
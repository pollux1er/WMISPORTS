<?php 
$j = new joueurs();
$joueur = $j->getPlayerInfo($_GET['idplayer']);
//echo "<pre>"; var_dump($sports);

?>

		<div class="pageheader">
            <h1 class="pagetitle">Contact player</h1>
            <span class="pagedesc">Send a message to a player</span>
            
        
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	<div id="validation" class="subcontent">
            	<div class="contenttitle2">
					<span><b>Send a message to <?php echo $joueur->noms; ?>'s via email.</b><br />
					The email will include <?php echo $joueur->noms; ?>'s schedule link, and all the other usual sweetness<br />
					</span>
				</div><!--contenttitle-->
				<form id="form1" class="stdform" method="post" action="controller/contactplayer.php">
					<p>
						<label><b>To :</b> </label>
						<span class="field" style="line-height: 32px;"><?php echo $joueur->noms; ?> (<?php echo $joueur->email; ?>)</span>
					</p>					
					<p>
						<label>Message :</label>
						<span class="field" style=""><textarea cols="80" rows="5" class="longinput"></textarea></span> 
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
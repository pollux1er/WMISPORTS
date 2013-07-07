<?php 
$j = new joueurs();
$joueursR = $j->getRegularTeamPlayers($_GET['idteam']);
$joueursS = $j->getSubTeamPlayers($_GET['idteam']);
//echo "<pre>"; var_dump($sports);

?>

		<div class="pageheader">
            <h1 class="pagetitle">Contact players</h1>
            <span class="pagedesc">Contact players you want</span>
            
        
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	<div id="validation" class="subcontent">
            	<div class="contenttitle2">
					<span><b>Select which email-using, opted-in players to contact via email.</b><br />
					The email include the players' own schedule links, and all the other usual sweetness<br />
					</span>
				</div><!--contenttitle-->
				<form id="form1" class="stdform" method="post" action="controller/saveteam.php">
					<p>
						<label><b>To :</b> </label>
						<span class="field" style="line-height: 32px;">[selected players]</span>
					</p>					
					<p>
						<label>Message :</label>
						<span class="field" style=""><textarea cols="80" rows="5" class="longinput"></textarea></span> 
					</p>
				
					<p>
						<span class="formwrapper1">
							<input type="checkbox" name="priority" value="yes" /> High importance<br />
						</span>
						<span class="formwrapper2">
							<input type="checkbox" name="gameperiod" value="yes" /> Twitter<br />
						</span>
						<span class="formwrapper3">
							<input type="checkbox" name="gameperiod" value="yes" /> Captain<br />
						</span>
					</p><br />
					<p>
						<label>Regular players(with email):</label>
						<span class="field">
                            <select name="select2" multiple="multiple" size="5">
							<?php foreach($joueursR as $j) { ?>
                                <option value=""><?php echo $j->noms ?></option>
                             <?php } ?>
                            </select>
                        </span>
					</p>
					<p>
						<label>Subs(with email):</label>
						<span class="field">
                            <select name="select2" multiple="multiple" size="5">
                               <?php foreach($joueursS as $s) { ?>
                                <option value=""><?php echo $s->noms ?></option>
                             <?php } ?>
                            </select>
                        </span>
					</p>
					
					<br />
					
					<p class="stdformbutton">
						<button class="submit radius2">SEND</button>
					</p>
				</form>

            </div><!--subcontent-->
        
        </div><!--contentwrapper-->
<script type="text/javascript">
	
</script>
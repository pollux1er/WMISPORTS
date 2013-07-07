<?php 
$sport = new sports();
$sports = $sport->getAllRecords();
//echo "<pre>"; var_dump($sports);
$i = 1;
?>
		<div class="pageheader">
            <h1 class="pagetitle">Add game(s)</h1>
            <span class="pagedesc">Enter info for the game(s) and click "OK"</span>
            
        
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	<div id="validation" class="subcontent">
				<?php if(preg_match('/success/i', $_SERVER['REQUEST_URI'])) { ?>
				<div class="notibar msgsuccess">
					<a class="close"></a>
					<p>Game's successfully added.</p>
				</div><!-- notification msgsuccess -->
				<?php } ?>
            	<div class="contenttitle2">
					<span>You can always add more games or edit games later on.<br />
					<b>To track more/less info about games, go to "Team Settings".</b>
					</span>
				</div><!--contenttitle-->
				
				<form id="form1" class="stdform" method="post" action="controller/savegames.php?idteam=<?php echo $_GET['idteam']; ?>">
					<p style="clear: right; float : left; margin : 0">
						<span style="float:left; width:100px; margin : 3px 5px 3px 50px; padding : 2px 5px">Game dates *</span>
						<span style="float:left; width:180px; margin : 3px 5px 3px 15px; padding : 2px 10px">Game status</span>
						
					<!--	<span style="float:left; width:50px; margin : 3px 35px 3px 20px; padding : 2px 5px">Gender</span> -->
					<!--	<span style="float:left; width:150px; margin : 3px 5px 3px 0px; padding : 2px 5px">Position(s)</span> -->
						<span style="float:left; width:150px; margin : 3px 5px 3px 20px; padding : 2px 5px; clear:right">Game Notes</span>
					</p>
<?php for($i; $i < 6; $i++) { ?>					
					<p style="clear: left; float : left; margin : 0">
						<span style="float:left; width:10px; margin : 3px 5px 3px 15px; padding : 2px 5px;line-height : 30px"><?php echo $i; ?></span>
						<span style="float:left; margin : 3px 5px 3px 10px;" class="field"><input style="width:150px" id="date<?php echo $i ?>" type="text" name="date[<?php echo $i ?>]"  class="smallinput" /></span>
						<span style="float:left; margin : 3px 5px 3px 20px;" class="field"><select style="width : 180px; height : 33px; padding : 8px" name="status[<?php echo $i ?>]" class="uniformselect">
                            	<option value="Normal">Normal</option>
                                <option value="Tentative">Tentative</option>
                                <option value="Rescheduled">Rescheduled</option>
                                <option value="Possible">Possible</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Postponed">Postponed</option>
                            </select>
						</span>
						<span style="float:left; margin : 3px 5px 3px 20px;" class="field"><input style="width:180px" type="text" name="notes[<?php echo $i ?>]" class="smallinput" /></span>
					</p>
					
<?php } ?>			
					<br /><br />
					<p style="float:left;clear : left;margin-bottom : 0">
						<span><b>Optional</b>: In addition to individual games above, you can add a series of games (and later modify or delete any of them) :<br />
						</span>
						
					</p>					
					<p style="clear: left;float:left; margin-bottom : 0">
						<span class="">
							<input type="checkbox" name="gameperiod" id="gameperiod" onclick="checktype();" value="yes" /><b> Add series of games </b><br />
						</span>
					</p>
					<p id="games" style=" clear: left; float:left ; margin-bottom : 0; width : 100%">
						<label style="width:100px; text-align: left;">Games are every</label>
						<span style="margin-left:20px" class="field">
                            <select name="periods" id="periods" style="float:left;min-width:18%;" class="uniformselect">
                            	<option value="Week">Week</option>
                                <option value="Day">Day</option>
                                <option value="2 Weeks">2 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>
                            </select>
                            
                        </span>
						<label style="width:100px">Starting</label>
						<span class="field" style="margin-left:20px;float:left">
							<input id="games_start" name="games_start" type="text" class="width100" /> 
						</span>
						<label style="width:100px">Ending</label>
						<span class="field" style="margin-left:20px;float:left">
							<input id="games_end" name="games_end" type="text" class="width100" /> 
						</span>
					</p>
					<br /><br /><br />
					
					<p style="clear: left; margin-top : 0; float : left" class="">
						<button class="submit radius2">OK</button>
						<input type="reset" class="submit radius2 btn_lime" value="RESET" />
					</p>
				</form>

            </div><!--subcontent-->
        
        </div><!--contentwrapper-->
<script type="text/javascript">
	/* function checktype() {
		var gameperiod;
		gameperiod = jQuery('#gameperiod:checked').val();
		//alert(gameperiod);
	jQuery("#games_start:disabled").val();
	jQuery("#games_end:disabled").val();
	jQuery("#games").css('opacity', '0.6'); */
	<?php $i=1; for($i; $i < 6; $i++) { ?>
		jQuery( "#date<?php echo $i; ?>").datepicker();
	<?php } ?>
function checktype() {
	var gameperiod;
	gameperiod = jQuery('#gameperiod:checked').val();
	//alert(gameperiod);
	if(gameperiod=='yes') {
		jQuery('#periods').attr('disabled', false);
		jQuery('#games_start').attr('disabled', false);
		jQuery('#games_end').attr('disabled', false);
		jQuery("#games").css('opacity', '1');
	} else {
		jQuery('#periods').attr('disabled', true);
		jQuery('#games_start').attr('disabled', true);
		jQuery('#games_end').attr('disabled', true);
		jQuery("#periods:disabled").val();
		jQuery("#games_start:disabled").val();
		jQuery("#games_end:disabled").val();
		jQuery("#games").css('opacity', '0.6');
		
	}

}
jQuery( "#games_start" ).datepicker();
jQuery( "#games_end" ).datepicker();

//$("input:disabled").val("this is it");

//jQuery('#cat').attr('checked', true);

jQuery('#periods').attr('disabled', true);
jQuery('#games_start').attr('disabled', true);
jQuery('#games_end').attr('disabled', true);
jQuery("#periods:disabled").val();
jQuery("#games_start:disabled").val();
jQuery("#games_end:disabled").val();
jQuery("#games").css('opacity', '0.6');
</script>
<?php 
$sport = new sports();
$sports = $sport->getAllRecords();
$i = 1;
?>
		<div class="pageheader">
            <h1 class="pagetitle">Add player(s)</h1>
            <span class="pagedesc">Enter info for one or more players and click "OK" to add them to your roster</span>
            
        
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	<div id="validation" class="subcontent">
				<?php if(preg_match('/success/i', $_SERVER['REQUEST_URI'])) { ?>
				<div class="notibar msgsuccess">
					<a class="close"></a>
					<p>Players successfully added to the team.</p>
				</div><!-- notification msgsuccess -->
				<?php } ?>
            	<div class="contenttitle2">
					<span>You can always add more players or edit players later on (more than 15 if you need).<br />
					To track more/less info about playersm go to "Team Settings".<br />
					<b>Tip: You can paste in a list of players at the bottom.</b>
					</span>
				</div><!--contenttitle-->
				<form id="form1" class="stdform" method="post" action="controller/addplayers.php?idteam=<?php echo $_GET['idteam']; ?>">
					<p style="clear: right; float : left; margin : 0">
						<span style="float:left; width:150px; margin : 3px 5px 3px 50px; padding : 2px 5px">Player name...</span>
						<span style="float:left; width:150px; margin : 3px 5px 3px 15px; padding : 2px 5px">...and/or email(s)</span>
						<span style="float:left; width:50px; margin : 3px 5px 3px 50px; padding : 2px 5px">Sub?</span>
						<span style="float:left; width:35px; margin : 3px 5px 3px 5px; padding : 2px 5px">Ass't</span>
					<!--	<span style="float:left; width:50px; margin : 3px 35px 3px 20px; padding : 2px 5px">Gender</span> -->
					<!--	<span style="float:left; width:150px; margin : 3px 5px 3px 0px; padding : 2px 5px">Position(s)</span> -->
						<span style="float:left; width:150px; margin : 3px 5px 3px 20px; padding : 2px 5px; clear:right">Notes</span>
					</p>
<?php for($i; $i < 10; $i++) { ?>					
					<p style="clear: left; float : left; margin : 0">
						<span style="float:left; width:10px; margin : 3px 5px 3px 15px; padding : 2px 5px;line-height : 30px"><?php echo $i; ?></span>
						<span style="float:left; margin : 3px 5px 3px 10px;" class="field"><input style="width:150px" type="text" name="player[<?php echo $i; ?>]"  class="smallinput" /></span>
						<span style="float:left; margin : 3px 5px 3px 20px;" class="field"><input style="width:180px" type="text" name="email[<?php echo $i; ?>]" class="smallinput" /></span>
						<span style="float:left; margin : 3px 5px 3px 20px; padding : 7px" class="field"><input type="checkbox" name="sub[<?php echo $i; ?>]" value="y" /></span>
						<span style="float:left; margin : 3px 5px 3px 20px; padding : 7px" class="field"><input type="checkbox" name="capass[<?php echo $i; ?>]" value="y" /></span>
					<!--	<span style="float:left; margin : 3px 5px 3px 20px; padding : 7px" class="field"><input type="radio" name="gender" /> M &nbsp; &nbsp; <input type="radio" name="radiofield" checked="checked" /> F &nbsp; &nbsp;</span> -->
					<!--	<span style="float:left; margin : 3px 5px 3px 7px;" class="field"><input style="width:150px" type="text" name="position[]" class="smallinput" /></span>-->
						<span style="float:left; margin : 3px 5px 3px 20px;" class="field"><input style="width:180px" type="text" name="notes[<?php echo $i; ?>]" class="smallinput" /></span>
					</p>
					
<?php } ?>			
					<br /><br />
					<p style="float:left">
						<span><b>Import players (optional)</b>: Paste in a list of player names and/or email addresses below, then click import to populate the above fields.<br />
						Make any edits you need then click "OK".
						</span>
						<span class="field" style="margin-left : 0px"><textarea cols="80" rows="5" class="longinput"></textarea></span> 
					</p>					
					
					<br />
					
					<p style="margin-top : 0; float:left; clear : left" class="">
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
	jQuery("#newsport").hide();
	
	jQuery('#type_sport').change(function ()
	{
		var type_sport = jQuery("#type_sport").val();
		if(type_sport=='*') {
			jQuery("#newsport").fadeIn("slow");
		} else {
			jQuery("#newsport").fadeOut("slow");
		}
	});
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
	jQuery("#games").css('opacity', '0.6'); */
	
</script>
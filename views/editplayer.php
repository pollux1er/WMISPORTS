<?php 
$j = new joueurs();
$joueur = $j->getPlayerInfo($_GET['idplayer']);
//echo "<pre>"; var_dump($joueur);
?>
		<div class="pageheader">
            <h1 class="pagetitle">Edit player</h1>
            <span class="pagedesc">Enter the player info and click "OK"</span>
            
        
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	<div id="validation" class="subcontent">
				<?php if(preg_match('/success/i', $_SERVER['REQUEST_URI'])) { ?>
				<div class="notibar msgsuccess">
					<a class="close"></a>
					<p>Player's info successfully updated.</p>
				</div><!-- notification msgsuccess -->
				<?php } ?>
            	<div class="contenttitle2">
					<span>To track more/less info about players go to "Team Settings".<br />
					</span>
				</div><!--contenttitle-->
				<form id="form1" class="stdform" method="post" action="controller/editplayer.php?idteam=<?php echo $_GET['idteam']; ?>&idplayer=<?php echo $_GET['idplayer']; ?>">
					<p style="clear: right; float : left; margin : 0">
						<span style="float:left; width:150px; margin : 3px 5px 3px 50px; padding : 2px 5px">Player name...</span>
						<span style="float:left; width:150px; margin : 3px 5px 3px 15px; padding : 2px 5px">...and/or email(s)</span>
						<span style="float:left; width:50px; margin : 3px 5px 3px 50px; padding : 2px 5px">Sub?</span>
						<span style="float:left; width:35px; margin : 3px 5px 3px 5px; padding : 2px 5px">Ass't</span>
					<!--	<span style="float:left; width:50px; margin : 3px 35px 3px 20px; padding : 2px 5px">Gender</span> -->
					<!--	<span style="float:left; width:150px; margin : 3px 5px 3px 0px; padding : 2px 5px">Position(s)</span> -->
						<span style="float:left; width:150px; margin : 3px 5px 3px 20px; padding : 2px 5px; clear:right">Notes</span>
					</p>

					<p style="clear: left; float : left; margin : 0">
						<span style="float:left; width:10px; margin : 3px 5px 3px 15px; padding : 2px 5px;line-height : 30px"></span>
						<span style="float:left; margin : 3px 5px 3px 10px;" class="field"><input style="width:150px" type="text" value="<?php echo $joueur->noms ?>" name="nom"  class="smallinput" /></span>
						<span style="float:left; margin : 3px 5px 3px 20px;" class="field"><input style="width:180px" type="text" value="<?php echo $joueur->email ?>" name="email" class="smallinput" /></span>
						<span style="float:left; margin : 3px 5px 3px 20px; padding : 7px" class="field"><input type="checkbox" name="remplacant" value="y" <?php if($joueur->remplacant=='y') echo 'checked=checked'; ?> /></span>
						<span style="float:left; margin : 3px 5px 3px 20px; padding : 7px" class="field"><input type="checkbox" name="assistant" value="y" <?php if($joueur->assistant=='y') echo 'checked=checked'; ?> /></span>
					<!--	<span style="float:left; margin : 3px 5px 3px 20px; padding : 7px" class="field"><input type="radio" name="gender" /> M &nbsp; &nbsp; <input type="radio" name="radiofield" checked="checked" /> F &nbsp; &nbsp;</span> -->
					<!--	<span style="float:left; margin : 3px 5px 3px 7px;" class="field"><input style="width:150px" type="text" name="position[]" class="smallinput" /></span>-->
						<span style="float:left; margin : 3px 5px 3px 20px;" class="field"><input style="width:180px" type="text" name="notes" value="<?php echo utf8_encode($joueur->notes); ?>" class="smallinput" /></span>
					</p>			

					<br /><br /><br /><br />
					
					
					<p style="margin-top : 0; float:left; clear : left" class="">
						<button class="submit radius2">OK</button>
						<button class="submit radius2" onclick="window.location='dashboard/team/<?php echo $_GET['idteam']; ?>/<?php echo $_GET['idplayer']; ?>/deleteplayer/'; return false;">DELETE PLAYER</button>
						<button class="submit radius2">CANCEL</button>
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
<?php 
$sport = new sports();
$sports = $sport->getAllRecords();
//echo "<pre>"; var_dump($sports);

?>

		<div class="pageheader">
            <h1 class="pagetitle">Make new team</h1>
            <span class="pagedesc">Make brand spanking new team</span>
            
        
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	<div id="validation" class="subcontent">
            	<div class="contenttitle2">
					<span>Enter the brand new team's name below. You might want to add games too (see below).<br />
					When everythings look good, just click "OK"!<br />
					<b>NOTE:</b> Already on a team? Visit your team shcedule & click "Register/add team to account".
					</span>
				</div><!--contenttitle-->
				<form id="form1" class="stdform" method="post" action="controller/saveteam.php">
					<p>
						<label>New team's name</label>
						<span class="field"><input type="text" name="nom_equipe" id="nom_equipe" class="mediuminput" /></span>
					</p>					
					<p>
						<label>New team's sport</label>
						<span class="field">
							<select name="type_sport" id="type_sport">
								<option value="">- select -</option>
								<?php foreach($sports as $s) { ?>
								<option value="<?php echo $s->id; ?>"><?php echo $s->nom ?></option>
								<?php } ?>
								<option value="*">Other</option>
							</select>
						</span>
					</p>
					<p id="newsport">
						<label>... please specify</label>
						<span class="field"><input type="text" name="sport" id="sport" class="mediuminput" /></span>
					</p>
					<p style="padding-left: 220px;">
						<b>Optional : add games</b><br />
						You can add up to 20 games to your team schedule now if you want.<br />
						Otherwise you can always add games later on.
					</p>
					<p>
						<span class="formwrapper">
							<input type="checkbox" name="gameperiod" id="gameperiod" onclick="checktype();" value="yes" /> Add games<br />
						</span>
					</p>
					<p id="games">
						<label>Games are every</label>
						<span class="field">
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
					<p style="padding-left: 220px;"><br /><br />
						<b>Optional : player info</b><br />
						Tick the boxes if you want to track gender and/or positions played for each player.<br />
						(You can also change this later via "Team settings".)<br />
						You can track :
					</p>
					<p>
						<span class="formwrapper" style="float:left">
							<input type="checkbox" name="player_info_gender" id="player_info_gender" value="yes" /> Gender
						</span>
						<span class="formwrapper" style="float:left;margin-left:70px">
							<input type="checkbox" name="player_info_position" id="player_info_position" value="yes" /> Position played
						</span>
						<span class="formwrapper" style="float:left;margin-left:70px">
							<input type="checkbox" name="player_info_maybe" id="player_info_maybe" value="yes" /> Allow 'maybe' responses
						</span>
					</p>
					<p>
						
					</p>
					<br />
					
					<p class="stdformbutton">
						<button class="submit radius2">OK</button>
					</p>
				</form>

            </div><!--subcontent-->
        
        </div><!--contentwrapper-->
<script type="text/javascript">
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
	jQuery("#games").css('opacity', '0.6');
	
</script>
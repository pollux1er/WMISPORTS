<?php 
$m = new membres();
$user = $m->getRecord($_SESSION['iduser']);
//echo "<pre>"; var_dump($sports);

?>

		<div class="pageheader">
            <h1 class="pagetitle">Your profile</h1>
            <span class="pagedesc">Update your stuff</span>
            
        
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	<div id="validation" class="subcontent">
				<?php if(preg_match('/success/i', $_SERVER['REQUEST_URI'])) { ?>
				<div class="notibar msgsuccess">
					<a class="close"></a>
					<p>Profile successfully saved.</p>
				</div><!-- notification msgsuccess -->
				<?php } ?>
            	<div class="contenttitle2">
					<span><b>Update your stuff</b><br /></span>
				</div><!--contenttitle-->
				<form id="form1" class="stdform" method="post" action="controller/saveprofile.php">
					<p>
						<label><b>User ID :</b> </label>
						<span class="field" style="line-height: 32px;"><input type="text" name="login" value="<?php echo $user->login; ?>" class="smallinput" /></span>
					</p>
					
					<p>
						<label><b>Name :</b> </label>
						<span class="field" style="line-height: 32px;"><input type="text" name="name" value="<?php echo $user->name; ?>" class="smallinput" /></span>
					</p>
					<p>
						<label><b>Email Address</b> </label>
						<span class="field" style="line-height: 32px;"><input type="text" name="email" value="<?php echo $user->email; ?>" class="smallinput" /></span>
						<small class="desc">Note: If you change your email address, you'll be sent a confirmation email.</small>
					</p>
					<p>
						<label>Timezone </label>
						<span class="formwrapper">
                            <select name="timezone" id="timezone" data-placeholder="Choose a Timezone..." class="chzn-select" style="width:300px;" tabindex="2">
                              
                                <option <?php if($user->timezone == 'Pacific (N. Am.)') echo "selected=selected"; ?> value="Pacific (N. Am.)">Pacific (N. Am.)</option>
                                <option <?php if($user->timezone == 'Mountain (N. Am.)') echo "selected=selected"; ?> value="Mountain (N. Am.)">Mountain (N. Am.)</option>
                                <option <?php if($user->timezone == 'Central (N. Am.)') echo "selected=selected"; ?> value="Central (N. Am.)">Central (N. Am.)</option>
                                <option <?php if($user->timezone == 'Eastern (N. Am.)') echo "selected=selected"; ?> value="Eastern (N. Am.)">Eastern (N. Am.)</option>
                                <option <?php if($user->timezone == 'Atlantic (N. Am.)') echo "selected=selected"; ?> value="Atlantic (N. Am.)">Atlantic (N. Am.)</option>
                                <option <?php if($user->timezone == 'Newfoundland') echo "selected=selected"; ?> value="Newfoundland">Newfoundland</option>
                                <option <?php if($user->timezone == 'WET (West. Eur.)') echo "selected=selected"; ?> value="WET (West. Eur.)">WET (West. Eur.)</option>
                                <option <?php if($user->timezone == 'CET (Centr. Eur.)') echo "selected=selected"; ?> value="CET (Centr. Eur.)">CET (Centr. Eur.)</option>
                                
                                <option <?php if($user->timezone == 'GMT + 0') echo "selected=selected"; ?> value="GMT + 0">GMT + 0</option>
                                <option <?php if($user->timezone == 'GMT + 1') echo "selected=selected"; ?> value="GMT + 1">GMT + 1</option>
                                <option <?php if($user->timezone == 'GMT + 2') echo "selected=selected"; ?> value="GMT + 2">GMT + 2</option>
                                <option <?php if($user->timezone == 'GMT + 3') echo "selected=selected"; ?> value="GMT + 3">GMT + 3</option>
                                <option <?php if($user->timezone == 'GMT + 4') echo "selected=selected"; ?> value="GMT + 4">GMT + 4</option>
                                <option <?php if($user->timezone == 'GMT + 5') echo "selected=selected"; ?> value="GMT + 5">GMT + 5</option>
                                <option <?php if($user->timezone == 'GMT + 6') echo "selected=selected"; ?> value="GMT + 6">GMT + 6</option>
                                <option <?php if($user->timezone == 'GMT + 7') echo "selected=selected"; ?> value="GMT + 7">GMT + 7</option>
                                <option <?php if($user->timezone == 'GMT + 8') echo "selected=selected"; ?> value="GMT + 8">GMT + 8</option>
                                <option <?php if($user->timezone == 'GMT + 9') echo "selected=selected"; ?> value="GMT + 9">GMT + 8</option>
                                <option <?php if($user->timezone == 'GMT + 10') echo "selected=selected"; ?> value="GMT + 10">GMT + 10</option>
                                <option <?php if($user->timezone == 'GMT + 11') echo "selected=selected"; ?> value="GMT + 11">GMT + 11</option>
                                <option <?php if($user->timezone == 'GMT + 12') echo "selected=selected"; ?> value="GMT + 12">GMT + 12</option>
                                <option <?php if($user->timezone == 'GMT - 1') echo "selected=selected"; ?> value="GMT - 1">GMT - 1</option>
                                <option <?php if($user->timezone == 'GMT - 2') echo "selected=selected"; ?> value="GMT - 2">GMT - 2</option>
                                <option <?php if($user->timezone == 'GMT - 3') echo "selected=selected"; ?> value="GMT - 3">GMT - 3</option>
                                <option <?php if($user->timezone == 'GMT - 4') echo "selected=selected"; ?> value="GMT - 4">GMT - 4</option>
                                <option <?php if($user->timezone == 'GMT - 5') echo "selected=selected"; ?> value="GMT - 5">GMT - 5</option>
                                <option <?php if($user->timezone == 'GMT - 6') echo "selected=selected"; ?> value="GMT - 6">GMT - 6</option>
                                <option <?php if($user->timezone == 'GMT - 7') echo "selected=selected"; ?> value="GMT - 7">GMT - 7</option>
                                <option <?php if($user->timezone == 'GMT - 8') echo "selected=selected"; ?> value="GMT - 8">GMT - 8</option>
                                <option <?php if($user->timezone == 'GMT - 9') echo "selected=selected"; ?> value="GMT - 9">GMT - 9</option>
                                <option <?php if($user->timezone == 'GMT - 10') echo "selected=selected"; ?> value="GMT - 10">GMT - 10</option>
                                <option <?php if($user->timezone == 'GMT - 11') echo "selected=selected"; ?> value="GMT - 11">GMT - 11</option>
                                <option <?php if($user->timezone == 'GMT - 12') echo "selected=selected"; ?> value="GMT - 12">GMT - 12</option>
                                <option <?php if($user->timezone == 'GMT - 13') echo "selected=selected"; ?> value="GMT - 13">GMT - 13</option>
                                <option <?php if($user->timezone == 'GMT - 14') echo "selected=selected"; ?> value="GMT - 14">GMT - 14</option>
                                <option <?php if($user->timezone == 'Other...') echo "selected=selected"; ?> value="Other...">Other...</option>
                             
                             
                            </select>
                        </span>
					</p>
					
					<p>
						<label>Preferred language</label>
						<span class="formwrapper">
                            <select disabled=true data-placeholder="Choose a Timezone..." class="chzn-select" style="width:300px;" tabindex="3">
                              
                                <option value="" selected=selected >English</option>
                             
                            </select>
                        </span>
					</p>
				
					<br />
					
					
					<br />
					
					<p class="stdformbutton">
						<button class="submit radius2">UPDATE</button>
						<button class="submit radius2">DEREGISTER FROM WMISPORTS</button>
					</p>
				</form>

            </div><!--subcontent-->
        
        </div><!--contentwrapper-->
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery(".chzn-select").chosen();
});
</script>
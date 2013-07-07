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
						<label>Timezone </label>
						<span class="formwrapper">
                            <select data-placeholder="Choose a Timezone..." class="chzn-select" style="width:300px;" tabindex="2">
                              
                                <option value=""><?php  ?></option>
                             
                             
                            </select>
                        </span>
					</p>
					
					<p>
						<label>Preferred language</label>
						<span class="formwrapper">
                            <select data-placeholder="Choose a Timezone..." class="chzn-select" style="width:300px;" tabindex="2">
                              
                                <option value="" selected=selected disabled=true>English</option>
                             
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
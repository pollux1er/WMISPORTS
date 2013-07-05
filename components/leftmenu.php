<?php
if(isset($_GET['idteam'])) {
	$j = new joueurs();
	$joueurs = $j->getTeamPlayers($_GET['idteam']);
	//echo "<pre>"; var_dump($joueurs); die;
}
GLOBAL $app;

if(isset($_GET['view'])) {
	if($_GET['view'] == 'team'){ ?>
	<div class="vernav2 iconmenu">
    	<ul>	
			<li <?php if(@$_GET['layout'] == 'addplayers') echo 'class="current"'; ?>><a href="dashboard/team/<?php echo $_GET['idteam']; ?>/addplayers" class="elements">Add players</a></li>
			<li <?php if(@$_GET['layout'] == 'addgames') echo 'class="current"'; ?>><a href="dashboard/team/<?php echo $_GET['idteam']; ?>/addgames" class="widgets">Add games</a></li>
			<li <?php if(@$_GET['layout'] == 'contactplayers') echo 'class="current"'; ?>><a href="dashboard/team/<?php echo $_GET['idteam']; ?>/contactplayers" class="gallery">Contact players</a></li>
			
        	<li <?php if(isset($_GET['idplayer'])) echo 'class="current"'; ?>><a href="#formsub" class="tables">Players</a>
            	<span class="arrow"></span>
            	<ul id="formsub">
					<?php foreach($joueurs as $j) { ?>
               		<li><a href="dashboard/team/<?php echo $_GET['idteam']; ?>/<?php echo $j->idplayer; ?>/contactplayer/"><?php echo $j->noms; ?> (Contact)</a></li>
					<?php } ?>
                </ul>
            </li>
			<li><a href="buttons.html" class="buttons">Team setting</a></li>
           <li><a id="confirmbutton" href="dashboard/team/<?php echo $_GET['idteam']; ?>/deleteteam" class="error">Delete team</a></li>
           <!--<li><a href="calendar.html" class="calendar">Calendar</a></li>
            <li><a href="support.html" class="support">Customer Support</a></li>
          
			
           
            <li><a href="#addons" class="addons">Addons</a>
            	<span class="arrow"></span>
            	<ul id="addons">
               		<li><a href="newsfeed.html">News Feed</a></li>
                    <li><a href="profile.html">Profile Page</a></li>
                    <li><a href="productlist.html">Product List</a></li>
                    <li><a href="photo.html">Photo/Video Sharing</a></li>
                    <li><a href="gallery.html">Gallery</a></li>
                    <li><a href="invoice.html">Invoice</a></li>
                </ul>
            </li>-->
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->	
<?php 
	} else {
	?>
	<div class="vernav2 iconmenu">
    	<ul>
            <li><a href="dashboard/profile/" class="elements">Your profile</a></li>
            <li><a href="dashboard/view/newteam/<?php echo $_SESSION['iduser']; ?>" class="editor">Make new team</a></li>
			 <?php if($app->checkActivation($_SESSION['u']['utilisateur'])) { ?><li><a href="dashboard/sendActivation/?id=<?php echo $_SESSION['u']['utilisateur']; ?>" class="editor">Pending activation</a></li><?php } ?>
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->
	<?php }
} else {
?>
<div class="vernav2 iconmenu">
    	<ul>
            <li><a href="dashboard/profile/" class="elements">Your profile</a></li>
            <li><a href="dashboard/view/newteam/<?php echo $_SESSION['iduser']; ?>" class="editor">Make new team</a></li>
            <?php if($app->checkActivation($_SESSION['u']['utilisateur'])) { ?><li><a href="dashboard/sendActivation/?id=<?php echo $_SESSION['u']['utilisateur']; ?>" class="editor">Pending activation</a></li><?php } ?>
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->
<?php } ?>

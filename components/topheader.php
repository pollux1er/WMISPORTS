<?php @session_start(); ?>
	<div class="topheader">
        <div class="left">
            <h1 class="logo">WMI<span>SPORT</span></h1>
            <span class="slogan" style="color:white">Sports team management made simple!</span>
            
            <br clear="all" />
            
        </div><!--left-->
        
        <div class="right">
        	<div class="notification">
                <a class="count" href="ajax/notifications.html"><span>9</span></a>
        	</div>
            <div class="userinfo">
            	<img alt="" src="images/profile.png" width="22" height="22" />
                <span><?php if(empty($_SESSION['u']['nom'])) { echo $_SESSION['u']['utilisateur']; } else { echo $_SESSION['u']['nom']; } ?></span>
            </div><!--userinfo-->
            
            <div class="userinfodrop">
            	<div class="avatar">
                	<a href=""><img src="images/profile.png" width="100" height="100" alt="" /></a>
                   
                </div><!--avatar-->
                <div class="userdata">
                	<h4><?php if(empty($_SESSION['u']['nom'])) { echo $_SESSION['u']['utilisateur']; } else { echo $_SESSION['u']['nom']; } ?></h4>
                    <span class="email"><?php echo $_SESSION['u']['utilisateur']; ?></span>
                    <ul>
                    	<li><a href="dashboard/profile/">Edit Profile</a></li>
                        <li><a href="dashboard/help/">Help</a></li>
                        <li><a href="deconnexion.php">Sign Out</a></li>
                    </ul>
                </div><!--userdata-->
            </div><!--userinfodrop-->
        </div><!--right-->
    </div><!--topheader-->
	
	<div class="header">
    	<ul class="headermenu">
        	<li <?php if(preg_match('/dashboard.html/i', $_SERVER['REQUEST_URI'])) echo 'class="current"'; ?>><a href="dashboard"><span class="icon icon-flatscreen"></span>Dashboard</a></li>
			<?php
				// get all teams of the captain here
				$team = new equipes();
				$teams = $team->getAllRecords();
			foreach($teams as $t) { ?>
				<li <?php if(@$_GET['idteam'] == $t->id) echo 'class="current"'; ?>><a href="dashboard/view/team/<?php echo $t->id; ?>"><span class="icon icon-pencil"></span><?php echo utf8_encode($t->nom_equipe); ?></a></li>
			<?php } ?>
            <li <?php if(preg_match('/newteam/i', $_SERVER['REQUEST_URI'])) echo 'class="current"'; ?>><a href="dashboard/view/newteam/<?php echo $_SESSION['iduser']; ?>"><span class="icon icon-pencil"></span>New Team</a></li>
        </ul>
        
        <div class="headerwidget">
        	<div class="earnings">
            	<div class="one_half">
                	<h4>Today's Earnings</h4>
                    <h2>$640.01</h2>
                </div><!--one_half-->
                <div class="one_half last alignright">
                	<h4>Current Rate</h4>
                    <h2>53%</h2>
                </div><!--one_half last-->
            </div><!--earnings-->
        </div><!--headerwidget-->
        
        
    </div><!--header-->
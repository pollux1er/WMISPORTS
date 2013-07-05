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
            	<img src="images/thumbs/avatar.png" alt="" />
                <span>Juan Dela Cruz</span>
            </div><!--userinfo-->
            
            <div class="userinfodrop">
            	<div class="avatar">
                	<a href=""><img src="images/thumbs/avatarbig.png" alt="" /></a>
                   
                </div><!--avatar-->
                <div class="userdata">
                	<h4>Juan Dela Cruz</h4>
                    <span class="email">youremail@yourdomain.com</span>
                    <ul>
                    	<li><a href="editprofile.html">Edit Profile</a></li>
                        <li><a href="accountsettings.html">Account Settings</a></li>
                        <li><a href="help.html">Help</a></li>
                        <li><a href="index.html">Sign Out</a></li>
                    </ul>
                </div><!--userdata-->
            </div><!--userinfodrop-->
        </div><!--right-->
    </div><!--topheader-->
	
	<div class="header">
    	<ul class="headermenu">
        	<li  class="current"><a href="dashboard.html"><span class="icon icon-flatscreen"></span>Dashboard</a></li>
			<?php
				// get all teams of the captain here
				$team = new equipes();
				$teams = $team->getAllRecords();
			foreach($teams as $t) { ?>
				<li <?php if(@$_GET['idteam'] == $t->id) echo 'class="current"'; ?>><a href="dashboard/view/team/<?php echo $t->id; ?>"><span class="icon icon-pencil"></span><?php echo $t->nom_equipe; ?></a></li>
			<?php } ?>
            <li><a href="dashboard/view/newteam/<?php echo $_SESSION['iduser']; ?>"><span class="icon icon-pencil"></span>New Team</a></li>
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
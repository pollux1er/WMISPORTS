<?php
//echo "<pre>";var_dump($_GET); die;

 if(isset($_GET['view'])) {
	
	if(isset($_GET['layout']))
		getView($_GET['layout']); 
	else
		getView(); 
 } else {
?>
        <div class="pageheader">
            <h1 class="pagetitle">Welcome</h1>
            <span class="pagedesc">Your team dashboard</span>
            
            <ul class="hornav">
                <li class="current"><a href="#updates">Updates</a></li>
                <li><a href="#activities">Activities</a></li>
            </ul>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div id="updates" class="subcontent">
                    <div class="notibar announcement">
                        <a class="close"></a>
                        <h3>Welcome to WMISPORTS</h3>
                        <p>Already play on one or more WMISPORTS teams? Add them to your account : <br />
						- click the link in the activation email sent to you;<br/>
						- go to your team schedule and click "Register/add team to account"<br />
						Otherwise, create a NEW team by entering its name. Think you can handle that?<br />
						Next you'll: <br />
						1.) add players;<br />
						2.) add games;<br />
						3.) invite the players to the games;<br />
						That will send out automatic emails to the players, who can click links in the email to update the schedule on their own, saving you loads of time and hassle! (That's why you signed up, right?)
						
						</p>
                    </div>
                   
                    <div class="one_third last dashboard_right">
                    
                                               
                    </div><!--one_third last-->
                   
            </div><!-- #updates -->
            
            <div id="activities" class="subcontent" style="display: none;">
            	&nbsp;
            </div><!-- #activities -->
        
        </div><!--contentwrapper-->
		
		   <br clear="all" />
<?php } ?>
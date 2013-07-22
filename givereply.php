<?php
 
require_once 'config.php';
GLOBAL $app;
$C = new CamerticConfig;
$app = new WMI;

if(isset($_GET['r'])) {
	if($_GET['r'] == 'upa') { // Petit checkin de l'url
		$r = new rencontres();
		$j = new joueurs(); 
		$joueur = $j->getRecord($_GET['p']);
		$game = $r->getRecord($_GET['g']);
		$teamName = $r->getTeamNameFromGame($_GET['g']);
		// On check ensuite si la rencontre est d'actualite
		if($r->getGameStatus($_GET['g']) == 'uptodate') {
		//	$app->urlReply .= "preply.php?upa=".$_GET['r']."&g=" . $_GET['g'] . "&p=" . $_GET['p'] . "&a=" . $_GET['a'];
			$r->getReply($_GET['g'], $_GET['p'], $_GET['a']);
			
			$return = "";
		//	$app->go($app->urlReply);
		} else 
			$return = "Sorry, but that game is in the past and can't be updated anymore.";
	} else
		$app->go($app->urlLogin);
	
} else {
	$app->go($app->urlLogin);
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="recreational sports team management, sports equipment, mobile cellular phones, cars automobiles, vacation, airlines, holiday, electronics, rec league, hockey, football, soccer, basketball, baseball, ultimate frisbee, rugby, volleyball, lacrosse, curling, innertube waterpolo, dodgeball, tennis" />
<title>WMI SPORTS&trade; &mdash; Player Update &mdash; sports team management made simple!</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<style>
<!--
.htcPlayerActionPage P {
	margin: 20px 20px 20px 20px;
}
TABLE.htcPlayerUpdateResult {
	border-style: dashed;
	border-color: #000;
	border-width: 3px;
}
TABLE {
	display: table;
}
TBODY {
	display: table-row-group;
}
TR {
	display: table-row;
}
.htcPlayerActionPage TD {
	font-size: 8pt;
	font-weight: normal;
}
-->
</style>
</head>

<body class="loginpage">
	<div class="terms">
		<h2><span>WMI</span><span class="slog">SPORTS</span></h2>
		<br> Thanks for using WMISPORTS. <br><br> 
		<br><br><b>Thanks <?php echo $joueur->noms;  ?></b>, you have <u>updated</u> your status to:<br><br>
		<p>
		<table class="htcPlayerUpdateResult">
		<tbody>
			<tr>
				<td><?php
					if($_GET['a'] == 'm') : ?>
					<img alt="Maybe (you're on the fence)" src="images/icon_questionmark.jpg"> <b>Maybe (you're on the fence)</b>
					<?php endif; ?>
					<?php if($_GET['a'] == 'y') : ?>
					<img alt="YES (you will attend)" src="images/icon_checkmark.jpg"> <b>YES (you will attend)</b>
					<?php endif; ?>
					<?php if($_GET['a'] == 'n') : ?>
					<img alt="No (you can't attend)" src="images/icon_ex.jpg"> <b>No (you can't attend)</b>
					<?php endif; ?>
				</td>
			</tr>
		</tbody>
		</table>
		</p><br><br>
		...for the game on <b><?php echo $game->date;  ?></b> of team '<b><?php echo $teamName; ?></b>'.
		<br><br><br><br><br>
		Visit <b><a href="http://www.wmisports.com/wmibeta/shedule.php?r=p&amp;p=d70f00892d0add2c401744bc88ac9994&p=<?php  ?>">your schedule</a></b>   
		any time to view and update your status at '<b><?php echo $teamName; ?></b>' games. <br>
		Bookmark/add-to-favourites the link for future reference; don't pass it around though, to avoid letting your opponents mess with your head. <br><br><br>
		<br><br>  
	</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color :  #000; color :#fff; position : fixed; bottom : 0;">
<tbody>
<tr>
  <td align="center" class="pageFooter">
    <a href="/wmibeta/?nl=2">WMISPORTS</a>™ <a href="http://happytc.com/htc/k/?i=cpy&amp;lang=en_CA" title="© 2013">© 2013</a>, <a href="#" target="_new">DPCP</a> 
    — <a href="#" title="About WMISPORTS">about</a>
    — <a href="terms.html" title="View our Terms of Service">terms</a> 
    — <a href="#" title="View our Privacy Policy">privacy</a> 
    — <a href="#" title="Helpful tips on WMISPORTS">help</a> 
    — <a href="mailto:info{AT}wmisports{DOT}com?body=NOTE:%20Please%20insert%20an%20@%20sign%20in%20the%20usual%20place%20in%20the%20To%20address%20of%20this%20email.%0A%0D%0A%0DThanks%20for%20helping%20us%20avoid%20spam!" title="Get in touch with us for more info, questions, support, etc.">contact us</a>
    — <a href="#" title="Feed us some back: we'd love to hear it">feedback</a>
    — <a href="#" title="SMS/twitter"><img src="http://happytc.com/htc/images/icon_twitter_bird_19x16.png" border="0">twitter</a>
    — <a href="#" title="WMISPORTS mobile (beta)"><img src="http://happytc.com/htc/images/icon_mobile_phone.png" border="0"> mobile</a>
  </td>
</tr></tbody></table>
</body>
</html>
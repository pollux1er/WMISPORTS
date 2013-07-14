<?php
session_start();
//die('ekie');
require_once('config.php');
require_once('lib/library.php');
$C = new CamerticConfig;
global $idcaptain;
$captain = new utilisateur(); 
global $app;
$app = new WMI;

$sport = new equipes_joueurs();

// Check session
if(!$app->checkSession()) {
	$app->urlLogin = $C->rootUrl . $app->urlLogin;
	$app->go($app->urlLogin);
}
if(isset($_GET['team']))
	$_SESSION['idteam'] = $_GET['idteam'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo $C->rootUrl; ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Dashboard | WMISPORT</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<link rel="stylesheet" href="css/style.greenline.css" type="text/css" />
<script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.flot.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.slimscroll.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/dashboard.js"></script>
<script type="text/javascript" src="js/custom/forms.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/plugins/excanvas.min.js"></script><![endif]-->
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
</head>

<body class="withvernav">

<div class="bodywrapper">
   
   <?php
		$getHeaderComponent('topheader');
		
		
		
		
		$getLeftComponent('leftmenu');
		
		
	?>
        
    <div class="centercontent">
	<?php
		$getContent('content');
	?>
     
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color :  #000; color :#fff; position : fixed; bottom : 0;">
<tbody>
<tr>
  <td align="center" class="pageFooter">
    <a href="/wmibeta/?nl=2">WMISPORTS</a>™ <a href="http://happytc.com/htc/k/?i=cpy&amp;lang=en_CA" title="© 2013">© 2013</a>, <a href="#" target="_new">DPCP</a> 
    — <a href="#" title="About WMISPORTS">about</a>
    — <a href="#" title="View our Terms of Service">terms</a> 
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

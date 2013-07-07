jQuery(document).ready(function(){
								
	///// TRANSFORM CHECKBOX /////							
	jQuery('input:checkbox').uniform();
	
	///// LOGIN FORM SUBMIT /////
	jQuery('#login').submit(function(){
	
		if(jQuery('#username').val() == '' && jQuery('#password').val() == '') {
			jQuery('.nousername').fadeIn();
			jQuery('.nopassword').hide();
			return false;	
		}
		if(jQuery('#password').val() != '' && jQuery('#password2').val() != '') { // si password 1 et 2 non nul
			if(jQuery('#password').val() != jQuery('#password2').val() != '') {
				jQuery('.differentpassw').fadeIn();
				jQuery('.nousername').hide();
				jQuery('.nopassword').hide();
				return false;;
			}
		} else {
			jQuery('.nopassword').fadeIn();
			jQuery('.nousername').hide();
			jQuery('.differentpassw').hide();
			return false;;
		}
	});
	
	///// ADD PLACEHOLDER /////
	jQuery('#username').attr('placeholder','Email');
	jQuery('#password').attr('placeholder','Password');
	jQuery('#password2').attr('placeholder','Confirm password');
});

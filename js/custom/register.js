function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};

jQuery(document).ready(function(){
								
	///// TRANSFORM CHECKBOX /////							
	jQuery('input:checkbox').uniform();
	
	///// LOGIN FORM SUBMIT /////
	jQuery('#login').submit(function(){
		
		if( !isValidEmailAddress( jQuery('#username').val() ) ) {
			jQuery('.bademail').fadeIn();
			jQuery('.nousername').hide();
			jQuery('.nopassword').hide();
			return false;;
		}
		
		if(jQuery('#username').val() == '' && jQuery('#password').val() == '') {
			jQuery('.nousername').fadeIn();
			jQuery('.nopassword').hide();
			jQuery('.bademail').hide();
			return false;	
		}
		if(jQuery('#password').val() != '' && jQuery('#password2').val() != '') { // si password 1 et 2 non nul
			if(jQuery('#password').val() != jQuery('#password2').val() != '') {
				jQuery('.differentpassw').fadeIn();
				jQuery('.nousername').hide();
				jQuery('.nopassword').hide();
				jQuery('.bademail').hide();
				return false;;
			}
		} else {
			jQuery('.nopassword').fadeIn();
			jQuery('.nousername').hide();
			jQuery('.bademail').hide();
			jQuery('.differentpassw').hide();
			return false;;
		}
		jQuery('.nousername').hide();
		jQuery('.bademail').hide();
		jQuery('.differentpassw').hide();
		jQuery('.nopassword').hide();
		var terms;
		terms = jQuery('#terms:checked').val();
		if(terms != 'yes') {
			alert('Please accept our terms amd conditions first!!');
			return false;
		}
		
	});
	
	///// ADD PLACEHOLDER /////
	jQuery('#username').attr('placeholder','Email');
	jQuery('#password').attr('placeholder','Password');
	jQuery('#password2').attr('placeholder','Confirm password');
});

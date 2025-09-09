jQuery(document).ready(function(){
	jQuery('#frmAddUser').validationEngine();
	if ("ontouchstart" in window || navigator.msMaxTouchPoints)
        {
            jQuery('#stylesheet').attr('href', 'css/responsive.css');
        } else {
            jQuery('#stylesheet').attr('href', '');
        }
        
 })




//menu
$(document).ready(function() {
	     var url = window.location.href;
		$('.navbar a[href="'+ url +'"]').parent().addClass('active');
        
		$('.topright a[href="'+ url +'"]').addClass('active');
        
		$('.footerListing a[href="'+ url +'"]').parent().addClass('active'); 
        
		$('.accountList a[href="'+ url +'"]').parent().addClass('active');
        
        $('.breadcrumb li:last').addClass('active');
        
        $('.catListing a[href="'+ url +'"]').parent().addClass('active');
        
       // $('#links span:last').remove();
        

       /********* Toggle menu for desktop ***********/
       	 
          $('.navbar-toggle').on('click', function(){
              $('body').toggleClass('nav-open');
          });
          $('.navbar-close').on('click', function(){
              $('.navbar-toggle').trigger('click');
          });
        
        /********* Toggle menu for desktop end***********/


});

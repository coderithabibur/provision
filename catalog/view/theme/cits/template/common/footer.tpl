<?php
$url= 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

?>
<footer>
  <div class="footertop">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="payments"> <a><img src="<?php echo $image_url ?>/catalog/view/theme/hidlighting/images/paypal.png" alt=""></a> <a><img src="<?php echo $image_url ?>/catalog/view/theme/hidlighting/images/visa.png" alt=""></a> <a><img src="<?php echo $image_url ?>/catalog/view/theme/hidlighting/images/discover.png" alt=""></a> <a><img src="<?php echo $image_url ?>/catalog/view/theme/hidlighting/images/mastercard.png" alt=""></a> <a><img src="<?php echo $image_url ?>/catalog/view/theme/hidlighting/images/american.png" alt=""></a> </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="footerSearch">
            <div class="form-inline">
              <label>Newsletter Signup</label>
              <div class="input-group" id="subscribe_field">
                <input type="text" class="form-control footer-input" placeholder="Enter your email" name="sub_email" id="sub_email">               
                <span class="input-group-btn">
                <button class="btn" type="button" type="submit" id="subscriber"><i aria-hidden="true" class="fa fa-envelope"></i></button>
                </span> </div>              
            </div>
            <span class="subscribe_msg" id="subscribe_msg" >
                <span id="error_subscribe" class="error"></span> 
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footerbottom">
    <div class="container">
    <div class="row">
     <div class="col-md-4 col-sm-4 col-xs-6">
 <h4>Quick Links</h4>
        <div class="footerListing">
  		  <?php if ($informations) { ?>      
        <ul>
          <?php
		  $i=1;
		  foreach ($informations as $information) {
			if($i == 4){
			  break;
			}
			?>
          <li><a href="<?php echo $information['href']; ?>" title="<?php echo $information['title']; ?>"><?php echo $information['title']; ?></a></li>
          <?php $i++; } ?>
		  
		   <li><a href="<?php echo $information['href']; ?>" title="<?php echo $information['title']; ?>"><?php echo $information['title']; ?></a></li>
		   <li><a href="https://www.pro-vision-lighting.com/returnandrefundpolicy" title="RETURN AND REFUND POLICY">Return and Refund Policy</a></li>
		   <li><a href="<?php echo $compare; ?>" title="<?php echo $text_compare; ?>"><?php echo $text_compare; ?></a></li>
		  
		</ul> 
      <?php } ?>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-6">
 <h4>Socialize with us</h4>
        <div class="socialicons">
          <ul>        
			<li><a href="<?php echo $google; ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
			<li><a href="<?php echo $facebook; ?>" target="_blank"><i aria-hidden="true" class="fa fa-facebook"></i></a></li>
			<li><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			<li class="blogger"><a href="<?php echo $blogger; ?>" target="_blank"><img src="catalog/view/theme/hidlighting/images/blog.png"></a></li>
			<li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
			<li><a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
		   <li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          </ul>
        </div>
		<br/><br/>

      </div>

     <div class="col-md-4 col-sm-4 col-xs-12">
       <h4>Contact Information</h4>
        <div class="footerListing contactInfo">
          <ul>
			<li><?php echo $name;?>.</li>
            <li><?php //echo $name;?> <?php echo $address;?></li>
            <li><a href="tel:<?php echo $telephone;?>"><?php echo $telephone;?></a></li>
            <li><a href="mailto:<?php echo $email;?>"><?php echo $email;?></a></li>
         
          </ul>
        </div>
      </div>
       <div class="col-xs-12">
        <p class="copyright"><?php echo $powered; ?></p>
      </div>
  </div>
   <?php if($url == $base || $url == $home){ /* ?>  
  <div class="col-md-12 col-sm-12 col-xs-12">
     <p class="powered">Powered by Webworld Experts - <a href="http://www.webworldexperts.com/" target="_blank">Web Design Company India</a></p>
  </div>
  <?php */ } ?>
    </div>
  </div>
</footer>


<script>

$( ".sidedown" ).click(function() {
  $( ".categories" ).slideToggle( "slow", function() {
  });
});
</script> 

<script>
/*$('.categories ul li ul li a ').click(function(){
	$(".categories ul li ul li.dropdownMenu").addClass("active");
    $(this).find('i').toggleClass('fa-angle-right fa-angle-down')
});*/
$('.categories ul li').click(function(e){
	$(".categories ul li.dropdown ").addClass("active");
  	$(this).children('ul').slideToggle(500);
  	e.stopPropagation();
});
/*
$(document).ready(function () {
    $('.categories ul li ul li a').click(function(e) {
		var current =  $(this).parent().prop("class");
		var $parent = $(this).parent();
		if(current == 'active')
		{
		$(this).parent().removeClass("active");
		}
		else
		{
		$(this).parent().addClass("active");
		}
        /*
        
        if (!$parent.hasClass('active')) {
           
		}
        e.preventDefault();
    });
});*/
</script> 

<script>
$(document).ready(function() {
	$('.cartBoxTop').click(function(){
      $('.cartInputBox').slideToggle();
  });
});

</script>
 <script type="text/javascript"><!--
$('#subscriber').bind('click', function() { <!-- 
 var email=$("#sub_email").val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          if(email == '' || email == "Enter your email") {
		$("#error_subscribe").html('E-Mail id is required!');
		return false;
           }
	 else if( !emailReg.test( email ) ) {
		$("#error_subscribe").html('E-Mail id is  not valid!');
		return false;
	  }   
	 $.ajax({
		url: 'index.php?route=common/footer/subscriber',
		type: 'post',
		data: 'email='+email,
		dataType: 'json',
		beforeSend: function() { 
		/*$('#sub_email').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');*/
		},
		complete: function() {
			$('.wait').remove(); 
		},			
		success: function(json) { 
			//$("#subscribe_field").remove(); 
			if(json['success']==0){
			 $("#error_subscribe").html('Email address already exists !');
		}
		else if(json['success']==2){
			$("#error_subscribe").html('Error in subscription!');
		}
		else if(json['success']==1){
			$("#subscribe_msg").html('<span class="subscribe_msg">Sucessfully subscribe!</span>');
		}
		},
		error: function(xhr, ajaxOptions, thrownError) {   
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
		});  
	});
	$(document).ready(function(e) {
		$('.responsiveCat button').click(function(e) {
			$('#column-left').removeClass('hidden-xs');		
			$('.category-sec .panel-group').slideToggle(700);
		});	
	});
 
</script> 
<script src="https://apis.google.com/js/platform.js" async defer></script>

<?php if (isset($_GET['path']) && trim($_GET['path']) == '115_118')  { ?>
<!-- Google Code for Adwords Tracking - LED Driving Lights - Pro-Vision-Lighting Conversion Page --> <script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1046724351;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "1zmPCN69tmsQ__2O8wM"; var google_conversion_value = 100.00; var google_conversion_currency = "AUD"; var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript"  
src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt=""  
src="//www.googleadservices.com/pagead/conversion/1046724351/?value=100.00&amp;currency_code=AUD&amp;label=1zmPCN69tmsQ__2O8wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<?php } ?>
<?php if (isset($is_product)) { ?>
<script src="https://apis.google.com/js/platform.js?onload=renderBadge" async defer></script>

<script>
  window.renderBadge = function() {
    var ratingBadgeContainer = document.createElement("div");
    document.body.appendChild(ratingBadgeContainer);
    window.gapi.load('ratingbadge', function() {
      window.gapi.ratingbadge.render(ratingBadgeContainer, {"merchant_id": 114170849});
    });
  }
</script>
<?php } ?>
</body></html>
var ribarray = ["bganycombi_rib1", "bganycombi_rib2", "bganycombi_rib3", "bganycombi_rib4", "bganycombi_rib5", "bganycombi_rib6", "bganycombi_rib7", "bganycombi_rib8"];
var bganycombiJson = '';
var bganycombi = {
	'getrand': function() {
		ribrandom = Math.floor(Math.random() * ribarray.length);
		return ribarray[ribrandom];
	},
	'setpophtml': function(bganycombi_id, title, htmldata) {		
		var pophtml = '<div id="showofferat2_bganycombi'+bganycombi_id+'" class="modal fade" role="dialog"> <div class="modal-dialog modal-lg"> <div class="modal-content">';
		pophtml += '<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4>'+title+'</h4> </div>';
		pophtml += '<div class="modal-body">'+htmldata+'</div>';
		pophtml += '</div></div></div>';
		$('body').append(pophtml);
	},
	'applyrib': function(json) {
 		$("[onclick*='cart.add']").each(function() {
			var target = $(this).closest('.columnOuter');
			var product_id = $(this).attr('onclick').match(/[0-9]+/).toString(); 
 			var cnt = -1;
			$.each(json['prodlist'], function(bganycombi_id,val) {
  				if('products' in val || 'allflag' in val) {
  					val['products'] = val['products'] ? val['products'].toString().split(',') : false;
					val['exproducts'] = val['exproducts'] ? val['exproducts'].toString().split(',') : false;
					val['allflag'] = val['allflag'] ? val['allflag'] : false;
					
					if ((val['exproducts'] == false || val['exproducts'].indexOf(product_id) < 0) && (val['products'].indexOf(product_id) >= 0 || val['allflag'] == 1)) {
						target.find('.bganycombi'+bganycombi_id).remove();
						cnt = cnt+1; if(cnt==8) { cnt = 1;}
						if(val['ribdisp'].length) { 
							target.addClass('bganycombbtn').find('.price').after('<div bganycombi_id="'+bganycombi_id+'" class="'+ribarray[cnt]+' bganycombi'+bganycombi_id+'">'+val['ribdisp']+'</div>');
						}
					}									 
				}
			});
		});
	},
	'prodpage': function(json) {
		var product_id = false;
		if($("input[name='product_id']").length) {
			var product_id = $("input[name='product_id']").val().toString();
		}		
		if (product_id) {
			var target = $('.largethumb');
  			var cnt = -1;
			$.each(json['prodlist'], function(bganycombi_id,val) {
  				if('products' in val || 'allflag' in val) {
					val['products'] = val['products'] ? val['products'].toString().split(',') : false;
					val['exproducts'] = val['exproducts'] ? val['exproducts'].toString().split(',') : false;
					val['allflag'] = val['allflag'] ? val['allflag'] : false;
					
					if ((val['exproducts'] == false || val['exproducts'].indexOf(product_id) < 0) && (val['products'].indexOf(product_id) >= 0 || val['allflag'] == 1)) {
						target.find('.bganycombi'+bganycombi_id).remove();
 						cnt = cnt+1; if(cnt==8) { cnt = 1;}
						if(val['ribdisp'].length) { 
							target.addClass('bganycombbtn').prepend('<div bganycombi_id="'+bganycombi_id+'" class="'+ribarray[cnt]+' bganycombi'+bganycombi_id+'">'+val['ribdisp']+'</div>');
						}
						
						var offer_heading = val['offer_heading'];
 						var offer_content = val['offer_content'];
 						
						if(val['showofferat'] == 1) {
							$('.product-spl-price').after('<div class="panel showofferat1_bganycombi'+bganycombi_id+'"><h4>' + offer_heading + '</h4>'+offer_content+'</div>');
						}
						if(val['showofferat'] == 2) {
							$('#button-cart').parent().after('<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showofferat2_bganycombi'+bganycombi_id+'">'+offer_heading+'</button>');
							bganycombi.setpophtml(bganycombi_id, offer_heading, offer_content);
						}
						if(val['showofferat'] == 3) {
							$('nav.tabs').before('<div class="panel showofferat3_bganycombi'+bganycombi_id+'"><h4>' + offer_heading + '</h4>'+offer_content+'</div>');
						}
						if(val['showofferat'] == 4) {
							$('nav.tabs ul').append('<li><a href="#tab-showofferat4_bganycombi'+bganycombi_id+'" data-toggle="tab">'+offer_heading+'</a></li>');
							$('nav.tabs').after('<section class="item" id="tab-showofferat4_bganycombi'+bganycombi_id+'"><div class="item-content">'+offer_content+'</div></section>');
							tabControl();
						}
					}									 
				}
			});
		}
	},
	'initjson': function() {
		$.ajax({
			url: 'index.php?route=extension/bganycombi/getcache',
			dataType: 'json',
			cache: true,
			success: function(json) {
				if(json) {
					bganycombiJson = json;
					bganycombi.applyrib(json);
					bganycombi.prodpage(json);
					$(document).ajaxStop(function(){ bganycombi.applyrib(json); });
				}
			}
 		});
	}	
}
$(document).ready(function() {
bganycombi.initjson();
});
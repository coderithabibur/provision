var bganycombi = {	
	'setCookie': function(name,value,days) {
		var expires = "";
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days*24*60*60*1000));
			expires = "; expires=" + date.toUTCString();
		}
		document.cookie = name + "=" + (value || "")  + expires + "; path=/";
	},
	'getCookie': function(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	},
	'removeCookie': function(name) {
		document.cookie = name+'=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
	},
	'loadajaxprocatmanu': function(target, route) {
		token = bganycombi.geturlparam('token');
		
		$('input[name=\'filter_'+target+'_name\']').autocomplete({
			'source': function(request, response) {
				$.ajax({
					url: 'index.php?route=catalog/'+route+'/autocomplete&token='+token+'&filter_name=' +  encodeURIComponent(request),
					dataType: 'json',
					success: function(json) {
						response($.map(json, function(item) {
							return {
								label: item['name'],
								value: item[''+route+'_id']
							}
						}));
					}
				});
			},
			'select': function(item) {
				$('input[name=\'filter_'+target+'_name\']').val(item['label']);
				$('input[name=\'filter_'+target+'_id\']').val(item['value']);
			}
		});
	},
	'dofilter': function() {		
		token = bganycombi.geturlparam('token');
		
		$('#button-filter').on('click', function() {
			var url = 'index.php?route=extension/bganycombi&token='+token;
		
			var filter_ribbontext = $('input[name=\'filter_ribbontext\']').val();
			if (filter_ribbontext) {
				url += '&filter_ribbontext=' + encodeURIComponent(filter_ribbontext);
			}
			
			var filter_disctype = $('select[name=\'filter_disctype\']').val();
			if (filter_disctype != '') {
				url += '&filter_disctype=' + encodeURIComponent(filter_disctype);
			} 
			
			var filter_discount = $('input[name=\'filter_discount\']').val();
			if (filter_discount) {
				url += '&filter_discount=' + encodeURIComponent(filter_discount);
			}
			
			var filter_buyqty = $('input[name=\'filter_buyqty\']').val();
			if (filter_buyqty) {
				url += '&filter_buyqty=' + encodeURIComponent(filter_buyqty);
			}
			
			var filter_getqty = $('input[name=\'filter_getqty\']').val();
			if (filter_getqty) {
				url += '&filter_getqty=' + encodeURIComponent(filter_getqty);
			}
			
			var filter_startdate = $('input[name=\'filter_startdate\']').val();
			if (filter_startdate) {
				url += '&filter_startdate=' + encodeURIComponent(filter_startdate);
			}
			
			var filter_enddate = $('input[name=\'filter_enddate\']').val();
			if (filter_enddate) {
				url += '&filter_enddate=' + encodeURIComponent(filter_enddate);
			}
			
			var filter_status = $('select[name=\'filter_status\']').val();
			if (filter_status != '') {
				url += '&filter_status=' + encodeURIComponent(filter_status);
			}
		 
			var filter_customer_group_id = $('select[name=\'filter_customer_group_id\']').val();
			if (filter_customer_group_id != '') {
				url += '&filter_customer_group_id=' + encodeURIComponent(filter_customer_group_id);
			}
			
			var filter_store_id = $('select[name=\'filter_store_id\']').val();
			if (filter_store_id != '') {
				url += '&filter_store_id=' + encodeURIComponent(filter_store_id);
			} 
			 
			var filter_buyproduct_name = $('input[name=\'filter_buyproduct_name\']').val();
			var filter_buyproduct_id = $('input[name=\'filter_buyproduct_id\']').val();
			if (filter_buyproduct_name && filter_buyproduct_id) {
				url += '&filter_buyproduct_name=' + encodeURIComponent(filter_buyproduct_name);
				url += '&filter_buyproduct_id=' + encodeURIComponent(filter_buyproduct_id);
			} 
		
			var filter_buycategory_name = $('input[name=\'filter_buycategory_name\']').val();
			var filter_buycategory_id = $('input[name=\'filter_buycategory_id\']').val();
			if (filter_buycategory_name && filter_buycategory_id) {
				url += '&filter_buycategory_name=' + encodeURIComponent(filter_buycategory_name);
				url += '&filter_buycategory_id=' + encodeURIComponent(filter_buycategory_id);
			} 
			
			var filter_buymanufacturer_name = $('input[name=\'filter_buymanufacturer_name\']').val();
			var filter_buymanufacturer_id = $('input[name=\'filter_buymanufacturer_id\']').val();
			if (filter_buymanufacturer_name && filter_buymanufacturer_id) {
				url += '&filter_buymanufacturer_name=' + encodeURIComponent(filter_buymanufacturer_name);
				url += '&filter_buymanufacturer_id=' + encodeURIComponent(filter_buymanufacturer_id);
			}
			
			var filter_exbuyproduct_name = $('input[name=\'filter_exbuyproduct_name\']').val();
			var filter_exbuyproduct_id = $('input[name=\'filter_exbuyproduct_id\']').val();
			if (filter_exbuyproduct_name && filter_exbuyproduct_id) {
				url += '&filter_exbuyproduct_name=' + encodeURIComponent(filter_exbuyproduct_name);
				url += '&filter_exbuyproduct_id=' + encodeURIComponent(filter_exbuyproduct_id);
			} 
		
			var filter_exbuycategory_name = $('input[name=\'filter_exbuycategory_name\']').val();
			var filter_exbuycategory_id = $('input[name=\'filter_exbuycategory_id\']').val();
			if (filter_exbuycategory_name && filter_exbuycategory_id) {
				url += '&filter_exbuycategory_name=' + encodeURIComponent(filter_exbuycategory_name);
				url += '&filter_exbuycategory_id=' + encodeURIComponent(filter_exbuycategory_id);
			} 
			
			var filter_exbuymanufacturer_name = $('input[name=\'filter_exbuymanufacturer_name\']').val();
			var filter_exbuymanufacturer_id = $('input[name=\'filter_exbuymanufacturer_id\']').val();
			if (filter_exbuymanufacturer_name && filter_exbuymanufacturer_id) {
				url += '&filter_exbuymanufacturer_name=' + encodeURIComponent(filter_exbuymanufacturer_name);
				url += '&filter_exbuymanufacturer_id=' + encodeURIComponent(filter_exbuymanufacturer_id);
			}
			
			var filter_getproduct_name = $('input[name=\'filter_getproduct_name\']').val();
			var filter_getproduct_id = $('input[name=\'filter_getproduct_id\']').val();
			if (filter_getproduct_name && filter_getproduct_id) {
				url += '&filter_getproduct_name=' + encodeURIComponent(filter_getproduct_name);
				url += '&filter_getproduct_id=' + encodeURIComponent(filter_getproduct_id);
			} 
		
			var filter_getcategory_name = $('input[name=\'filter_getcategory_name\']').val();
			var filter_getcategory_id = $('input[name=\'filter_getcategory_id\']').val();
			if (filter_getcategory_name && filter_getcategory_id) {
				url += '&filter_getcategory_name=' + encodeURIComponent(filter_getcategory_name);
				url += '&filter_getcategory_id=' + encodeURIComponent(filter_getcategory_id);
			} 
			
			var filter_getmanufacturer_name = $('input[name=\'filter_getmanufacturer_name\']').val();
			var filter_getmanufacturer_id = $('input[name=\'filter_getmanufacturer_id\']').val();
			if (filter_getmanufacturer_name && filter_getmanufacturer_id) {
				url += '&filter_getmanufacturer_name=' + encodeURIComponent(filter_getmanufacturer_name);
				url += '&filter_getmanufacturer_id=' + encodeURIComponent(filter_getmanufacturer_id);
			}
			
			var filter_exgetproduct_name = $('input[name=\'filter_exgetproduct_name\']').val();
			var filter_exgetproduct_id = $('input[name=\'filter_exgetproduct_id\']').val();
			if (filter_exgetproduct_name && filter_exgetproduct_id) {
				url += '&filter_exgetproduct_name=' + encodeURIComponent(filter_exgetproduct_name);
				url += '&filter_exgetproduct_id=' + encodeURIComponent(filter_exgetproduct_id);
			} 
		
			var filter_exgetcategory_name = $('input[name=\'filter_exgetcategory_name\']').val();
			var filter_exgetcategory_id = $('input[name=\'filter_exgetcategory_id\']').val();
			if (filter_exgetcategory_name && filter_exgetcategory_id) {
				url += '&filter_exgetcategory_name=' + encodeURIComponent(filter_exgetcategory_name);
				url += '&filter_exgetcategory_id=' + encodeURIComponent(filter_exgetcategory_id);
			} 
			
			var filter_exgetmanufacturer_name = $('input[name=\'filter_exgetmanufacturer_name\']').val();
			var filter_exgetmanufacturer_id = $('input[name=\'filter_exgetmanufacturer_id\']').val();
			if (filter_exgetmanufacturer_name && filter_exgetmanufacturer_id) {
				url += '&filter_exgetmanufacturer_name=' + encodeURIComponent(filter_exgetmanufacturer_name);
				url += '&filter_exgetmanufacturer_id=' + encodeURIComponent(filter_exgetmanufacturer_id);
			}
			
			location = url;
		});
	},
	'chkcolumn': function() {
		$('.chkcolumn').each(function() {
			var name = $(this).attr('data-str');
			$(this).click(function() {
				if($(this).is(':checked')) {
					bganycombi.setCookie(name, '1', 7);
					$('.fil'+name).show();
					$('.col'+name).show();
				} else {
					bganycombi.removeCookie(name);
					$('.fil'+name).hide();
					$('.col'+name).hide();
				}
			});	
			
			if (bganycombi.getCookie(name)) {
				$(this).prop("checked",true);
			} else {
				$(this).prop("checked",false);
			} 
			
			if($(this).is(':checked')) {
				$('.fil'+name).show();
				$('.col'+name).show();
			} else {
				$('.fil'+name).hide();
				$('.col'+name).hide();
			}
		});
	},
	'geturlparam': function(name) {
		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	    return results[1] || 0;
	},
	'save': function(thisvar, id, status) {
		token = bganycombi.geturlparam('token');
		if(token) { 
			$.ajax({
				url: 'index.php?route=extension/bganycombi/savestatus&token='+token,
				type: 'post',
				data : { id : id, status : status },
				dataType: 'json',
			});
		}
	},
	'initjson': function() {
		$('.chkstatus').each(function() {
			$(this).click(function() {
				var prodid = parseInt($(this).attr('data-str'));
				if($(this).is(':checked')) {
 					bganycombi.save($(this), prodid, 1);
				} else {
 					bganycombi.save($(this), prodid, 0);
				}
			});	
		});
	}
}
$(document).ready(function() {
	bganycombi.initjson();
	
	$('.dropdown-menu').click(function (e) { e.stopPropagation(); });
 	$('.date').datetimepicker({pickTime: false});
	
	bganycombi.loadajaxprocatmanu('buyproduct', 'product');
	bganycombi.loadajaxprocatmanu('exbuyproduct', 'product');
	bganycombi.loadajaxprocatmanu('buycategory', 'category');
	bganycombi.loadajaxprocatmanu('exbuycategory', 'category');	
	bganycombi.loadajaxprocatmanu('buymanufacturer', 'manufacturer');
	bganycombi.loadajaxprocatmanu('exbuymanufacturer', 'manufacturer');
	
	bganycombi.loadajaxprocatmanu('getproduct', 'product');
	bganycombi.loadajaxprocatmanu('exgetproduct', 'product');
	bganycombi.loadajaxprocatmanu('getcategory', 'category');
	bganycombi.loadajaxprocatmanu('exgetcategory', 'category');	
	bganycombi.loadajaxprocatmanu('getmanufacturer', 'manufacturer');
	bganycombi.loadajaxprocatmanu('exgetmanufacturer', 'manufacturer');
	
	bganycombi.dofilter();
	
	bganycombi.chkcolumn();
});
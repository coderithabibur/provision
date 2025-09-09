var bganycombi = {		
	'loadajaxprocatmanu': function(inptname, typeset) {
		token = bganycombi.geturlparam('token');
		
		$('input[name=\''+inptname+'\']').autocomplete({
			source: function(request, response) {
				$.ajax({
					url: 'index.php?route=catalog/'+typeset+'/autocomplete&token='+token+'&filter_name=' +  encodeURIComponent(request),
					dataType: 'json',
					success: function(json) {
						response($.map(json, function(item) {
							return {
								label: item['name'],
								value: item[''+typeset+'_id']
							}
						}));
					}
				});
			},
			select: function(item) {
				$('input[name=\''+inptname+'\']').val('');
				
				$('#'+inptname+ item['value']).remove();
				
				$('#'+inptname).append('<div id="'+inptname+'-' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="'+inptname+'[]" value="' + item['value'] + '" /></div>');	
			}
		});
			
		$('#'+inptname).delegate('.fa-minus-circle', 'click', function() {
			$(this).parent().remove();
		}); 
	},
	'allownum': function() { 
		$('input[name*="discount"]').keydown(function(e) {
			var key = e.charCode || e.keyCode || 0;
			// allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
			// home, end, period, and numpad decimal
			return ( key == 8 || key == 9 || key == 13 || key == 46 || key == 110 || key == 190 || (key >= 35 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
		});
	},
	'geturlparam': function(name) {
		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	    return results[1] || 0;
	}
}
$(document).ready(function() {
	$('.date').datetimepicker({pickTime: false});
	
	$('#discount').attr('style', 'visibility: hidden');
    if($("input[name='disctype']:checked").val() == 2 || $("input[name='disctype']:checked").val() == 3) { 
		$('#discount').attr('style', 'visibility: visible');
	}
	$("input[name='disctype']").change(function() {
		if (this.value == 2 || this.value == 3) {
			$('#discount').attr('style', 'visibility: visible');
		} else {
			$('#discount').attr('style', 'visibility: hidden');
		}
	});
	
	bganycombi.allownum();
  	
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
});
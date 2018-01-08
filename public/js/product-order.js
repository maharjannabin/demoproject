$(function() {

	$(document).on('change', '#sales-add-form #product_id, #sales-add-form #product_size',  function() {
		var product_id 	= $('option:selected','#sales-add-form #product_id').val();
		var size_id 	= $('option:selected', '#sales-add-form #product_size').val();


		var href 		= APP_URL+'/sales/product-detail/'+'id/'+product_id+'/size/'+size_id;

		if (product_id != '' && size_id != '') {
			$.ajax({
				type	: 'GET',
				url		: href,
				dataType: 'JSON',
				success : function(response) {
					console.log(response.response.price);
					if(response.status)
						$('#sales-add-form #sub_total').val(response.response.price);
				} 	

			});
		}

		 
	});
})



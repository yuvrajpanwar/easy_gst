$(function(){
	$("#type").change(function(){
		var type=$("#type").val();
				var data='ty=' + type;
		// alert("hello");
			$.ajax({
					url: 'type-handler.php',
					type: 'POST',
					data: data,
					cache: false,
					async:false,
					success: function(html)
					{
						//alert(html);
						if(html)
						{
							// alert(html);
							$("#link_id").html(html);
						}
					}
				});
	
	});	

});				
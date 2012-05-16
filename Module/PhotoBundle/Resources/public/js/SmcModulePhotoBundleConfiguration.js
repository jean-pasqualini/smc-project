		$("fieldset.modulePhoto form").submit(function() {
			var block = $(this).parents("div.block:first");
			
			$.ajax($(this).attr("action"),
				{
					type: "POST",
					data: $(this).serialize(),
					dataType: "json",
					context: this,
					success: function(data)
					{
						if(data.message != undefined)
						{
							alert(data.message);
						}
						else
						{
							//alert(data.image_url);
							$(block).find("div.modulePhoto img")
							.attr("src", "/" + data.image_url);
							// .attr("width", $(this).find("input").val())
							// .attr("height", $(this).find("input").val();
							Smc.afficherModule(block);
						}					
						
					}
				});
			
			return false;
		});
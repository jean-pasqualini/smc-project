/**
 * @author john
 */
$(document).ready(function() {
		$("fieldset.moduleMenus form").submit(function() {
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
							/*
							$(block)
							.find("div.article-list div.article h3.article-titre")
							.css("background", "#" + $(this).find("input.TitleBackgroundColor").val())
							.css("color", "#" + $(this).find("input.TitlesTextColor").val());
							*/
							
							Smc.afficherModule(block);
						}					
						
					}
				});
			
			return false;
		});
		
		$("fieldset.moduleMenus input.color").ColorPicker({
			livePreview: true,
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onChange: function (hsb, hex, rgb, el) {
				$(el).css("background", "#" + hex);
				
			}
		});
});
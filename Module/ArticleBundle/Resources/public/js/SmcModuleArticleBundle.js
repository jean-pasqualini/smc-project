/**
 * @author john
 */
$(document).ready(function() {
		$("fieldset.articles form").submit(function() {
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
							$(block)
							.find("div.article-list div.article h3.article-titre")
							.css("background", "#" + $(this).find("input.TitleBackgroundColor").val())
							.css("color", "#" + $(this).find("input.TitlesTextColor").val());
							
							Smc.afficherModule(block);
						}					
						
					}
				});
			
			return false;
		});
		
		$("fieldset.articles input.color").ColorPicker({
			livePreview: true,
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onChange: function (hsb, hex, rgb, el) {
				$(el).css("background", "#" + hex);
				
			}
		});
		
	$('.edit').editable('http://www.example.com/save.php', {
         indicator : 'Saving...',
         tooltip   : 'Click to edit...'
     });
     $('.edit_area').editable('http://www.example.com/save.php', { 
         type      : 'textarea',
         cancel    : 'Cancel',
         submit    : 'OK',
         indicator : '<img src="img/indicator.gif">',
         tooltip   : 'Click to edit...'
     });
});
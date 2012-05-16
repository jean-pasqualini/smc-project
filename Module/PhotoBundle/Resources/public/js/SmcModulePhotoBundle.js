/**
 * @author john
 */

$(document).ready(function() {	
		$("div.modulePhoto input[type=file]").droparea({
				'instructions': 'Placer votre image ici',
				'over' : 'Lachez votre image',
                'init' : function(result){
                    //console.log('custom init',result);
                },
                'start' : function(area){
                    area.find('.error').remove(); 
                },
                'error' : function(result, input, area){
                    $('<div class="error">').html(result.error).prependTo(area); 
                    return 0;
                    //console.log('custom error',result.error);
                },
                'complete' : function(result, file, input, area){
                    if((/image/i).test(file.type)){
                        //area.data('value',result.filename);
                        $(area).parent("div.modulePhoto").find("img").attr("src", result.path + result.filename + '?' + Math.random());
                    } 
                    //console.log('custom complete',result);
                }
		});

	
	$("div.modulePhoto img").resizable({
		autoHide: true,
		containment: 'parent',
		stop: function(event, ui)
		{
			$.ajax($(this).children("img").attr("actionResize"),
			{
				type: "POST",
				data: { largeur: $(this).children("img").width(), hauteur: $(this).children("img").height() },
				dataType: "json",
				context: $(this).children("img"),
				success: function(data)
				{
					if(data.message != undefined)
					{
						alert(data.message);
					}
				}
			});
		}
	});
});

$(document).ready(function() {
	
	$("ul.menu li.parent.inedit a").each(function(index, item) {
		$(item).editable($(item).attr("actionEdit"));
	});
	
	$("ul.menu li.add-item-menu").click(function() {
		$(this).before(
			$("<li></li>").append(
					$("<a/>").html("nouveau")
			).addClass('parent editable')
		);
		
			$.ajax($(this).attr("actionAdd"),
			{
				type: "POST",
				data: {},
				dataType: "json",
				context: this,
				success: function(data)
				{
					if(data.message != undefined)
					{
						alert(data.message);
					}
				}
			});
		
		return false;
	});
	/*
	$("ul.menu").sortable({
		item: " > li.parent.inedit",
		axis: "x",
		placeholder: "ui-state-highlight parent inedit",
		update: function(event, ui){
			console.log($("ui.menu").sortable("serialize"));
		}
	});
	*/
	
	/*
	$("ul.menu li.parent.inedit").draggable({
		
	});
	*/

});

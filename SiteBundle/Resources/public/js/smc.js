/**
 * @author john
 */

   // Api static de smc
	
var Smc = function() {}

$(document).ready(function() {
/*
	$("div#manage-modules").dialog({
		dialogClass: "manageModules",
		resizable: false,
		revert: true,
		position: ["left", "top"]
	});
	
	$("div#toolbar-modules").dialog({
		resizable: false,
		position: ["left", "top"]
	});
*/

	$("div#toolbar-modules h3").hover(function() {
		$("div#voile").show();
		$("div.block[placementId=" + $(this).attr("placementId") + "]").addClass("isolate");
	},
	function() {
		$("div#voile").hide();
		$("div.block[placementId=" + $(this).attr("placementId") + "]").removeClass("isolate");
	});
	
	/*
	$("div.block,li.block").draggable({
		"cursor" : "move",
		"handle" : "div.block-config",
		revert: true
	});
	
	$("div.conteneur-blocks").droppable({
		drop: function(event, ui)
		{
			$(this).append(ui);
		}
	});
	*/
	
	$("div.block-config button.color").ColorPicker({
		livePreview: true,
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).ColorPickerHide();
			$.ajax($(el).attr("action"),
				{
					type: "POST",
					data: {color : hex},
					dataType: "json",
					success: function(data)
					{
						if(data.message != undefined)
						{
							alert(data.message);
						}
					} 	
				}	
			);
		},
		onChange: function (hsb, hex, rgb, el) {
			$(el).css("background", "#" + hex);
			$("div.block[placementId="+ $(el).parent("div.block-config").attr("placementId") +"]").children("div.block-contents").css("background", "#" + hex);
			
		}
	});
	
/*
	$("div.block-accept").sortable({
		//handle: "div.block-titre",
		items: "li.block",
		placeholder: "placing span-12",
		connectWith: "div.conteneur-blocks",
		receive: function(event, ui) {
			var conteneur = $(this).parents("div.conteneur-blocks:first");
			var position = $(conteneur).attr("id");
			var href = $(ui.item).attr("actionMove");
			$.ajax(href,
			{
				type: "POST",
				data: { position: position },
				dataType: "json",
				success: function(data)
				{
					if(data.message != undefined)
					{
						alert(data.message);
					}
				}
			});
		},
		update: function(event, ui) {
					var conteneur = $(ui.item).parents("div.conteneur-blocks:first");
					var ordre = $(ui.item).parents("div.block-accept:first").sortable("serialize");
					var href = $(conteneur).attr("actionOrdreModules");
        			$.ajax(href,
					{
						type: "POST",
						data: ordre,
						dataType: "json",
						success: function(data)
						{
							if(data.message != undefined)
							{
								alert(data.message);
							}
						}
					});
		}
	})
*/
	
	$("div#corbeille-modules").droppable({
		drop: function(event, ui)
		{
			$(ui.draggable).hide("explode");
		}
	});
	
	$("div.conteneur-blocks").droppable({
		greedy: true,
		accept: "div.block, li.module-type",
		drop: function(event, ui)
		{		
			var position = $(this).attr("id");
			var href = $(ui.draggable ).attr("actionMove");
			
			if($(this).hasClass("add"))
			{
				$(ui.draggable).clone().appendTo(this);
			}
			
			$.ajax(href,
			{
				type: "POST",
				data: { position: position },
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
		}
	});
	
	
	$("div.block").draggable({
		connectToSortable: "div.block-accept",
		handle: "div.block-titre",
		cursor: "move",
		revert: true,
		zindex: 51
	}).disableSelection();
	
	$("li.module-type").draggable({
		start: function(event, ui)
		{
			$("div.block-accept").css("display", "block");
		},
		stop: function(event, ui)
		{
			$("div.block-accept").css("display", "none");
		},
		helper: "clone",
		connectToSortable: "div.block-accept",
		handle: "h3.block-title",
		cursor: "move",
		revert: true
	}).disableSelection();
/*
	$("div.conteneur-blocks").selectable({
		filter: "div.block",
		selected: function(event, ui) {

		},
		selecting: function(event, ui) {
			$(ui.selecting).addClass("selected");
		},
		unselected: function(event, ui) {
			$(ui.selected).removeClass("selected");
		},
		unselecting: function(event, ui) {
			$(ui.selecting).removeClass("selected");
		}
	});
*/
   Smc.onModuleResize = function(nombre_colonne, block) {
	   	console.log("vous êtes en " + nombre_colonne + " colonne(s)");
	   		$.ajax($(block).attr("actionResize"),
			{
				type: "POST",
				data: { nombrecolonne: nombre_colonne },
				dataType: "json",
				context: block,
				success: function(data)
				{
					if(data.message != undefined)
					{
						alert(data.message);
					}
				}
			});
   }
   
   Smc.afficherModule = function(block)
   {
		$(block).children("div.block-contents").children("div.block-content.affichage").slideDown(null);
		$(block).children("div.block-contents").children("div.block-content.configuration").slideUp(null);
   }

   Smc.ordreModule = function(conteneur)
   {
	   	var retour = "";
		
		$(conteneur).find("div.block").each(function(key, index) {
		  retour += "placement["+$(index).attr("placementId")+"]="+key;
		});
		
		return retour;
   }
	
   Smc.getBlock = function(courant)
   {
   		return $("div.block[placementId=" + $(courant).parents("div.block-config:first").attr("placementId") + "]:first");
   }
	
   $("div.conteneur-blocks div.block.inedit,div.conteneur-blocks li.block").resizable({
   	 grid: [40, 40],
   	 handles: "e",
   	 start: function(event, ui)
   	 {
   	 	$(this)
   	 	.children("div.block-contents")
   	 	.addClass("showgrid")
   	 	.children("div.block-content")
   	 	.css("opacity", "0.5");
   	 },
   	 resize: function(event, ui)
   	 {
   	 	 var nombre_colonne = (($(this).width()/40) + 0.25);
   	 },
   	 stop: function(event, ui)
   	 {
   	 	var nombre_colonne = (($(this).width()/40) + 0.25);

   	 	if(nombre_colonne <= 24)
   	 	{   	 		
   	 		Smc.onModuleResize(nombre_colonne, this);
   	 	}
   	 	else
   	 	{
   	 		
   	 	}
   	 	
   	 	$(this)
   	 	.children("div.block-contents")
   	 	.removeClass("showgrid")
   	 	.children("div.block-content")
   	 	.css("opacity", "1.0");
   	 }
   });
   
   $("div#toolbar-modules").accordion({
   	 autoHeight: false,
   	 collapsible: true
   });
   			
	$("button.color").button({
		icons: {
			primary: "color",
			secondary: "ui-icon-triangle-1-s"
		},
		text: false,
	});
	/*
	$("button.prepend").button({
		icons: {
			primary: "ui-icon-arrowstop-1-w",
			secondary: "ui-icon-triangle-1-s"
		}
	});
	*/
	$("button.block-export-window-config").button({
		icons: {
			primary: "ui-icon-arrowstop-1-w",
			secondary: null
		},
		text: false
	}).click(function() {
		$("div#manage-modules-conteneur").animate({ left: 0 });
		$("div#toolbar-modules").accordion("activate", parseInt($("div#toolbar-modules h3[placementId=" + $(this).parents("div.block:first").attr("placementId") + "]").attr("index"))-1);
	});
	
	$("button.prepend ul li a").click(function() {
		var action = $(this).parents("button.prepend:first").attr("action");
		
		$.ajax(action,
			{
				type: "POST",
				data: { nombrecolonne: $(this).attr("colonne") },
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
						$(Smc.getBlock(this)).addClass("prepend-" + $(this).attr("colonne"));
					}
				}
			});
	});
	
	$("button.append").button({
		icons: {
			primary: "ui-icon-arrowstop-1-e",
			secondary: "ui-icon-triangle-1-s"
		}
	});
	
	$("button.append ul li a").click(function() {
		var action = $(this).parents("button.append:first").attr("action");
		
		$.ajax(action,
			{
				type: "POST",
				data: { nombrecolonne: $(this).attr("colonne") },
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
						$(Smc.getBlock(this)).addClass("append-" + $(this).attr("colonne"));
					}
				}
			});
	});
	
	$("button.config").button({
		icons: {
			primary: "ui-icon-gear",
			secondary: "ui-icon-triangle-1-s"
		}
	}).click(function() {
		$(this).children("ul").show();
	});
	
	$("button.block-personalise-design").button({
		icons: {
			primary: "ui-icon-gear",
			secondary: null
		}
	});
	
	// L'orsque le bouton radio float on est cliqué alors on éxecute la fonction anonyme
	$("input[type=radio].button.float.on").click(function() {
		if(!$(this).parent("div.block").hasClass('last')) return;
			$.ajax($(this).attr("href"),
			{
				type: "POST",
				data: { isFloat: true },
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
						$(Smc.getBlock(this)).removeClass("last");
					}
				}
			});

	});
	
	// L'orsque le bouton radio float off est cliqué alors on éxecute la fonction anonyme
	$("input[type=radio].button.float.off").click(function() {
		if($(this).parent("div.block").hasClass('last')) return;
		
			$.ajax($(this).attr("href"),
			{
				type: "POST",
				data: { isFloat: false },
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
						var block = $(Smc.getBlock(this)).addClass('last');
					}
				}
			});

	});
	
	$("input[type=checkbox].button.margin.top").click(function() {
			$.ajax($(this).attr("href"),
			{
				type: "POST",
				data: { isMarginTop: true },
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
						var block = $(Smc.getBlock(this)).addClass('last');
					}
				}
			});
	});
	
	$("input[type=checkbox].button.margin.bottom").click(function() {
			$.ajax($(this).attr("href"),
			{
				type: "POST",
				data: { isMarginBottom: $(this).is(":checked") },
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
						var block = $(Smc.getBlock(this)).addClass('last');
					}
				}
			});
	});
	
	$("div.block a.action.delete").click(function() {
		if(!confirm("Etes vous sur de vouloir supprimer ce module ?")) return false;
			$.ajax($(this).attr("href"),
			{
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
						Smc.getBlock(this).fadeOut().remove();
						$(this).parents("div.toolbar-module:first").fadeOut().remove();
					}
				}
			});
		return false;
	});
	
	$("div.block a.action.configurer").click(function() {	
		var block = $("div.block[placementId=" + $(this).parents("div.block-config:first").attr("placementId") + "]");
			
		if($(block).children("div.block-contents").children("div.block-content.configuration").html() == "")
		{
			$(block).children("div.block-contents").children("div.block-content.configuration").html($.ajax($(this).attr("href"), { async: false }).responseText);
		}
			
		$(block).children("div.block-contents").children("div.block-content.affichage").slideUp(null);
		$(block).children("div.block-contents").children("div.block-content.configuration").slideDown(null);
			

		return false;
	});
	
	$("div.button-float input[type=radio].button.float.on").button({
		text: false,
		icons: {
			primary: "ui-icon-float-on"
		}
	});
	
	$("div.button-float input[type=radio].button.float.off").button({
		text: false,
		icons: {
			primary: "ui-icon-float-off"
		}
	});
	
	$("div.button-float").buttonset().disableSelection();
	
	$("div.button-margin input[type=checkbox].button.margin.top").button({
		text: false,
		icons: {
			primary: "ui-icon-arrowstop-1-n"
		}
	});
	
	$("div.button-margin input[type=checkbox].button.margin.bottom").button({
		text: false,
		icons: {
			primary: "ui-icon-arrowstop-1-s"
		}
	});
	
	$("div#manage-modules-conteneur div.show-hide").click(function() {
		if($(this).parent("div").css("left") != "-260px")
		{
			$(this).parent("div").animate({ left: -260 });
		}
		else
		{
			$(this).parent("div").animate({ left: 0 });
		}
	})
	
	$("div.button-margin").buttonset().disableSelection();
		
	$("div#manage-modules div#panel-left ul li").hover(function() {
		$("div#voile").show();
		
		$("div#manage-modules div.module-list li")
		.removeClass('full-view')
		.filter($(this).attr("show"))
		.addClass("full-view")
	});
	
	$("div#manage-modules div#panel-left ul").mouseleave(function() {
		$("div#voile").hide();
		
		$("div#manage-modules div.module-list li:visible").removeClass("full-view");
	});
	
	$("div#search-toolbar-modules input").bind("keyup", function() {
		
		if($(this).val().length == 0)
		{
			$("div.toolbar-module").hide();
			return;
		}
		
		$(".toolbar-module").show();
		$("h3.toolbar-module:not(:contains('" + $(this).val() + "'))").each(function(index, value) {
			$(value).hide().next().hide();
		});
	});
	
});

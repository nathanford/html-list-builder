// Marker JS

$(function () {
	
	initContent();
	
});

initContent = function () {
	
	// Dragging and dropping
	
	makedrag();
	
	makedrop(true);
	
	//makedrop('#list-favorites', false);
	
	// HTML output
	
	updateHTML();
	
	$(window).keydown(function (e) {
		
		if (e.which == 8 && $('.selected').length) {
			
			$('.selected').remove();
			
			updateHTML();
			
			prevent(e);
			
		}
		
	});
	
	$('#generate').click(function (e) {
		
		window.location.href = 'http://dev.artequalswork.com/builder/?markup=' + encodeURIComponent($('#text-html').text());
		
		prevent(e);
		
	});
	
	$('#validate').click(function (e) {
		
		window.location.href = 'http://validator.w3.org/check?uri=http://dev.artequalswork.com/builder/?markup=' + encodeURIComponent($('#text-html').text());
		
		prevent(e);
		
	});
	
	$('#cancel').click(function (e) {
		
		cancel();
		
		prevent(e);
		
	});
	
}

updateHTML = function () {

	//console.log(renderHTML());
	
	$('#body-render, #body-html').empty();
	
	renderHTML('body');
	
	writeHTML();
	
}

renderHTML = function (ele) {

	$('#' + ele + '-children').find('> .child').each(function () {
		
		var tag = this.dataset.tag,
				id = this.id,
				
				branches = $(this).find('> .children > .child'),
				
				content = (tag.match(/^(h[1-6]|p|li|dd|dt)$/)) ? this.title : '<!-- ' + id + ' -->',
				
				item = $('<' + tag + ' data-id="' + id + '" />').html( content );
		
		
		if (this.dataset.attrs) {
			
			eval('var attrs = {' + this.dataset.attrs + '};')
			
			item.attr(attrs);
		
		}
				
		$('#render [data-id=' + ele + ']').append( item );
		
		if (branches.length) renderHTML(this.id);

	});
	
	return 

}

writeHTML = function () {
	
	var rendered = $('#body-render').html();
	
	rendered = rendered.replace(/<![^\>]+>/g, " ")
											.replace(/</g, "\n&lt;")
											.replace(/\n&lt;\//g, "&lt;/")
											.replace(/>&lt;/g, "&gt;\n&lt;")
											.replace(/\s*data\-id\=\"[^\"]+\"/g, "");
	
	$('#body-html').append(rendered);
	
}

makedrag = function (t) {
	
	$('#elements li').draggable({
		
		items: '[data-tag]',
		appendTo: '#main',
		helper: 'clone',
		opacity: 0.5,
		revert: 'invalid',
		start: function (e, ui) {
			
			$('.ui-draggable-dragging').width($(this).width());
			
		}
		
	})
	
	
};

makedrop = function (sort) {
	
	$('#list-structure .children').droppable({
		
		accept: '[data-tag]',
		greedy: true,
		tolerance: 'pointer',
		
		over: function (e, ui) {
		
			$(this).closest('.child').addClass('open');
		
		},
		
		out: function (e, ui) {
		
			$(this).closest('.child').removeClass('open');
		
		},
		
		drop: function (e, ui) {
			
			var newitem = ($(ui.draggable).closest('#elements').length) ? true : false,
					item = (newitem) ? $(ui.draggable).clone() : $(ui.draggable),
					
					id = (newitem) ? item[0].dataset.tag + '-' + Math.floor((Math.random() * 1000) + 1) : item[0].id;
			
			if (newitem) {
			
				item.attr({
					'id': id,
					'class': 'list child'	
				}).append($('<ul id="' + id + '-children" class="children" />'))
				.click(function (e) {
					
					$('.selected').removeClass('selected');
					
					$(e.target).closest('.child').addClass('selected');
					
					$(document).unbind('click').click(function (e) {
						
						if (!$(e.target).closest('.child').length) $('.selected').removeClass('selected');
						
					});
					
				}).dblclick(function (e) {
				
					attrPrompt();
					
					prevent(e);
					
				});
				
				$(this).append( item );
				
				makedrop(true);
			
			}
			
			setTimeout(updateHTML, 10);
			
			$('.open').removeClass('open');
				
		}
	
	})
	
	if (sort) {
	
		$('#list-structure .children').sortable({
			
			item: '.child',
			connectWith: '.children',
			appendTo: '#main',
			containment: '#list-structure',
			helper: 'clone',
			opacity: 0.5,
			revert: false,
			sortend: function () {
				
				if ($(this).is('#list-structure')) updateHTML();
				
			}
			
		});
	
	}

};

attrPrompt = function () {
	
	$('#attrPrompt')[0].reset();
	
	$('#ele-selected').val($('.selected')[0].id);
	
	$('#attrPrompt').show();
	
	$('#ele-id')[0].focus();
	
	$('#attrPrompt').unbind('submit').submit(function (e) {
		
		$('#' + $('#ele-selected').val()).attr('data-attrs', "id:'" + $('#ele-id').val() + "',className:'" + $('#ele-class').val() + "',title:'" + $('#ele-title').val() + "'");
		
		updateHTML();
		
		cancel();
		
		prevent(e);
		
	});
	
}

cancel = function () {
	
	$('#attrPrompt')[0].reset();
	
	$('#attrPrompt').hide();
	
}

prevent = function (e) {

  if (e.preventDefault) e.preventDefault();
  else event.returnValue = false;
  
};
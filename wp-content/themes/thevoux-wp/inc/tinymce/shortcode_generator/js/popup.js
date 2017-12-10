jQuery(document).ready(function($){
   
    //init Thickbox
    
    ////stop the flash from happening
	$('#TB_window').css('opacity',0);
	
	function calcTB_Pos() {
		$('#TB_window').css({
	   	   'height': ($('#TB_ajaxContent').outerHeight() + 30) + 'px',
	   	   'top' : (($(window).height() + $(window).scrollTop())/2 - (($('#TB_ajaxContent').outerHeight()-$(window).scrollTop()) + 30)/2) + 'px',
	   	   'opacity' : 1
		});
	}
	
	setTimeout(calcTB_Pos,100);
	
	$(window).on('resize', calcTB_Pos);
  


	//The chosen one
	$("select#thb-shortcodes").chosen({width: "95%"});
    var ed = tinyMCE.activeEditor;
    
    function update_shortcode(){
		
			var name = $('#thb-shortcodes').val(),
				dataType = $('#options-'+name).data('type'),
				content = '';
			
			switch(name) {
				
				// Elements
				case 'quote':
					var align = $('input[name='+name+'-align]:checked').val() || '',
						author = $('input[id='+name+'-author]').val(),
						text = $('textarea[id='+name+'-content]').val();
					
					if (align != '') { var alignment = 'pull="'+align+'"'; } else { var alignment = '';}
					
					content = '[blockquote author="'+author+'" '+alignment+']'+text+'[/blockquote]';
				break;
				
				case 'thb_button':
					var size = $('input[name='+name+'-size]:checked').val() || 'small',
						animation = $('input[name='+name+'-animation]:checked').val() || '',
						icon = $('input[id='+name+'-icon]').val(),
						title = $('input[id='+name+'-title]').val(),
						link = $('input[id='+name+'-link]').val(),
						target_blank = $('input[id='+name+'-target_blank]:checked').length;
							
					if(target_blank) { var target_blank = 'target_blank="true"' } else { var target_blank = '' }
					
					content = '[thb_button caption="'+title+'" link="'+link+'" icon="'+icon+'" size="'+size+'" animation="'+animation+'" '+target_blank+' /]';
					
				break;
				
				case 'small_title':
					var title = $('input[id='+name+'-title]').val() || 'title';
					
					content = '[small_title title="'+title+'"]';
					
				break;
				
				case 'medium_title':
					var title = $('input[id='+name+'-title]').val() || 'title';
					
					content = '[medium_title title="'+title+'"]';
					
				break;
				
				case 'large_title':
					var title = $('input[id='+name+'-title]').val() || 'title';
					
					content = '[large_title title="'+title+'"]';
					
				break;
				
				case 'extra_large_title':
					var title = $('input[id='+name+'-title]').val() || 'title';
					
					content = '[extra_large_title title="'+title+'"]';
					
				break;
				
				case 'tags':
					var color = $('input[name='+name+'-color]:checked').val() || 'accent',
						text = $('input[id='+name+'-text]').val();
					
					content = '[tags color="'+color+'"]'+text+'[/tags]';
					
				break;
				
				case 'seperator':
					var style = $('input[name='+name+'-type]:checked').val() || 'style1',
						title = $('input[id='+name+'-title]').val() || 'Divider';
					
					content = '[seperator style="'+style+'"]'+title+'[/seperator]';
					
				break;
				
				case 'dropcap':
					var letter = $('input[id='+name+'-title]').val() || 'A';
					
					content = '[dropcap]'+letter+'[/dropcap]';
					
				break;
				
				// Icons
				case 'single_icon':
					var link = $('input[id='+name+'-icon_link]').val(),
							icon = $('select[id='+name+'-icon]').val() || 'fa-leaf',
							size = $('input[name='+name+'-size]:checked').val() || 'icon-smallsize',
							boxed = $('input[id='+name+'-boxed]:checked').length,
							rounded = $('input[id='+name+'-rounded]:checked').length;
					
					if(boxed) { var box = 'box="true"' } else { var box = '' }
					if(link) { var url = 'url="'+link+'"' } else { var url = '' }
					
					content = '[icon type="'+icon+'" size="'+size+'" '+url+' '+box+']';	
				break;
			}
			
			$('#shortcode-storage-thb').html(content);
	 	}
   
  ///// EVENTS /////
	
		// Main Select Change
    $('#thb-shortcodes').change(function(){
			$('.shortcode-options').hide();
			$('#options-'+$(this).val()).show();
			update_shortcode();
    });
		    
		// Radio Change
    $('#add-shortcode').click(function(){
    	var name = $('#thb-shortcodes').val(),
    			dataType = $('#options-'+name).attr('data-type');
    			
    	update_shortcode();
			ed.selection.setContent($('#shortcode-storage-thb').html());
			
			tb_remove();
		
			return false;
    });
		
		// Radio Change
		$('[id^=shortcode-option]').change(function(){
			update_shortcode();
    });
    
});
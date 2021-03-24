$(document).ready(function(){
	$('.art-default-panel .art-instruments').append('<div class="art-colo art-find-iframe-text"><i class="fa fa-file-video-o" aria-hidden="true"></i></div>');
	$('.art-find-iframe-text').css('display','none')
})

	$(function () {
	  $(document).on("mouseover","video:not(*[class ^= 'art-']), iframe:not(*[class ^= 'art-'])",onIniframe);
	  $('.art-default-panel').fadeOut(0);
	});

	$(function () {
	  $(document).on("mouseover",".art-default-panel",function(){
	  		if ($('.redactive').find('video, iframe, object').length>0){
					$('.art-find-iframe-text').css('display','flex')
			}
	  });
	});
	$(function () {
	  $(document).on('mouseleave','.art-default-panel',function(){
	  	$('.art-find-iframe-text').css('display','none')
	  });
	});

	$(function () {
	  $(document).on('mouseleave','.art-default-panel',onOutiframe);
	});

	// Функция которая отработает при наведении курсора на элемент
	function onIniframe() {

		$('*').removeClass('redactive');
		$(this).addClass('redactive');
		hasevent=$._data( $('.redactive').get(0), 'events' )
		if (hasevent) {
			$('.art-trigger-element').fadeIn(0);
		}
		else{
			$('.art-trigger-element').fadeOut(0);
		}
			x=$(this).offset().left;
			y=$(this).offset().top;
			w=$(this).outerWidth();
			if (w<150){
				
				x=x-((150-w)/2)
				w=150;
			}
			h=$(this).outerHeight();
			$('.art-default-panel').css({
				'left':x,
				'top':y,
				'width':w,
				'height':h
			})
			$('.art-find-iframe-text').css('display','flex')
			$('.art-default-panel').fadeOut(0)
			$('.art-default-panel').fadeIn(0)
			

	
	}

	// Функция которая отработает при выходе курсора за элемент
	function onOutiframe() {
		$('*').removeClass('redactive');

		  $('.art-defalut-panel').fadeOut(0)
		  $('.art-find-iframe-text').css('display','none')
	}
//delete text

//delete text



$(document).on('click','.art-find-iframe-text',function(){
	if (($('.redactive').find('video').length>0) || ($('.redactive').find('iframe').length>0)){
		videosrc=$('.redactive').find('video, iframe').attr('src');
		$('.redactive').find('video, iframe').addClass('can_redact_me')
		newtext=$('#art-video-scr').val(videosrc)
		$('.art-iframe-editor').fadeIn(200)
	}else{
		videosrc=$('.redactive').attr('src');
		$('.redactive').addClass('can_redact_me')
		newtext=$('#art-video-scr').val(videosrc)
		$('.art-iframe-editor').fadeIn(200)	
	}

})

$(document).on('click','#save_video_btn',function(){
	dataid=$('.can_redact_me').attr('data-art-ident');
	newsrc=$('#art-video-scr').val()
	$('.can_redact_me').attr('src',newsrc)
	$('.art-popup').addClass('art_load_screen');
	
		setTimeout(function(){
    	$('.art-popup').removeClass('art_load_screen');
    },500)
		newiframe=$('.can_redact_me')[0].outerHTML
		$('#art-buffer').html(newiframe);
		$('#art-buffer').find('*').removeClass('can_redact_me')
		$('#art-buffer').find('iframe *').remove();
		newtext=$('#art-buffer').html()
		data_save_buffer.push(newtext)
		data_save_id.push(dataid)
		$('#art-buffer').html('')
})


$(document).on('click','.art-close-span',function(){
	$('#art-buffer').html('');
	$('.can_redact_me').removeClass('can_redact_me')
})	


//$('#trumbowyg-icons').remove();
//go edit end



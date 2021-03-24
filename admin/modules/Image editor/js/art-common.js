$(document).ready(function(){
	$('.art-default-panel .art-instruments').append('<div class="art-colo art-find-img-text art-edit-image"><i class="fa fa-picture-o" aria-hidden="true"></i></div>');
	$('.art-find-img-text').css('display','none')
})

	$(function () {
	  $(document).on("mouseover","img:not(*[class ^= 'art-'] img)",onInimg);
	  $('.art-default-panel').fadeOut(0)
	});

	$(function () {
	  $(document).on("mouseover",".art-default-panel",function(){
	  		if ($('.redactive').find('img').length>0){
				if ($('#Image_editor_res').length>0) {
					$('.art-find-img-text').css('display','flex')
				}
			}
	  });
	});
	$(function () {
	  $(document).on('mouseleave','.art-default-panel',function(){
	  	$('.art-find-img-text').css('display','none')
	  });
	});

	$(function () {
	  $(document).on('mouseleave','.art-default-panel',onOutimg);
	});

	// Функция которая отработает при наведении курсора на элемент
	function onInimg() {
		if(!$('.art-image-editor').is(':visible')){
		$('*').removeClass('redactive');
		$(this).addClass('redactive');
		hasevent=$._data( $('.redactive').get(0), 'events' )
		if (hasevent) {
			$('.art-trigger-element').fadeIn(0);
		}
		else{
			$('.art-trigger-element').fadeOut(0);
		}
		if ($('#Image_editor_res').length>0) {
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
			$('.art-find-img-text').css('display','flex')
			$('.art-default-panel').fadeOut(0)
			$('.art-default-panel').fadeIn(0)
			
		}
	}
	}

	// Функция которая отработает при выходе курсора за элемент
	function onOutimg() {
		$('*').removeClass('redactive');
		if ($('#Image_editor_res').length>0) {
		  $('.art-defalut-panel').fadeOut(0)
		  $('.art-find-img-text').css('display','none')
		}
	}
//delete text
$(document).on('click','.art-delete-element',function(){
	
	newtext='';
	dataid=$('.redactive').attr('data-art-ident');
	data_save_buffer.push(newtext)
	data_save_id.push(dataid)
	$('.redactive').remove();
})
//delete text

//go edit
$(document).on('click','.art-edit-image',function(){
	if ($('.redactive').find('img').length>0){
		$('.art-default-panel').fadeOut(0)
		imgval=$('.redactive img:eq(0)')[0].outerHTML;

		$('#art-buffer').html(imgval)
		imgsrc=$('.redactive img:eq(0)').attr('src');
		imgtitle=$('.redactive img:eq(0)').attr('title');
		$('#art-image-title').val(imgtitle)
		imgalt=$('.redactive').attr('alt');
		$('#art-image-alt').val(imgalt)
		//$('.can_redact_me').removeClass('can_redact_me')
		//textval=$('.redactive')[0].outerHTML;
		$('.redactive img:eq(0)').addClass('can_redact_me');
		$('.can_redact_me').parent().removeClass('redactive');

		$('.art-image-preview-example').attr('src',imgsrc)
	  	$('.art-image-editor').fadeIn(200);
	}else{
	$('.art-default-panel').fadeOut(0)
	imgval=$('.redactive')[0].outerHTML;

	$('#art-buffer').html(imgval)
	imgsrc=$('.redactive').attr('src');
	imgtitle=$('.redactive').attr('title');
	$('#art-image-title').val(imgtitle)
	imgalt=$('.redactive').attr('alt');
	$('#art-image-alt').val(imgalt)
	//$('.can_redact_me').removeClass('can_redact_me')
	//textval=$('.redactive')[0].outerHTML;
	$('.redactive').addClass('can_redact_me');
	$('.art-image-preview-example').attr('src',imgsrc)
  	$('.art-image-editor').fadeIn(200);
  }
  	
})

/*$(document).on('click','.art-find-img-text',function(){
	$('.art-default-panel').fadeOut(0)
	imgval=$('.redactive img:eq(0)')[0].outerHTML;

	$('#art-buffer').html(imgval)
	imgsrc=$('.redactive img:eq(0)').attr('src');
	imgtitle=$('.redactive img:eq(0)').attr('title');
	$('#art-image-title').val(imgtitle)
	imgalt=$('.redactive').attr('alt');
	$('#art-image-alt').val(imgalt)
	//$('.can_redact_me').removeClass('can_redact_me')
	//textval=$('.redactive')[0].outerHTML;
	$('.redactive img:eq(0)').addClass('can_redact_me');
	$('.can_redact_me').parent().removeClass('redactive');

	$('.art-image-preview-example').attr('src',imgsrc)
  	$('.art-image-editor').fadeIn(200);
  	
})*/


$(document).on('click','.art-close-span',function(){
	$('#art-buffer').html('');
})	

$(document).on('click','#save_image_btn',function(){
	$('.art-image-editor .art-popup').addClass('art_load_screen');
	$.post('admin/image-loader.php', {image_base_url:image_base_url,imagefilename:imagefilename}, function(data) {
		if (imagefilename) {
			$('#art-buffer').find('img').attr('src','art-uploaded-files/'+imagefilename);
		}
    	
    	$('#art-buffer').find('img').attr('title',$('#art-image-title').val())
    	$('#art-buffer').find('img').attr('alt',$('#art-image-alt').val())
    	newtext=$('#art-buffer').html();
    	$('.can_redact_me').replaceWith(function() {
  return $(newtext, {
    html: $(this).html()
  }).addClass('can_redact_me')
});
    	dataid=$('.can_redact_me').attr('data-art-ident');
    	data_save_buffer.push(newtext)
		data_save_id.push(dataid)

    setTimeout(function(){
    	$('.art-image-editor .art-popup').removeClass('art_load_screen');
    },500)
    
  })	
 


})

//$('#trumbowyg-icons').remove();
//go edit end


//drag n drop
//----------App.js---------------------//
imagefilename='';
image_base_url='';
$(document).ready(function() {
    var holder = document.getElementById('art_image_preview');
    holder.ondragover = function () { $('.art-image-preview').addClass('art-hovered'); return false; };
    holder.ondragleave = function () { $('.art-image-preview').removeClass('art-hovered'); return false; };
    holder.ondrop = function (e) {
      $('.art-image-preview').addClass('art-load-done');
      $('.art-image-preview').removeClass('art-hovered');
      e.preventDefault();
      var file = e.dataTransfer.files[0];
      imagefilename=file.name;
      var reader = new FileReader();
      reader.onload = function (event) {
          //document.getElementById('art-image-preview-example').className='art-visible'
          $('#art-image-preview-example').attr('src', event.target.result);
          image_base_url=event.target.result;
          $('#art-buffer').find('image').attr('src',image_base_url)
      }
      reader.readAsDataURL(file);
    };
});

//file input
function encodeImage(element) {

var file = element.files[0];

imagefilename=file.name;

var reader = new FileReader();

reader.onloadend = function() {

$("#art-image-preview-example").attr("src",reader.result);
image_base_url=reader.result;
$('#art-buffer').find('image').attr('src',image_base_url)

}

reader.readAsDataURL(file);

}


$(document).on('click','.art-close-span',function(){
	$('#art-buffer').html('');
	$('.can_redact_me').removeClass('can_redact_me')
})	
//drag n drop end


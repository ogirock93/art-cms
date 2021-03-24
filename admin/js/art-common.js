$(function () {
    $(document).on('mouseleave','.art-default-panel',function(){
      $('.art-default-panel').fadeOut(0)
    });
  });

$('#localization').change(function(){
  $.post('admin/lang-save.php', {lang:$('#localization').val()}, function(data) {
        setTimeout(function(){
          location.reload();
        },200)
  })
})

$('#art-pass-submit').submit(function(){
  $(this).find('.art-err').text('');
if ((!$('#pass1').val()) || (!$('#pass2').val())){
 $(this).find('.art-err').append('<p class="art-error-p">'+passempty+'</p>')
}
else{
  if (($('#pass1').val()) != ($('#pass2').val())){
   $(this).find('.art-err').append('<p class="art-error-p">'+passnotmatch+'</p>')
  }
  else{
    $.post('admin/save-pass.php', {newpass:$('#pass1').val()}, function(data) {
    $('#art-pass-submit .art-err').append('<p class="art-succ-p">'+passsaved+'</p>');
    $.post('admin/logout.php', function(data) {
        setTimeout(function(){
          location.reload();
        },1500)
    })
  })
  }
}
return false;
}) 

$('#art-login-submit').submit(function(){
 $(this).find('.art-err').text('');
  if ($.trim($('#login').val())){
    $.post('admin/save-pass.php', {newlogin:$('#login').val()}, function(data) {
    $('#art-login-submit .art-err').append('<p class="art-succ-p">'+loginsave+'</p>');
    $.post('admin/logout.php', function(data) {
        setTimeout(function(){
          location.reload();
        },1500)
    })
  })
  }
return false;
})

 $(document).on('click','.art-input-wrap .eye',function(){
    if ($(this).parent().find('input').attr('type')=='password') {
      $(this).parent().find('input').attr('type','text');
      $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash')
    }else{
      $(this).parent().find('input').attr('type','password');
      $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye')
    }
 })

 $(document).ready(function(){
$('body').addClass('art_load_screen')
  data_href=$('#art_save_content').attr('data-art-href');
       $.post('admin/identify.php', {data_href:data_href}, function(data) {
        $('#art_site_content').html(data)
      setTimeout(function(){
        $('body').removeClass('art_load_screen')
        //location.reload();
      },2000)
    })

$(document).on('click','.art-trigger-element',function(){
  $('.redactive').trigger('click')
  $('.art-editor-panel').fadeOut(0)
})
  data_href=$('#art_save_content').attr('data-art-href');
  if(((!$('#art_site_content *[data-art-ident="0"]').length>0))){
    if (($.trim($('#art_site_content').text()))){
       $('body').addClass('art_load_screen')
     $.post('admin/identify.php', {data_href:data_href}, function(data) {
    setTimeout(function(){
      $('body').removeClass('art_load_screen')
      location.reload();
    },2000)
  })
    }
   else{
    $('#art_site_content').html('<br><br><p class="art-no-redactive">'+hasnocontent+'</p>')
  }
  }
  
 })

data_save_id=[];
data_save_buffer=[];

$(document).ready(function(){
	$(document).on('click','.art-main-menu-wrap .art-have-child > span',function(){
		$(this).parent().toggleClass('art-active-menu-link')
		$(this).parent().find('.art-sub-menu').slideToggle(200)
	})
})


//enable module
$(document).on('click','.art-module-menu li span',function(event){	
  id=$(this).parent().attr('for');
  $('.redactive').removeClass('redactive')
  $('.can_redact_me').removeClass('can_redact_me')
	module_name=$.trim($(this).parent().parent().find('h2').text());
	$.post('admin/functions/enable-module.php', {module_name:module_name}, function(data) {
    if ($('#'+id+'_res').length){
      $('#'+id+'_res').remove();
    }else{
      $('.art-res').append('<div id="'+id+'_res"></div>');
      $.post('admin/modules/'+module_name+'/res.php', function(data) {
        $('#'+id+'_res').html(data)
      })
    }
  })
})
//enable module end


//popup
$(document).on('click','.art-close span',function(){
  if ($('.art_html_view').hasClass('art_active_btn')){
    $('.art_html_view').trigger('click')
  }
	$('.art-main-popup-wrap').fadeOut(200);
  $('.can_redact_me').removeClass('can_redact_me')
})
//popup end

//drag popup
$(document).ready(function(){
  $(document).on('mouseup',".art-drag",function(){
     $(this).parent().parent().removeClass('can-drag-me');
  });
   $(document).on('mousedown',".art-drag",function(event){
    $(this).parent().parent().addClass('can-drag-me');
    var myX = event.pageX - $('.art-main-popup-wrap:visible .art-close').offset().left;
    var myY = event.pageY - $('.art-main-popup-wrap:visible .art-close').offset().top;
     $(document).on('mousemove',".art-main-popup-wrap:visible",function(event){  
      var relX = event.pageX - $(this).offset().left;
      var relY = event.pageY - $(this).offset().top;
    $('.can-drag-me').css('position','absolute');
    $('.can-drag-me').css('top',relY-myY);
    $('.can-drag-me').css('left',relX-myX);
});
});
});
//drag popup end

$(document).on('click','#art_save_content',function(){
  data_href=$(this).attr('data-art-href');
  //alert(data_save_id+' - '+data_save_buffer)
  $.post('admin/save.php', {data_save_id : data_save_id, data_save_buffer : data_save_buffer, data_href:data_href}, function(data) {
    if (data){
        $('#art_save_content').find('.art-save-success').css('opacity','1');
        setTimeout(function(){
          $('#art_save_content').find('.art-save-success').css('opacity','0')
        },2000)
    } 
    data_save_id=[];
data_save_buffer=[];
  })
 

})

$(document).on('click','#art_save_dev_content',function(){
  data_href=$(this).attr('data-art-href');
  //alert(editor.getValue())
  //alert(data_save_id+' - '+data_save_buffer)
  $.post('admin/save_dev.php', {dev_data : editor.getValue(),data_href:data_href}, function(data) {
    if (data){
        $('#art_save_dev_content').find('.art-save-success').css('opacity','1');
        setTimeout(function(){
          $('#art_save_dev_content').find('.art-save-success').css('opacity','0')
        },2000)
    } 
  })
 

})


$('.art-to-up').click(function(){
  $('.art-header').toggleClass('art-header-hidden');
})

$('.art-device-pc').click(function(){
  $('.art-active-device').removeClass('art-active-device')
  $(this).addClass('art-active-device');
  $('#art_site_content').css('width','100%')
})
$('.art-device-tablet').click(function(){
  $('.art-active-device').removeClass('art-active-device')
  $(this).addClass('art-active-device');
  $('#art_site_content').css('width','768px')
})
$('.art-device-mobile').click(function(){
  $('.art-active-device').removeClass('art-active-device')
  $(this).addClass('art-active-device');
  $('#art_site_content').css('width','350px')
})




$('.art-dev-mode').click(function(){
  if ($('#art-dev-mode-checkbox').prop('checked')){
    url=window.location.href;
    window.location.href=url+'&dev_mode=on';
  }else{
    url=window.location.href;
    url=url.replace('&dev_mode=on', '')
    window.location.href=url.replace('&dev_mode=on', '');
  }
})

$('.art-heading-modules').click(function(){
  $(this).toggleClass('active-heading-module')
  $(this).parent().find('.art-details').slideToggle(400)
})


$(document).on('click','.art-delete-element',function(){
  
  newtext='';
  dataid=$('.redactive').attr('data-art-ident');
  data_save_buffer.push(newtext)
  data_save_id.push(dataid)
  $('.redactive').remove();
})










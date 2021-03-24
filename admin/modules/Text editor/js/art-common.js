$(document).ready(function(){
	$('.art-default-panel .art-instruments').prepend('<div class="art-colo art-edit-text"><i class="fa fa-pencil" aria-hidden="true"></i></div>');
	$('.art-edit-text').css('display','none')
})	

	$(function () {
	  $(document).on("mouseover","p:not([class ^= 'art-']), span:not([class ^= 'art-']), h1:not([class ^= 'art-']), h2:not([class ^= 'art-']), h3:not([class ^= 'art-']), h4:not([class ^= 'art-']), h5:not([class ^= 'art-']) ,h6:not([class ^= 'art-']), li:not([class ^= 'art-']), a:not([class ^= 'art-']), button:not([class ^= 'art-']), label:not([class ^= 'art-'])",onIn);
	$('.art-default-panel').fadeOut(0)
	});

	$(function () {
	  $(document).on('mouseleave','.art-default-panel',onOut);
	});

	// Функция которая отработает при наведении курсора на элемент
	function onIn() {
		if(!$('.art-text-editor').is(':visible')){
		$('*').removeClass('redactive');
		$(this).addClass('redactive');
		hasevent=$._data( $('.redactive').get(0), 'events' )
		if (hasevent) {
			$('.art-trigger-element').fadeIn(0);
		}
		else{
			$('.art-trigger-element').fadeOut(0);
		}
		if ($('#Text_editor_res').length>0) {
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
			$('.art-edit-text').css('display','flex');
			$('.art-default-panel').fadeOut(0)
			$('.art-default-panel').fadeIn(0)
			
		}
	}
	}

	// Функция которая отработает при выходе курсора за элемент
	function onOut() {
		$('*').removeClass('redactive');
		if ($('#Text_editor_res').length>0) {
		  $('.art-default-panel').fadeOut(0)
		  $('.art-edit-text').css('display','none');
		}
	}


//go edit
$(document).on('click','.art-edit-text',function(){
	$('.art-default-panel').fadeOut(0)
	$('.can_redact_me').removeClass('can_redact_me')
	//textval=$('.redactive')[0].outerHTML;
	textval=$('.redactive')[0].outerHTML;
	$('.redactive').addClass('can_redact_me');
	$('#art_text').val('');
	$('.art_realtime_text').html(textval)
  	$('#art_text').val(textval);
  	$('.art-text-editor').fadeIn(200);
  	
})
$(document).on('click','.art_html_view',function(){
	$('#switchBox').trigger('click')
	$(this).toggleClass('art_active_btn')
	if($(this).hasClass('art_active_btn')){
	$('.art_btn_panel button').not(this).attr('disabled','disabled');	
}else{
	$('.art_btn_panel button').not(this).removeAttr('disabled');
}
	
	/*if(!$('.art_realtime_text').is(':visible')){
		$('.art_realtime_text').html($('#art_text').val())
	}else{
		$('#art_text').val($('.art_realtime_text').html())
	}
	$('.art_realtime_text').fadeToggle(0);*/
})




function insertTextAtCursor(el, text, offset) {
    var val = el.value, endIndex, range, doc = el.ownerDocument;
    if (typeof el.selectionStart == "number"
            && typeof el.selectionEnd == "number") {
        endIndex = el.selectionEnd;
        el.value = val.slice(0, endIndex) + text + val.slice(endIndex);
        el.selectionStart = el.selectionEnd = endIndex + text.length+(offset?offset:0);
    } else if (doc.selection != "undefined" && doc.selection.createRange) {
        el.focus();
        range = doc.selection.createRange();
        range.collapse(false);
        range.text = text;
        range.select();
    }
}
$(document).on("keyup", "#art_text", function(e) {
    if (e.keyCode === 13) {
        var $this = $(this); // Caching
        insertTextAtCursor(document.getElementById('art_text'),'<br/>'+'\n');
    }
});

$(document).on('click','#save_text_btn',function(){
	$('.art-text-editor .art-popup').addClass('art_load_screen');
	if ($('#sourceText').length>0){
		newtext=$('#sourceText').text();	
	}else{
		newtext=$('#art_realtime_text').html();
	}
	
	/*canlen=$('.can_redact_me').not('#art_text .can_redact_me').length;
	$('.can_redact_me').not('#art_text .can_redact_me').not('.can_redact_me:eq('+(canlen-1)+')').remove();*/
	
	//$('.can_redact_me').not('#art_text .can_redact_me').replaceWith(newtext)
	dataid=$('.can_redact_me').attr('data-art-ident');
	$('.can_redact_me').not('#art_text .can_redact_me').replaceWith(function() {
  return $(newtext, {
    html: $(this).html()
  }).addClass('can_redact_me')
});
	
	//data_save_id.push(dataid)
		data_save_buffer.push(newtext)
		data_save_id.push(dataid)
		setTimeout(function(){
    	$('.art-text-editor .art-popup').removeClass('art_load_screen');
    },500)


	//alert('id: '+data_save_id+'\n'+'content: '+data_save_buffer)
})

//$('#trumbowyg-icons').remove();
//go edit end

$(document).on('click','.art-some_attr',function(){

    var html = "";
    if (typeof window.getSelection != "undefined") {
        var sel = window.getSelection();
        if (sel.rangeCount) {
            var container = document.createElement("div");
            for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                container.appendChild(sel.getRangeAt(i).cloneContents());
            }
            html = container.innerHTML;
        }
    } else if (typeof document.selection != "undefined") {
        if (document.selection.type == "Text") {
            html = document.selection.createRange().htmlText;
        }
    }
    $('#art-buffer').html(html)
    if (html){
    	if ($('#art-buffer').find('a').length>0){
var found = $(html)[0].outerHTML
var $div = $('#art-buffer').html(found);
$div.find('a').attr('target', '_blank');
var processedHTML = $div.html();
document.execCommand("insertHTML",false,processedHTML)
$('#art-buffer').html('')
html=''
}
}

})

$(document).on('click','#art_realtime_text a',function(){
	return false;
})




$(document).ready(function(){initDoc();})
//text edit ff
$(document).on('click','#compForm button',function(){
return false;
})
  var oDoc, sDefTxt;

function initDoc() {
  oDoc = document.getElementById("art_realtime_text");
  sDefTxt = oDoc.innerHTML;
  if (document.compForm.switchBox.checked) { setDocMode(true); }
}

function formatDoc(sCmd, sValue) {
  if (validateMode()) { document.execCommand(sCmd, false, sValue); oDoc.focus(); }
} 

function validateMode() {
  if (!document.compForm.switchBox.checked) { return true ; } 
  alert("Uncheck \"Показать HTML\"."); /* убрать галочку из "Показать HTML" */
  oDoc.focus();
  return false;
}

function setDocMode(bToSource) {
  var oContent;
  if (bToSource) {
    oContent = document.createTextNode(oDoc.innerHTML);
    oDoc.innerHTML = "";
    var oPre = document.createElement("pre");
    oDoc.contentEditable = false;
    oPre.id = "sourceText";
    oPre.contentEditable = true;
    oPre.appendChild(oContent);
    oDoc.appendChild(oPre);
    document.execCommand("defaultParagraphSeparator", false, "div");
  } else {
    if (document.all) {
      oDoc.innerHTML = oDoc.innerText;
    } else {
      oContent = document.createRange();
      oContent.selectNodeContents(oDoc.firstChild);
      oDoc.innerHTML = oContent.toString();
    }
    oDoc.contentEditable = true;
  }
  oDoc.focus();
}
$(document).on('click','.art-close-span',function(){
	$('#art-buffer').html('');
	$('.can_redact_me').removeClass('can_redact_me')
})	
/*function printDoc() {
  if (!validateMode()) { return; }
  var oPrntWin = window.open("","_blank","width=450,height=470,left=400,top=100,menubar=yes,toolbar=no,location=no,scrollbars=yes");
  oPrntWin.document.open(); 
  oPrntWin.document.write("<!doctype html><html><head><title>Print<\/title><\/head><body onload=\"print();\">" + oDoc.innerHTML + "<\/body><\/html>");
  oPrntWin.document.close(); 
} */


//text edit ff end

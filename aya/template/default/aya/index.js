var CODE_EDITOR = new Array(); 


function modal_hide(){
	$('#triggerModal').modal('hide');
}

function auto_footer(){
	var h=$(window).height();
	var b=$('body').height();
	var c=h-b;
	if(c>0){
	$('#container').height($('#container').height()+c);
	$('#main_box').height($('#main_box').height()+c);
	}
	$('.footer').css('text-indent','0em');
}

function open_msg(){
 	var amsg=$.cookie("amsg");
 	var aclass=$.cookie("aclass");
	
	
	
	if(amsg && aclass){
		$.messager.show(amsg, {type: aclass,time: 3000,placement: 'top'});
		$.cookie('amsg', '', { path:'/' });
		$.cookie('aclass', '', { path:'/' });
	}
}
function get_editor(formid){
	$("#"+formid+" input:hidden").each(function (i){
		
		var ueid=this.id+'_script';
		var keid=this.id;
		if(document.getElementById(ueid)){
 $(this).val(UE.getEditor(ueid).getContent());
}

if(keid.substring(0, 7)=='editor_'){
	var id=keid.substring(7);
	eval('$("#'+id+'").val('+this.name+'.html());');
}

});
}

function aya_post(formid){
	get_editor(formid);	
	var action=$('#'+formid).attr('action');
	 action =action + (action.indexOf('?')<0?'?':'&')+'in_ajax=1';
	
	msg_loading();
	
      $.ajax({
          type:"POST",
          url:action,
          data:$('#'+formid).serialize(),
          dateType:'html',
          success: function(data){
              eval(data);
           },
          complete: function (XHR, TS) { XHR = null }
      });
      return false;
}

function aya_get(action){
	 action =action +(action.indexOf('?')<0?'?':'&')+'in_ajax=1';
	
	msg_loading();
      $.ajax({
          type:"get",
          url:action,
          dateType:'html',
          success: function(data){
              eval(data);
           },
          complete: function (XHR, TS) { XHR = null }
      });
      return false;
}

function msg_loading(){
	$.messager.show('<div class="aya_loading"></div>', {close: false,time: 1000000,placement: 'top'});
}
function msg_hide(){
	$.messager.hide();
}
function doane(event) {
	e = event ? event : window.event;
	if (!e) {
		e = getEvent();
	}
	if (!e) {
		return null;
	}
	if (e.preventDefault) {
		e.preventDefault();
	} else {
		e.returnValue = false;
	}
	if (e.stopPropagation) {
		e.stopPropagation();
	} else {
		e.cancelBubble = true;
	}
	return e;
}
function get_location_href(){
	var href=location.href;
	var split=href.split('#');
	return split[0];
}
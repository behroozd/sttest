//-------------------------------------------------------------------------
$(function() {
	//---------------------------------------------------------------------
	$.ajaxSetup({
		headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	});
	//---------------------------------------------------------------------
	$('.grid').masonry({ itemSelector: '.grid-item', columnWidth: 140 });
});
//-------------------------------------------------------------------------
function showMyWaitModal(){
	$('body').prepend( $("<div class='myWaitModal' align='center'><i class='fa fa-spinner fa-spin fa-5x'></i></div>") );
}
//-------------------------------------------------------------------------
function hideMyWaitModal(){
	$('.myWaitModal').remove();
}
//-------------------------------------------------------------------------
function alertObj(o) {
	var out = '';
	for (var p in o){ out += p + ': ' + o[p] + '\n'; }
	alert(out);
}
//-------------------------------------------------------------------------
function callAjax( url, method, data, onError, onSuccess ){
	method = typeof method !== 'undefined' ? method : 'post';
	$.ajax({
		url         : url,
		method      : method,
//		crossDomain : true ,
		dataType    : "json",
//		processData : false,
		cache       : false, 
		data        : { data: data },
		error       : onError,
		success     : onSuccess,
		beforeSend  : function(){ /*console.log(data); */$('.btn').prop('disabled',true ); },
		complete    : function(){ $('.btn').prop('disabled',false ); }
	});
}
//-------------------------------------------------------------------------
function callImage(id){
	//----------------------------------------------
	showMyWaitModal();
	callAjax( 'products/'+id, 'get', null, 
		function(xhr){
			hideMyWaitModal();
			var msg = "<h3 style='color:red'>Error code: "+xhr.status+"</h3>";
			bootbox.alert(msg);
		},
		function(retVal, status, xhr){
			hideMyWaitModal();
			if( retVal.result==0 ){
				$("#myImage .modal-header").html(retVal.data[0].title);
				//------------------------------------------
				if(retVal.data[0].image!=''){
					$("#myImage .modal-body").html('<img src="product/images/'+id+'/'+retVal.data[0].image+'" />');
				}else{
					$("#myImage .modal-body").html('');
				}
				//------------------------------------------
				$("#myImage"  ).modal({ keyboard: false, show:true, backdrop:false });
				//------------------------------------------
			}else{
				bootbox.alert(retVal.msg);
			}
		}
	);
	//----------------------------------------------
}
//--------------------------------------------------
function callDialog(id){
	//----------------------------------------------
	showMyWaitModal();
	callAjax( "products/"+id, 'get', null, 
		function(xhr){
			hideMyWaitModal();
			var msg = "<h3 style='color:red'>Error code: "+xhr.status+"</h3>";
			bootbox.alert(msg);
		},
		function(retVal, status, xhr){
			hideMyWaitModal();
			$("#myModal input[type=checkbox]").parent().hide();
			$("#myModal input[type=checkbox]").prop('disabled', false);
			$("#myModal input[type=checkbox]").prop('checked' , false);
			if( retVal.result==0 ){
				$("#id"         ).val(retVal.data[0].id );

				$("#title"      ).val(retVal.data[0].title      );
				$("#price"      ).val(retVal.data[0].price      );
				$("#description").val(retVal.data[0].description);
				$("#imgName"    ).val(retVal.data[0].image      );
				
				$("#myModal input[type=checkbox]").prop('checked' , false);
				for(var i in retVal.data[0].size){
//					$("#"+retVal.data[0].size[i]).prop('checked' , true);
					$("."+retVal.data[0].size[i]).show();
				}
				for(var i in retVal.data[0].color){
//					$("#"+retVal.data[0].color[i]).prop('checked' , true);
					$("."+retVal.data[0].color[i]).show();
				}
				$("#title"      ).prop('disabled', true);
				$("#price"      ).prop('disabled', true);
				$("#description").prop('disabled', true);
				
				$("#action"     ).html('Buy <i class="fa fa-shopping-cart"></i>');
				$("#action"     ).attr('class','btn btn-info btn-outline');

				$("#myModal").modal({ keyboard: false, show:true, backdrop:false });
			}else{
				bootbox.alert(retVal.msg);
			}
		}
	);
	//----------------------------------------------
}
//--------------------------------------------------
function callAction(){
	//----------------------------------------------
	var data         = {};
	data.id          = $("#id"         ).val();
	data.title       = $("#title"      ).val().trim();
	data.name        = $("#name"       ).val().trim();
	data.email       = $("#email"      ).val().trim();
	data.title       = $("#title"      ).val().trim();
	data.price       = $("#price"      ).val();
	data.description = $("#description").val().trim();
	data.image       = $("#imgName"    ).val();
	
	data.size       = [0];
	$("#myModal input[name=size]").each(function(){
		if( $(this).prop('checked') ){
			data.size.push( $(this).attr('id') );
		}
	});
	data.color      = [0];
	$("#myModal input[name=color]").each(function(){
		if( $(this).prop('checked') ){
			data.color.push( $(this).attr('id') );
		}
	});

	var url = '';

	if( data.name =='' ){ bootbox.alert("name is required", function(){ $("#name").focus(); }); return; }
	if( data.email=='' || !isEmail(data.email) ){ bootbox.alert("email is required", function(){ $("#price").focus(); }); return; }
	url = 'products/buy/'+data.id;

	showMyWaitModal();
	callAjax( url, 'post', data, 
		function(xhr){
			hideMyWaitModal();
			var msg = "<h3 style='color:red'>Error code: "+xhr.status+"</h3>";
			bootbox.alert(msg);
		},
		function(retVal, status, xhr){
			hideMyWaitModal();
			if( retVal.result==0 ){
				$("#myModal").modal('hide');
			}else{
				bootbox.alert(retVal.msg);
			}
		}
	);
	//----------------------------------------------
}
//--------------------------------------------------
function isEmail( data ){
	return /^([\w\-\.]+)@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([\w\-]+\.)+)([a-zA-Z]{2,4}))$/.test( data );
}
//--------------------------------------------------

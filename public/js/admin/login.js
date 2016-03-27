//--------------------------------------------------
function callLogin(adminURL){
	//----------------------------------------------
	$.ajaxSetup({
		headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	});
	//----------------------------------------------
	var data      = {};
	data.user     = $("#user"    ).val();
	data.password = $("#password").val();

	if( data.user==''     ){ bootbox.alert("user is required"    , function(){ $("#user"    ).focus(); }); return; }
	if( data.password=='' ){ bootbox.alert("password is required", function(){ $("#password").focus(); }); return; }

	showMyWaitModal();
	callAjax( 'login/checkuser', 'post', data, 
		function(xhr){
			hideMyWaitModal();
			var msg = "<h3 style='color:red'>Error code: "+xhr.status+"</h3>";
			bootbox.alert(msg);
		},
		function(retVal, status, xhr){
			hideMyWaitModal();
			if( retVal.result==0 ){
				$("#myModal").modal('hide');
				window.location=adminURL;
			}else{
				bootbox.alert(retVal.msg);
			}
		}
	);
	//----------------------------------------------
}
//--------------------------------------------------

	//--------------------------------------------------
	var $dataTable;
	$(function() {
		//----------------------------------------------
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
		//----------------------------------------------
		try{
			$dataTable = $('#dataTable').DataTable({
				info            : true,
				bProcessing     : true,
				sAjaxSource     : 'products/0',
				fnServerData : function ( sSource, aoData, fnCallback, oSettings ) {
					$.ajax( {
						"dataType": 'json',
						"cache"   : true,
						"type"    : "get",
						"url"     : sSource,
						"data"    : aoData,
						"success" : fnCallback
					});
				},
				aLengthMenu     : [[10, 50, -1], [10, 50, "All"]],
	//			"initComplete" : function(settings, json){ /*$('.act').tooltip();*/ },
				"columnDefs": [
//					{ "targets": [ 0 ] },
//					{ "targets": [ 1 ], "orderable": false, "searchable": false, "sClass": 'center' },
					{ "targets": [ 2 ], "orderable": false, "searchable": false },
					{ "targets": [ 3 ], "orderable": false, "searchable": false },
					{ "targets": [ 4 ], "orderable": false, "searchable": false },
					{ "targets": [ 5 ], "orderable": false, "searchable": false },
				]
			});
	//		
			$dataTable.on( 'draw.dt', function ( e, settings, len ) {
				$('.act').tooltip();
			});
		}catch(e){ console.log(e); }
	});
	//--------------------------------------------------
	function callDataTableReload(){
		$dataTable.ajax.reload();
	}
	//--------------------------------------------------
	function callDialog(act, id){
		//----------------------------------------------
		if( act==0 ){
			//------------------------------------------
			$("#id"         ).val(id );
			$("#act"        ).val(act);
			$("#title"      ).val('' );
			$("#price"      ).val('' );
			$("#description").val('' );

			$("#title"      ).prop('disabled', false);
			$("#price"      ).prop('disabled', false);
			$("#description").prop('disabled', false);
			
			$("#action"     ).html('Save <i class="fa fa-save"></i>');
			$("#action"     ).attr('class','btn btn-success');

			$("#myModal"    ).modal({ keyboard: false, show:true, backdrop:false });

			$("#myModal input[type=checkbox]").prop('disabled', false);
			$("#myModal input[type=checkbox]").prop('checked' , false);
			//------------------------------------------
		}else{
			//------------------------------------------
			showMyWaitModal();
			callAjax( "products/"+id, 'get', null, 
				function(xhr){
					hideMyWaitModal();
					var msg = "<h3 style='color:red'>Error code: "+xhr.status+"</h3>";
					bootbox.alert(msg);
				},
				function(retVal, status, xhr){
					hideMyWaitModal();
					if( retVal.result==0 ){
						$("#id"         ).val(retVal.data[0].id );
						$("#act"        ).val(act);

						$("#title"      ).val(retVal.data[0].title      );
						$("#price"      ).val(retVal.data[0].price      );
						$("#description").val(retVal.data[0].description);
						$("#myModal input[type=checkbox]").prop('checked' , false);
						for(var i in retVal.data[0].size){
							$("#"+retVal.data[0].size[i]).prop('checked' , true);
						}
						for(var i in retVal.data[0].color){
							$("#"+retVal.data[0].color[i]).prop('checked' , true);
						}
						if(act==1){
							$("#title"      ).prop('disabled', false);
							$("#price"      ).prop('disabled', false);
							$("#description").prop('disabled', false);
							
							$("#action"     ).html('Save <i class="fa fa-save"></i>');
							$("#action"     ).attr('class','btn btn-info');

							$("#myModal input[type=checkbox]").prop('disabled', false);
						}else{
							$("#title"      ).prop('disabled', true);
							$("#price"      ).prop('disabled', true);
							$("#description").prop('disabled', true);
							
							$("#action"     ).html('Delete <i class="fa fa-trash"></i>');
							$("#action"     ).attr('class','btn btn-danger');

							$("#myModal input[type=checkbox]").prop('disabled', true);
						}
						$("#myModal").modal({ keyboard: false, show:true, backdrop:false });
					}else{
						bootbox.alert(retVal.msg);
					}
				}
			);
			//------------------------------------------
		}
		//----------------------------------------------
	}
	//--------------------------------------------------
	function callAction(){
		//----------------------------------------------
		var data         = {};
		data.id          = $("#id"         ).val();
		data.act         = $("#act"        ).val();
		data.title       = $("#title"      ).val().trim();
		data.price       = $("#price"      ).val();
		data.description = $("#description").val().trim();
		
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

		if(data.act==2){
			url = 'products/delete/'+data.id;
		}else{
			if( data.title=='' ){ bootbox.alert("title is required", function(){ $("#title").focus(); }); return; }
			if( data.price=='' ){ bootbox.alert("price is required", function(){ $("#price").focus(); }); return; }
			if( isNaN(data.price) ){ $("#price").val(''); bootbox.alert("price is required", function(){ $("#price").focus(); }); return; }
			if(data.act==0){ url = 'products/insert/0'; }
			else{ url = 'products/update/'+data.id; }
		}

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
					callDataTableReload();
				}else{
					bootbox.alert(retVal.msg);
				}
			}
		);
		//----------------------------------------------
	}
	//--------------------------------------------------
	function callImage(id){
		//----------------------------------------------
		$("#idProduct").val(id);
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
					//------------------------------------------
					if(retVal.data[0].image!=''){
						$("#myImage .modal-body").html('<img src="product/images/'+id+'/'+retVal.data[0].image+'" />');
					}else{
						$("#myImage .modal-body").html('');
					}
					//------------------------------------------
					$("#myImage"  ).modal({ keyboard: false, show:true, backdrop:false });
					//------------------------------------------
					$('#fileupload').fileupload({
						url              : 'product/uploader/index.php',
						singleFileUploads: true,
						formData: [{ name:'id', value:$("#idProduct").val() }],
						dataType         : 'json',
						//--------------------------------------
						done: function (e, retVal) {
							$.each(retVal.result.files, function (index, file) {
								var setImage = {};
								setImage.file = file.name;
								showMyWaitModal();
								callAjax( 'products/setimage/'+id, 'post', setImage, 
									function(xhr){
										hideMyWaitModal();
										var msg = "<h3 style='color:red'>Error code: "+xhr.status+"</h3>";
										bootbox.alert(msg);
									},
									function(retVal, status, xhr){
										hideMyWaitModal();
										if( retVal.result==0 ){
											$('#progress .progress-bar').css( 'width','0%' );
											closeImageDialog();
											callDataTableReload();
										}else{
											bootbox.alert(retVal.msg);
										}
									}
								);
								
							});
						},
						//--------------------------------------
						add:function(e,data){
							if( (/\.(png|gif|jpeg|jpg)$/i).test(data.files[0].name) ){
								data.files.map(function(i){
									if(i.type!='image/png' && i.type!='image/gif' && i.type!='image/jpeg' && i.type!='image/jpg'){
										bootbox.alert('Invalid file format');
									}else{
										data.submit();
									}
								});
							}else{
								bootbox.alert('Invalid file format');
							}
						},
						//--------------------------------------
						progressall: function (e, data) {
							var progress = parseInt(data.loaded / data.total * 100, 10);
							$('#progress .progress-bar').css(
								'width',
								progress + '%'
							);
						}
						//--------------------------------------
					}).prop('disabled', !$.support.fileInput)
						.parent().addClass($.support.fileInput ? undefined : 'disabled');
					//------------------------------------------
				}else{
					bootbox.alert(retVal.msg);
				}
			}
		);
		//----------------------------------------------
	}
	//--------------------------------------------------
	function closeImageDialog(){
		$('#fileupload').fileupload('destroy');
		$("#myImage"   ).modal('hide');
	}
	//--------------------------------------------------

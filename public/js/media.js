/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * amime effect
 */
function updateEffect(data, idTable, id, action, callback){
    console.log('updateEffect: '+idTable+', '+id+', '+action+', '+callback);
    var color = '#5cb85c';
    if (action=='store')
        color = '#5cb85c';
    else if(action=='update')
        color = '#5bc0de';
    else if(action=='delete') {
        color = '#d9534f';
        $('.user-action-' + id).remove();
    }
    else
        ;

	//$( '#' + idTable + '_tr-' + id ).switchClass( "big", "blue", 1000, "easeInOutQuad" );
	/*
    $( '#' + idTable + '_tr-' + id ).addClass('shown', function () {
            console.log('updateEffect: callback');
            $(this).removeAttr('style');
            if (callback!=null && callback!='undefined')
                fnjsoncallback[callback](data, idTable,id,action);
        });
    */

	$( '#' + idTable + '_tr-' + id ).addClass('shown');
    $( '#' + idTable + '_tr-' + id ).animate(
        {color: color},
        500,
        function () {
            console.log('updateEffect: color :'+color);
            $(this).removeAttr('style');
            if (callback!=null && callback!='undefined')
                fnjsoncallback[callback](data, idTable,id,action);
        });
}

/*
 * Ajax console.log
 */
function ajaxErrorLog(jqxhr, textStatus, error, name, id){
    console.log('error: '+name);
    console.log(jqxhr);
    console.log(textStatus);
    console.log(error);
    if (id!=null)
        $('#'+id).html(jqxhr.responseText);
    else
        $('#app-error').html(jqxhr.responseText);
}

/*
 * datatable utils
 */

function dataTableSet(id){
    $('#'+id).DataTable({
        "language": {
            "url": "/media/public/json/French.json"
        },
        "lengthMenu": [[50, 100, 250, -1],[50, 100, 250, "Tous"]],
        //paging: false
    });
}

function dataTableCheck (id) {
    if ($('#'+id).hasClass('dataTable')){
        //**debug console.log('dataTableCheck: '+id+' ok');
        return true;
    }
    //**debug console.log('dataTableCheck: '+id+' ko');
    return false;
}

function dataTableRowAppend(id,data){
    //**debug console.log('dataTableRowAppend: '+id+', data:'+data);

    if(dataTableCheck(id)==true){
        $('#'+id).DataTable().row.add($(data)).draw();
    }
    else{
        $('#'+id).append(data);
    }
}

function checkArray(myArray, myKey, myValue){
    $.each(myArray, function(){
        if($(this).myKey==myValue){
            return true;
        }
    });
    return false;
}
/*
 * json callback
 */
var fnjsoncallback = new Array();

fnjsoncallback['contentSetActor'] = function (idCallback,myObjectList){
    var actorList = new Array();

    $("#"+idCallback).find(".cbc-data").each(function(){
        if ($(this).prop("checked")==true){
            var myActor = new Object();
            myActor["id"] = $(this).attr("id");
            myActor["idActor"] = parseInt($(this).attr("data-id"));
            actorList.push(myActor);
        }
    });

    console.log(myObjectList);
    console.log(actorList);

    $.each(myObjectList, function (index,value) {
       if (value.checked==1 && checkArray(actorList,'idActor',value.id)==false){
           console.log($(this));
           $('<div/>').append('<input type="checkbox" checked name="actorList[]" value="'+value.id+'" id="cbc-'+value.id+'" data-id="'+value.id+'"/>').append(' '+value.label).appendTo('#actorList');
       }
    });


}

fnjsoncallback['jsoncallback'] = function jsoncallback(data){
    //**debug console.log('jsoncallback:');
    //**debug console.log(data);
}

fnjsoncallback['action-delete'] = function actionDelete(data, idTable, id, action) {
    console.log('actionDelete');
    if (dataTableCheck(idTable) == true)
        $('#' + idTable).dataTable().fnDeleteRow('#' + idTable + '_tr-' + id);
    else
        $('#' + idTable + '_tr-' + id).remove();
}

fnjsoncallback['action-update'] = function actionUpdate(data, idTable, id, action){
    console.log('actionUpdate');
    $.ajax({
        url: data.url,
        type: "GET",
        dataType:"html",
        data: {'_token': $('meta[name=csrf-token]').attr('content'), 'id':id},
        success: function(response){
            $('#'+idTable+'_tr-'+id).replaceWith(response);
            updateEffect(response, idTable, id, 'update' );
        },
        error:function(jqxhr, textStatus, error){
            ajaxErrorLog(jqxhr, textStatus, error, 'action-update');
        }
    });
}

fnjsoncallback['action-store'] = function actionStore(data, idTable, id, action){
    console.log('actionStore');
    $.ajax({
        url: data.url,
        type: "GET",
        dataType:"html",
        data: {'_token': $('meta[name=csrf-token]').attr('content'), 'id':id},
        success: function(response){
            dataTableRowAppend(idTable,response)
            updateEffect(response, idTable, id, 'store' );
        },
        error:function(jqxhr, textStatus, error){
            ajaxErrorLog(jqxhr, textStatus, error, 'action-store');
        }
    });
}

function modelExport(element){
    var data=$(this).closest('form').serializeArray();
    var object=$(element).closest('form').data('object');
    $.ajax({
        url: "/media/model/"+object+"/controller/export.php",
        type: "POST",
        data: data,
        success: function(data){
            $("#"+object+"Export").html(data);
            $("#export").get(0).click();
            $("#export").remove();
        },
        error:function(jqxhr, textStatus, error) {
            ajaxErrorLog(jqxhr, textStatus, error, '');
        }
    });
}

/*
 *
 */

function modelAction(url, model){
    console.log('modelAction');
    $.ajax({
        url: url,
        type: "GET",
        data: {'_token': $('meta[name=csrf-token]').attr('content')},
        success: function(data){
            $('#'+model+'action').html(data);
            $('#'+model+'Modal').modal('show');
        },
        error:function(jqxhr, textStatus, error) {
            ajaxErrorLog(jqxhr, textStatus, error, model+'Action');
        }
    });
}

function modalActionDelete() {
    var result=true;
    var id=$("#modal-object-delete").val();
    var idObject=$("#"+id).data('id');
    var object=$("#"+id).data('object');
    var action=$("#"+id).data('action');
    var callback=$("#"+id).data('callback');
    $.ajax({
        url: $("#"+id).data('url'),
        type: "DELETE",
        data: {'id':idObject, '_token': $('meta[name=csrf-token]').attr('content')},
        success: function(data){
            updateEffect(data, 'table-'+object, idObject, action, callback );
            $('#modal-delete').modal('hide');
        },
        error:function(jqxhr, textStatus, error) {
            ajaxErrorLog(jqxhr, textStatus, error, '.action-object');
        }
    });
}

function modalActionSearch(){
    var myObjectList = new Array();
    $("#modal-search-body").find(".cbc-data").each(function(){
        var myObject = new Object();
        myObject["exists"]=parseInt($(this).attr("data-exists"));
        myObject["id"]=parseInt($(this).attr("data-id"));
        myObject["label"]=($(this).attr("data-label"));
        if ($(this).prop("checked")==true)
            myObject["checked"]=1;
        else
            myObject["checked"]=0;

        myObjectList.push(myObject);
    });

    var idCallback = $('#modal-search-callback-id').val();
    var urlCallback = $('#modal-search-callback-url').val();
    var fnCallback = $('#modal-search-callback-fn').val();

    if (typeof $("#url").val() != 'undefined' && $("#url").val().length>0) {
        $.ajax({
            url: $("#url").val(),
            type: "POST",
            data: {'objectList': JSON.stringify(myObjectList), '_token': $('meta[name=csrf-token]').attr('content')},
            success: function (data) {
                $('#modal-search').modal('hide');
                $('#' + idCallback).html('');
                if (typeof urlCallback != 'undefined' && urlCallback.length > 0) {
                    modalActionSearchCallback(idCallback, urlCallback);
                }
                else if (typeof fnCallback != 'undefined' && fnCallback.length) {
                    fnjsoncallback[fnCallback](idCallback, myObjectList);
                }
            },
            error: function (jqxhr, textStatus, error) {
                ajaxErrorLog(jqxhr, textStatus, error, '.modalActionSearch');
            }
        });
    }
    else{
        $('#modal-search').modal('hide');

        if (typeof urlCallback != 'undefined' && urlCallback.length > 0) {
            modalActionSearchCallback(idCallback, urlCallback);
        }
        else if (typeof fnCallback != 'undefined' && fnCallback.length) {
            fnjsoncallback[fnCallback](idCallback, myObjectList);
        }
    }
}

function modalActionSearchCallback(id,url){
    $.ajax({
        url: url,
        type: "POST",
        success: function(data){
            $('#'+id).html(data);
        },
        error:function(jqxhr, textStatus, error) {
            ajaxErrorLog(jqxhr, textStatus, error);
        }
    });
}

function modalActionFeedBack(){
    console.log("modalActionFeedBack");
}
/*
 *
 */
 
$('document').ready(function() {
	//jQuery.noConflict();
	// Prepare reset.
	function resetModalFormErrors() {
			//$('.form-group').removeClass('has-error');
			//$('.form-group').find('.help-block').remove();
			$('.form-field').removeClass('has-error');
            $('.form-field').find('.help-block').remove();
	}

	function closeModal(id){
			$('#'+id).modal('hide');
	}

    $(document).on('click', '.object-action-delete', function() {
        var id=$(this).attr('id');
        $('#modal-object-delete').val(id);
        $('#modal-delete-body').html($(this).data('confirm'));
        $('#modal-delete').modal('show');
    });

    $('#modal-search').on('show.bs.modal', function () {
        $(this).find('.modal-body').css({
            width:'auto', //probably not needed
            height:'auto', //probably not needed
            'max-height':'100%'
        });
    });

    $('#modal-feedback').on('shown.bs.modal', function () {
        $('#modal-feedback-btn').focus();
    })

    $('#modal-search').on('show', function () {
        $(this).find('.modal-body').css({
            width:'auto', //probably not needed
            height:'auto', //probably not needed
            'max-height':'100%'
        });
    });

    $(document).on('click', '.object-action-search', function() {
        var id=$(this).data('id');
        var title=$(this).data('title');
        var field=$(this).data('field');
        var datafield=new Object();
        $('#modal-search-object').val(id);
        $('#modal-search-callback-id').val($(this).data('callback-id'));
        $('#modal-search-callback-url').val($(this).data('callback-url'));
        $('#modal-search-callback-fn').val($(this).data('callback-fn'));
        if (typeof title != 'undefined') {
            $('#modal-search-title').html(title);
        }
        else{
            $('#modal-search-title').html("Recherche");
        }
        if (typeof field != 'undefined') {
            datafield[field]=$('#'+field).val();
        }
        datafield['isModal']=1;
        datafield['_token']=$('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: $(this).data('url'),
            type: "POST",
            data: datafield,
            success: function(data){
                $('#modal-search-body').html(data);
                $('#modal-search').modal('show');
            },
            error:function(jqxhr, textStatus, error) {
                ajaxErrorLog(jqxhr, textStatus, error, '.action-object');
            }
        });
    });

    /*
	$(document).on('click', '.action-object', function() {
        var result=true;
        var id=$(this).data('id');
        var object=$(this).data('object');
        var action=$(this).data('action');
        var callback=$(this).data('callback');
        if ($(this).data('confirm')){
            result = confirm($(this).data('confirm'));
        }
        if (result){
            $.ajax({
                url: $(this).data('url'),
                type: "DELETE",
                data: {'id':id, '_token': $('meta[name=csrf-token]').attr('content')},
                success: function(data){
                    updateEffect(data, 'table-'+object, id, action, callback );
                },
                error:function(jqxhr, textStatus, error) {
                    ajaxErrorLog(jqxhr, textStatus, error, '.action-object');
                }
            });
        }
    });
    */

	// Intercept submit.
	$(document).on("submit","form.bootstrap-modal-form", function (submission) {
			submission.preventDefault();
			// Set vars.
			var form   = $(this),
					url    = form.attr('action'),
					submit = form.find('[type=submit]'),
					object = form.data('object'),
					action = form.data('action'),
                                        formdataType = form.attr('data-type');
			// Check for file inputs.
			if (form.find('[type=file]').length) {

					// If found, prepare submission via FormData object.
					var input       = form.serializeArray(),
							data        = new FormData(),
							contentType = false;

					// Append input to FormData object.
					$.each(input, function(index, input) {
							data.append(input.name, input.value);
					});

					// Append files to FormData object.
					$.each(form.find('[type=file]'), function(index, input) {
							if (input.files.length == 1) {
									data.append(input.name, input.files[0]);
							} else if (input.files.length > 1) {
									data.append(input.name, input.files);
							}
					});
			}

			// If no file input found, do not use FormData object (better browser compatibility).
			else {
					var data        = form.serialize(),
                    contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
                    console.log(data);
			}

			// Please wait.
			if (submit.is('button')) {
					var submitOriginal = submit.html();
					submit.html('Please wait...');
			} else if (submit.is('input')) {
					var submitOriginal = submit.val();
					submit.val('Please wait...');
			}

			// Request.
			$.ajax({
					//headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
					type: "POST",
					url: url,
					data: data,
					dataType: formdataType,
					cache: false,
					contentType: contentType,
					processData: false

			// Response.
			}).always(function(response, status) {

					// Reset errors.
					resetModalFormErrors();

					// Check for errors.
					if (response.status == 422 && formdataType=='json') {
							var errors = $.parseJSON(response.responseText);

							// Iterate through errors object.
							$.each(errors, function(field, message) {
                                console.error(field+': '+message);
                                var formField = $('[name='+field+']').closest('.form-field');
                                formField.addClass('has-error').append('<p class="help-block">'+message+'</p>');
                                //$('#'+field).closest('div').addClass('has-error').append('<p class="help-block">'+message+'</p>');
							});

					// If successful, reload.
					} else if (formdataType=='json') {
							//location.reload();
							closeModal(form.attr('data-modal-id'));

							console.log(response.callback);

                            if (typeof response.message != 'undefined' ){
                                //$("h1").append();
                                $('<div class="alert media-alert alert-success "><a class="close" data-dismiss="alert">×</a>'+response.message+'</div>').insertAfter('.media-page-header').delay(2000).fadeOut();
                                //$("#modal-feedback-body").html('<div class="has-success"><p class="help-block">'+response.message+'</p></div>');
                                //$("#modal-feedback").modal('show');
                            }

							if (typeof response.url != 'undefined'){
									//window.location.href = response.url;
							}
							else if (typeof response.callback != 'undefined'){
									console.log('form.bootstrap-modal-form: callback');
                                                                        console.log(response.contents);
									;//fnjsoncallback[response.callback](response,'table-'+object,response.id, action);
							}
					}
                    else {
                        $('#' + object + 'SearchList').html(response);
                    }

                    // Reset submit.
                    if (submit.is('button')) {
                        submit.html(submitOriginal);
                    } else if (submit.is('input')) {
                        submit.val(submitOriginal);
                    }
			});
	});

	// Reset errors when opening modal.
	$('.bootstrap-modal-form-open').click(function() {
			resetModalFormErrors();
	});

	$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
	});
	
	$('.form-datepicker').datepicker({
        format: 'dd/mm/yyyy',
        weekStart: 1
    });
});
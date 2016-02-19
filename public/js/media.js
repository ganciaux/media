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
            "url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/French.json"
        },
        "lengthMenu": [50, 100, 250, "Tous"]
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

/*
 * json callback
 */
var fnjsoncallback = new Array();

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
        $('#modal-body').html($(this).data('confirm'));
        $('#modal-delete').modal('show');
    });

    $('#modal-search').on('show.bs.modal', function () {
        console.log("show.bs.modal");
        $(this).find('.modal-body').css({
            width:'auto', //probably not needed
            height:'auto', //probably not needed
            'max-height':'100%'
        });
    });

    $('#modal-search').on('show', function () {
        console.log("show");
        $(this).find('.modal-body').css({
            width:'auto', //probably not needed
            height:'auto', //probably not needed
            'max-height':'100%'
        });
    });

    $(document).on('click', '.object-action-search', function() {
        $.ajax({
            url: $(this).data('url'),
            type: "POST",
            data: {'isModal':1,'_token': $('meta[name=csrf-token]').attr('content')},
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
					action = form.data('action');

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
					dataType: 'json',
					cache: false,
					contentType: contentType,
					processData: false

			// Response.
			}).always(function(response, status) {
					// Reset errors.
					resetModalFormErrors();
					
					// Check for errors.
					if (response.status == 422) {
							var errors = $.parseJSON(response.responseText);

							// Iterate through errors object.
							$.each(errors, function(field, message) {
                                console.error(field+': '+message);
                                var formField = $('[name='+field+']').closest('.form-field');
                                formField.addClass('has-error').append('<p class="help-block">'+message+'</p>');
                                //$('#'+field).closest('div').addClass('has-error').append('<p class="help-block">'+message+'</p>');
							});

							// Reset submit.
							if (submit.is('button')) {
									submit.html(submitOriginal);
							} else if (submit.is('input')) {
									submit.val(submitOriginal);
							}

					// If successful, reload.
					} else {
							//location.reload();
							if (submit.is('button')) {
									submit.html(submitOriginal);
							} else if (submit.is('input')) {
									submit.val(submitOriginal);
							}
							closeModal(form.attr('data-modal-id'));

							console.log(response.callback);
							
							if (typeof response.url != 'undefined'){
									window.location.href = response.url;
							}
							else if (typeof response.callback != 'undefined'){
									console.log('form.bootstrap-modal-form: callback');
									;//fnjsoncallback[response.callback](response,'table-'+object,response.id, action);
							}
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
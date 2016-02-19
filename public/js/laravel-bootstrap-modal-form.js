/*!
 * Laravel-Bootstrap-Modal-Form (https://github.com/JerseyMilker/Laravel-Bootstrap-Modal-Form)
 * Copyright 2015 Jesse Leite - MIT License
 *
 * Bromance:
 * Adam Wathan has nice boots. Thank you for BootForms magic.
 * Matt Higgins has nice beard. Thank you for JS wizardry.
 */

$('document').ready(function() {
    //jQuery.noConflict();
    // Prepare reset.
    function resetModalFormErrors() {
        $('.form-group').removeClass('has-error');
        $('.form-group').find('.help-block').remove();
    }

    function closeModal(id){
        $('#'+id).modal('hide');
    }

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
                    var formGroup = $('[name='+field+']', form).closest('.form-group');
                    formGroup.addClass('has-error').append('<p class="help-block">'+message+'</p>');
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

                if (typeof response.callback != 'undefined'){
                    console.log('form.bootstrap-modal-form');
                    fnjsoncallback[response.callback](response,'table-'+object,response.id, action);

                }
            }
        });
    });

    // Reset errors when opening modal.
    $('.bootstrap-modal-form-open').click(function() {
        resetModalFormErrors();
    });

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

    /*
     $('table.display').DataTable({
     "language": {
     "url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/French.json"
     }
     });
     */

    $(document).on('click', '.action-object', function() {
        console.log('action-object');
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

    $( ".action-search-html" ).on( "submit", function( event ) {
        var idResult=$(this).attr('id')+'-list';
        var object=$(this).data('object');
        var datatable=$(this).data('table');
        $(idResult).html('');
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: $(this).serialize(),
            success: function(data){
                $('#'+idResult).html(data);
                if (datatable=='1')
                    dataTableSet('table-'+object);
            },
            error:function(jqxhr, textStatus, error){
                ajaxErrorLog(jqxhr, textStatus, error, '.action-search-html', idResult);
            }
        });
    });

    $( ".action-search-json" ).on( "submit", function( event ) {
        var idResult='#'+$(this).attr('name')+'-list';
        var callback=$(this).attr('data-callback');
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: "GET",
            dataType: "json",
            data: $(this).serialize(),
            success: function(data){
                //**debug console.log('success: action-search-json');
                fnjsoncallback[callback](data);
            },
            error:function(jqxhr, textStatus, error) {
                ajaxErrorLog(jqxhr, textStatus, error, '.action-search-json');
            }
        });
    });

    $( ".action-search-jsonp" ).on( "submit", function( event ) {
        var idResult='#'+$(this).attr('name')+'-list';
        var callback=$(this).attr('data-callback');
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: "GET",
            data: $(this).serialize(),
            dataType: "jsonp",
            dataCharset: 'jsonp',
            contentType:"application/jsonp; charset=utf-8",
            jsonp:"jsoncallback",
            success: function(data){
                //**debug console.log('success: action-search-json');
                fnjsoncallback[callback](data);
            },
            error:function(jqxhr, textStatus, error) {
                ajaxErrorLog(jqxhr, textStatus, error, '.action-search-jsonp');
            }
        });
    });
});

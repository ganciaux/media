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
        ;//**debug console.log('error updateEffect: bad action: '+action);

    $( '#' + idTable + '_tr-' + id ).animate(
        {backgroundColor: color},
        3500,
        function () {
            //**debug console.log('updateEffect: callback');
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
        }
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

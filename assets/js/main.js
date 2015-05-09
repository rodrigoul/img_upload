/*
 * jQuery File Upload Plugin JS Example 8.9.0
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, regexp: true */
/*global $, window, blueimp */

$(function () {
    'use strict';

    var uploading_files = 0;  
    var all_files = true; 
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        // autoUpload:true,
        url: 'upload/'
    }).bind('fileuploadadded', function (e, data) {
        var auto_start = $('#auto_start').is(':checked');       
        if (auto_start || (auto_start !== false)) {
            data.submit();
        }
    }).bind('fileuploadsend', function (e, data) {
        uploading_files = uploading_files + parseInt(data.context.length); 
        all_files = data.originalFiles;
    }).bind('fileuploadcompleted', function (e, data) {
        uploading_files = uploading_files - parseInt(data.context.length);
        if (uploading_files == 0) {
            $('.message').show();
            $.ajax({
                url: 'upload/upload_completed/',
                data: all_files,
                method: 'post',
                dataType: 'json'
            });
        };
        uploading_files = 0; all_files = true; 
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );
    // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });

});

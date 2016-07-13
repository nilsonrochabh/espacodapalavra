var table = null;
$(document).ready(function () {
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
	
	$('.dataTables-app').each(function(i, elem) {
		var ajax, strFun;
		
		ajax = false;
		if($(elem).data("ajax-url")) {
			ajax = true;
		}
		
		strFun = $(elem).data("function-get");
		var fnData = window[strFun];
		
		table = $(elem).DataTable({
			"dom": "<'row'<'col-sm-6'l><'col-sm-6'p>>r" + "t" + "<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"processing": ajax,
			"serverSide": ajax,
			"ajax": {
				"url": $(elem).data("ajax-url"),
				"data": fnData,
			},
			"tableTools": {
				"sSwfPath": $('#baseUrl').val() + "/inspinia/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
			},
			"pageLength": $(elem).data("pagination-records") || 10,
			"columnDefs": [
				{ targets: ['nosort'], orderable: false }
			],
			"language": {
				"sEmptyTable": $.i18n._('sEmptyTable'),
				"sInfo": $.i18n._('sInfo'),
				"sInfoEmpty": $.i18n._('sInfoEmpty'),
				"sInfoFiltered": $.i18n._('sInfoFiltered'),
				"sInfoPostFix": $.i18n._('sInfoPostFix'),
				"sInfoThousands": $.i18n._('sInfoThousands'),
				"sLengthMenu": $.i18n._('sLengthMenu'),
				"sLoadingRecords": $.i18n._('sLoadingRecords'),
				"sProcessing": '<div class="DT_spin_wrapper"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i></div>',
				"sZeroRecords": $.i18n._('sZeroRecords'),
				"sSearch": $.i18n._('sSearch'),
				"oPaginate": {
					"sNext": $.i18n._('oPaginate_sNext'),
					"sPrevious": $.i18n._('oPaginate_sPrevious'),
					"sFirst": $.i18n._('oPaginate_sFirst'),
					"sLast": $.i18n._('oPaginate_sLast'),
				},
				"oAria": {
					"sSortAscending": $.i18n._('oAria_sSortAscending'),
					"sSortDescending": $.i18n._('oAria_sSortDescending'),
				}
			}
		});
	});
	
	$('.dataTables-simple-app').each(function(i, elem) {
		table = $(elem).DataTable({
			"dom": "t",
			"processing": false,
			"serverSide": false,
			"paging": false,
			"ordering": false,
			"language": {
				"sEmptyTable": $.i18n._('sEmptyTable'),
				"sInfo": $.i18n._('sInfo'),
				"sInfoEmpty": $.i18n._('sInfoEmpty'),
				"sInfoFiltered": $.i18n._('sInfoFiltered'),
				"sInfoPostFix": $.i18n._('sInfoPostFix'),
				"sInfoThousands": $.i18n._('sInfoThousands'),
				"sLengthMenu": $.i18n._('sLengthMenu'),
				"sLoadingRecords": $.i18n._('sLoadingRecords'),
				"sProcessing": '<div class="DT_spin_wrapper"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i></div>',
				"sZeroRecords": $.i18n._('sZeroRecords'),
				"sSearch": $.i18n._('sSearch'),
				"oPaginate": {
					"sNext": $.i18n._('oPaginate_sNext'),
					"sPrevious": $.i18n._('oPaginate_sPrevious'),
					"sFirst": $.i18n._('oPaginate_sFirst'),
					"sLast": $.i18n._('oPaginate_sLast'),
				},
				"oAria": {
					"sSortAscending": $.i18n._('oAria_sSortAscending'),
					"sSortDescending": $.i18n._('oAria_sSortDescending'),
				}
			}
		});
	});
	
	$('.code_editor').each(function(i) {
		CodeMirror.fromTextArea(this, {
			lineNumbers: true,
//	        matchBrackets: true,
	        mode: "text/x-php",
	        indentUnit: 4,
	        indentWithTabs: true,
			styleActiveLine: true,
		});
	});
	
	$("#searchForm").submit(function (event) {
		scrollToPx($(".dataTables-app").offset().top, 1000);
	
		table.ajax.reload();
	
		event.preventDefault();
	});
	
	$(".select2").select2();
	
	initFormComponents();
});

toastr.options = {
	"closeButton": true,
	"debug": false,
	"progressBar": true,
	"positionClass": "toast-top-right",
	"onclick": null,
	"showDuration": "400",
	"hideDuration": "1000",
	"timeOut": "7000",
	"extendedTimeOut": "1000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
};

function scrollToPx(pos, t) {
    $('html, body').animate({
        scrollTop: pos
    }, t);
}

function clearForm(formId) {
    $(':input', '#'+ formId)
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
	
	$('#'+ formId + " .select2-container").select2("val", "");
}

function confirmExclusao(msg, url) {
	if(confirm(msg)) {
		window.location.href = url;
	}
}

function jq(myid) {
	return "#" + myid.replace( /(:|\.|\[|\]|,)/g, "\\$1");
}

function addFieldset(el) {
	var lastIndex = -1;
	$(el).closest('fieldset').find('.collection_wrapper fieldset').find('input,textarea,select').each(function(i) {
		var name = $(this).attr('name');
		
		if(!!name) {
			var re = /.*\[(\d)\]\[.*\]/;
			var m;
			if ((m = re.exec(name)) !== null) {
				if(lastIndex < m[1]) {
					lastIndex = m[1];
				}
			}
		}
	});
	
	lastIndex++;
	var html = $(el).closest('fieldset').find('.collection_template').data('template').replace(/__placeholder__/g, lastIndex);
	$(el).closest('fieldset').find('.collection_wrapper').append(html);
	
	$(el).closest('fieldset').find('.collection_wrapper fieldset').last().append($(el).closest('fieldset').find('.collection_template').data('remove'));
	
	
	
	initFormComponents();
	
	scrollToPx($(el).closest('fieldset').find('.collection_wrapper fieldset').last().offset().top, 1000);
	
	return false;
}

function removeFieldset(el) {
	$(el).closest('fieldset').remove();
	return false;
}

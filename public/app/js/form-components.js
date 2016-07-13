function initFormComponents() {
	initSelect2();
	initSwitchCheckbox();
	initDatepicker();
	initInputNumber();
}

function initSelect2() {
	$('*[data-type=select2]').filterByData('initialized', false).each(function(i) {
		
		var attribs = $(this).data();
		
 		$(this).select2({
 			minimumInputLength: attribs['minimum-input-ength'],
 			allowClear: true,
 			placeholder: attribs['placeholder'],
 			multiple: attribs['multiple'],
 			maximumSelectionSize: attribs['maximum-selection-size'],
 			ajax: {
 				url: attribs['url'],
 				dataType: 'json',
 				data: function (term, page) {
 					return {
 						q: term,
 						param: (attribs['querystring'] ? eval(attribs['querystring']) : ''),
 						page_limit: attribs['page_limit'],
 					};
 				},
 				results: function (data, page) {
 					return {results: data.result};
 				},
 			},
 			initSelection: function(element, callback) {
 				var id=$(element).val();
 				if(id!=="") {
 					$.ajax(attribs['url'] + id, {
// 		if(isset($attribs['querystring_in_init']) && $attribs['querystring_in_init'] &&
// 				isset($attribs['querystring']) && $attribs['querystring']) {
// 						data: { $attribs['querystring'] },
// 		}
 						dataType: "json"
 					}).done(function(data) { callback(attribs['multiple'] ? data.result : data.result[0]); });
 				}
 			},
 			formatResult: function(obj) { return obj.text; },
 			formatSelection: function(obj) { return obj.text; },
 			dropdownCssClass: "bigdrop",
 			escapeMarkup: function (m) { return m; },
 		});
		
 		if(!!attribs['sortable']) {
 			$(this).select2("container").find("ul.select2-choices").sortable({
 				containment: 'parent',
 				start: function() { $(this).select2("onSortStart"); },
 				update: function() { $(this).select2("onSortEnd"); },
 			});
 		}
 		
 		$(this).data('initialized', true);
	});
}


function initSwitchCheckbox() {
	$('*[data-type=switch-checkbox]').filterByData('initialized', false).each(function(i) {
		
		var attribs = $(this).data();
		
		var switchery = new Switchery(this, { color: attribs['cor'] });
		
 		$(this).data('initialized', true);
	});
}

function initDatepicker() {
	$('*[data-type=date-picker]').filterByData('initialized', false).each(function(i) {
		$(this).data('initialized', true);
		
		$(this).datepicker({
	        todayBtn: "linked",
	        keyboardNavigation: false,
	        forceParse: false,
	        calendarWeeks: true,
	        autoclose: true,
			todayHighlight: true,
	        language: $('#default-locale').val()
	    });
		
	});
}

function initInputNumber() {
	$('*[data-type=input-number]').filterByData('initialized', false).each(function(i) {
		$(this).data('initialized', true);
		$(this).mask($(this).attr('data-mask'), {reverse: $(this).data('mask-reverse')});
	});
}

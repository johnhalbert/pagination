function getTableData(form, formstart, formend, pagestart, pageend) {
	var formstart = formstart || 0;
	var formend = formend || 10;
	var pagestart = pagestart || 1;
	var pageend = pageend || 7;
	$.post('/tables/retrieve', form, function(resp){
		postResponse(resp, formstart, formend, pagestart, pageend);
	});
}

function postResponse(resp, formstart, formend, pagestart, pageend) {
	var resp = JSON.parse(resp);
	if (resp.length > 0) {
		if (resp.length < 10) {
			buildTable(resp, formstart, resp.length);
			buildPagination(resp, pagestart, 1);
		} else {
			if (Math.ceil(resp.length/10) > 10) {
				if (Math.ceil(resp.length/10) < pageend) {
					var pageend = Math.ceil(resp.length/10);
				} else {
				var pageend = pageend || 7;
				}
			} else {
				var pageend = Math.ceil(resp.length/10);
			}
			if (resp.length > formend) {
				var formend = formend;
			} else {
				var formend = resp.length-1;
			}
			buildTable(resp, formstart, formend);
			buildPagination(resp, pagestart, pageend);
		}
	}
}

function buildTable(resp, start, end) {
	var table = '<table class="table table-striped"><thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Registered Datetime</th><th>Email</th></thead><tbody>';
	for (var i = start; i < end; i++) {
		table += '<tr>';
		table += '<td>'+resp[i]['leads_id']+'</td>';
		table += '<td>'+resp[i]['first_name']+'</td>';
		table += '<td>'+resp[i]['last_name']+'</td>';
		table += '<td>'+resp[i]['registered_datetime']+'</td>';
		table += '<td>'+resp[i]['email']+'</td>';
		table += '</tr>';
	}
	table += '</tbody></table>';
	$('#table').html(table);
}

function buildPagination (resp, start, end) {
	var start = start || 1;
	if (resp.length > 70) {
		var end = end || 7;
	} else {
		var end = end || Math.ceil(resp.length/10);
	}
	var pagination = '<ul id="pagelink">';
	for (var j = start; j <= end; j++) {
		pagination += '<li class="page" id="'+j+'">'+j+'</li>';
	}
	pagination += '</ul>';
	$('#pages').html(pagination);
	paginationClick()
}

function paginationClick() {
	$('.page').click(function(){

		var pagenum = $(this).attr('id');
		var form = $('form').serialize();
		var pagestart;
		var pageend;
		if (pagenum > 4) {
			pagestart = +pagenum-3;
			pageend = +pagenum+3;
		} else {
			pagestart = 1;
			pageend = 7;
		}
		getTableData(form, pagenum*10-10, pagenum*10, pagestart, pageend);

	})
}

$(document).ready(function(){

	$('.datepicker').datepicker();

	var form = $('form').serialize();
	getTableData(form);


	$('form').keyup(function(){
		var form = $('form').serialize();
		getTableData(form);
	});

	$('.datepicker').change(function(){
		var form = $('form').serialize();
		getTableData(form);
	});

})
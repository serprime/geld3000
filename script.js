function toggleMonth(elem_id){
	
	var display = ($("#"+elem_id).css('display'));
	if(display == 'none') {
		$("#"+elem_id).show("slow");
		openArrow(elem_id);
	} else {
		$("#"+elem_id).hide("slow");
		closeArrow(elem_id);
	}
}


function openArrow(elem_id) {
  console.log('openArrow: ' + elem_id);
  var arrow = $('#span_'+elem_id).find('span.arrow');
  arrow.removeClass('closed');
  arrow.addClass('open');
}

function closeArrow(elem_id) {
  console.log('closeArrow: ' + elem_id);
  var arrow = $('#span_'+elem_id).find('span.arrow');
  arrow.removeClass('open');
  arrow.addClass('closed');
}


function edit(id) {
  $('#edit-form').show();
}

function editEntry() {
  // get values from form
  // post back to server with entry id
  // close dialog if success
}

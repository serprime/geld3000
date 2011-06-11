function toggleMonth(elem_id){
	
	var display = ($("#"+elem_id).css('display'));
	if(display == 'none') {
		$("#"+elem_id).show("slow");
	} else {
		$("#"+elem_id).hide("slow");
	}
}


function edit(id) {
  $('#edit-form').show();
}

function editEntry() {
  // get values from form
  // post back to server with entry id
  // close dialog if success
}

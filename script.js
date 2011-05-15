function toggleMonth(elem){
	
	var display = ($(elem).css('display'));
	if(display == 'none') {
		$(elem).show("slow");
		//$(elem).css('display', 'inline');
	} else {
		$(elem).hide("slow");
		//$(elem).css('display', 'none');
	}
}
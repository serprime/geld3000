function toggleMonth(elem_id){
	
	var display = ($("#"+elem_id).css('display'));
	if(display == 'none') {
		$("#"+elem_id).slideDown("slow");
		openArrow(elem_id);
	} else {
		$("#"+elem_id).slideUp("slow");
		closeArrow(elem_id);
	}
}


function openArrow(elem_id) {
  console.log('openArrow: ' + elem_id);
  var arrow = $('#span_'+elem_id).find('span.arrow');
  var month = $('#span_'+elem_id+'.month');
  arrow.removeClass('closed');
  month.removeClass('closed');
  arrow.addClass('open');
  month.addClass('open');
}

function closeArrow(elem_id) {
  console.log('closeArrow: ' + elem_id);
  var arrow = $('#span_'+elem_id).find('span.arrow');
  var month = $('#span_'+elem_id+'.month');
  arrow.removeClass('open');
  month.removeClass('open');
  arrow.addClass('closed');
   month.addClass('closed');
}




function calcSum(id, val) {
     var valNow = $('#'+id).parent().find('.monthly-sum span').last().text();
    valNow = parseFloat(valNow);
    val = parseFloat(val);
    var oldVal = parseFloat($('#'+id).find('.value').text());
    var newVal = (val - oldVal) + valNow;
    
    newVal = newVal.toFixed(2);

    $('#'+id).parent().find('.monthly-sum span').last().text(newVal);
}

function calcDiff(id) {
  var val = parseFloat($('#'+id).find('.value').text());
  
  var valNow = $('#'+id).parent().find('.monthly-sum span').last().text();
  valNow = parseFloat(valNow);
  
  var both = $('#'+id).hasClass("both");
  if(both) {val = val/2;}
  
  var newVal = valNow - val;
  newVal = newVal.toFixed(2);

  $('#'+id).parent().find('.monthly-sum span').last().text(newVal);
}




function showErrorMessage(message) {
    console.log(message);
    $('.message.error').text(message);
    $('.message.error').fadeIn('slow');
}

function showSuccessMessage(message) {
    $('.message.success').text(message);
    $('.message.success').fadeIn('slow');
}




function deleteEntry(id) {
  $.ajax({
    url: "index.php?ajax_delete",
    data: "delete_id="+id,
    success: function(msg){
      if(msg != '-1') {
        var obj = JSON.parse(msg);
        // refresh sum of month and rmeove item
        
        calcDiff(id);
        $('#'+id).remove();
        // refresh diff value on top
        $('#diff').find('.diff_value').html('€ ' + obj.diffAmount);
        $('#diff').find('.diff_name').html(obj.diffUsername);
        showSuccessMessage("Eintrag wurde gelöscht!");
      } else {
         showErrorMessage("Eintrag konnte nicht gelöscht werden, weil der Vielieb so langsam ist!");
      }
    },
    error: function() {showErrorMessage("Fehler bei der Kommunikation mit dem Server!");}
  });
}

function addEntry() {
    console.log('add entry');
    var value = $('#addValue').val();
    var note = $('#addNote').val();
    var both = $('#both').prop('checked');
    if (both) {both = "on"}
    else {both = "off"}
    $.ajax({
      url: "index.php?ajax_add",
      type: "POST",
      data: "value="+value+
            "&notes="+note+
            "&both="+both,
      success: function (data) {
        if(data == '-1') {
          showErrorMessage("Eintrag konnte nicht eingetragen werden!");
        } else {
          window.location.reload();
        }
      },
      error: function() {showErrorMessage("Fehler bei der Kommunikation mit dem Server!");}
    });
}

function editEntry() {
  var post_id =  $('#edit-form').find('form').attr('class');
  
  var value = $('#edit_value').val();
  var note = $('#edit_note').val();
  var both = $('#edit_both').prop('checked');
  
  $.ajax({
    url: "index.php/?edit_post="+post_id,
    type: "POST",
    data: "value="+value+"&note="+note+"&both="+both,
    success: function (data) {
      if (data != "-1") {
        var obj = JSON.parse(data);
        calcSum(post_id, value);
        $('#overlay').fadeOut('slow');
        $('#diff').find('.diff_value').html('€ '+obj.diffAmount);
        $('#diff').find('.diff_name').html(obj.diffUsername);
        var container = $('#'+post_id);
        if (both==true) {value = value + " / 2";}
        container.find('.value').html(value);
        container.find('.comment').html(note);
        
        container.find('.both').html("[f&uuml;r "+obj.other+"]");
        showSuccessMessage("Eintrag wurde erfolgreich geändert");
      } else {
        showErrorMessage("Fehler am Server.");
      }
    },
    error: function() {showErrorMessage("Fehler bei der Kommunikation mit dem Server!");}
  });
   
   /*
   $.getJSON("index.php/?edit_post="+post_id+"&value="+value+"&note="+note,function(msg){
           if(msg != '-1') {

                calcSum(post_id, value);
                $('#overlay').fadeOut('slow');
                $('#diff').find('.diff_value').html('€ '+msg.diffAmount);
                $('#diff').find('.diff_name').html(msg.diffUsername);
                var container = $('#'+post_id);
                container.find('.value').html(value);
                container.find('.comment').html(note);
                showSuccessMessage("Eintrag wurde erfolgreich geändert");
            } else {
            showErrorMessage("Eintrag konnte nicht geändert werden. BAM OIDA!");
        }
   });
   */
}


function edit(id) {
 var value = 0;
 var note = '';
 var both = true;
 $.getJSON("index.php/?post_id="+id, function(data) {

    value = data.value;
    note = data.note;
    both = data.both;
    $('#edit_value').val(value);
    $('#edit_note').val(note);
    $('#edit_both').prop('checked', both);
    var formi = $('#edit-form').find('form');
    formi.addClass(''+id+'');
    
 });
  $('#overlay').fadeIn('slow');
  centerPopup();
}

function closeEditDialog() {
    $('#overlay').fadeOut('slow');
}





function centerPopup(){
	var scrolledX, scrolledY;
	if( self.pageYoffset ) {
		scrolledX = self.pageXoffset;
		scrolledY = self.pageYoffset;
	} else if( document.documentElement && document.documentElement.scrollTop ) {
		scrolledX = document.documentElement.scrollLeft;
		scrolledY = document.documentElement.scrollTop;
	} else if( document.body ) {
		scrolledX = document.body.scrollLeft;
		scrolledY = document.body.scrollTop;
	}

	var centerX, centerY;
	if( self.innerHeight ) {
		centerX = self.innerWidth;
		centerY = self.innerHeight;
	} else if( document.documentElement && document.documentElement.clientHeight ) {
		centerX = document.documentElement.clientWidth;
		centerY = document.documentElement.clientHeight;
	} else if( document.body ) {
		centerX = document.body.clientWidth;
		centerY = document.body.clientHeight;
	}
	var popupHeight = $(".dialog-frame").height();
	var popupWidth = $(".dialog-frame").width();

	var leftoffset = scrolledX + (centerX - popupWidth) / 2;
	var topoffset = scrolledY + (centerY - popupHeight) / 2;

	//centering
	$(".dialog-frame").css({
		"position": "absolute",
		"top": topoffset,
		"left": leftoffset
	});
}

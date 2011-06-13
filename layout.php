<!DOCTYPE html>
<html>
  <head>
     <meta http-equiv="Content-type" content="text/html; charset=utf-8" /> 
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  <body>

     
      <div id="wrapper">
          <?php echo $this->content?>
      </div>
      <div id="overlay">
          <div id="edit-form">
              <div class="dialog-frame">
                <div class="dialog-header">
                  <span>Eintrag bearbeiten</span><span class="close right" onClick="closeEditDialog(); return false;" title="schließen">X</span>
                </div>
                <div class="dialog-body">
                  <form method="post" action="?">
                      <label for="betrag" class="eintrag_form_label left">Betrag</label>
                      <input class="left" id="edit_value" type="text" name="value" /><span class="euro left">€</span><br /><div class="clear"></div>
                      <label for="notes" class="eintrag_form_label left">Notes</label>
                      <textarea class="left" id="edit_note" name="notes"></textarea><br />
                      <input onClick="editEntry(); return false;" type="submit" name="edit_submit" class="right" value="" />
                  </form>
                </div>
              </div>
            </div>
       </div>
  </body>
</html>

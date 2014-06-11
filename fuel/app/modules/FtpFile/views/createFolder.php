<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style>
form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }
form{
	margin:15px;
	padding:10px;
	background-color:#CCC;
}
</style>
</head>

<body>
<form id="form" name="form" method="post" action="">
  <table width="500" border="0">
    <tr>
      <td colspan="3" align="left" style="padding-left:100px;"><h1>Create Folder</h1></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="10">&nbsp;</td>
      <td width="95">Folder Name:</td>
      <td width="381"><label for="textfield"></label>
      <input type="text" name="newName" id="newName" style="width:178px;" class="sendToServer" />
      <input type="hidden" name="currentPath" id="currentPath" value="<?php echo \Input::param('current_path');?>" class="sendToServer" />
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="left">
      
      <table width="60%" border="0" style="margin:5px;">
        <tr>
          <td width="28">&nbsp;</td>
          <td width="45"><div class="btn_75x26 ">
          <input type="button" value="Close" class="" >
        </div>
        </td>
          <td width="200">
          <div class="btn_75x26 ">
          <input type="button" name="btn_create" id="Create" value="Create"  class="sendToServer">
        </div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>

<script>
//jQuery(document).ready(function($){

	$('#Create').live('click',function(){
		if($('#newName').val()==''){alert('Add folder name'); return false;}
		var filter = {};
		var dp = $('form .sendToServer');
				
		$.each(dp, function(index, val){ 
				filter[$(this).attr('name')] = $(this).val(); 
		});
		
		 $.ajax({
				type: 'POST',
				url: '<?php echo Uri::create('FtpFile/CreateFolder');?>',
				data: filter,
				dataType: 'json',
				success: function(data){
					if(data.aaData==true){
						 parent.callFromChield();
						 parent.win_close(0,1);
					}else{
						alert('Directory already exists');
					}
				}
	
				
			});
	});

//});
</script>

<script>
$('form').keypress(function(e){ // Attach the form handler to the keypress event
    if(e.keyCode == 13) { // If the the enter key was pressed.
        //$('#aCloseDiv').click(); // Trigger the button(elementId) click event.
        $('#Create').click();
        return e.preventDefault(); // Prevent the form submit.
    }
}​);	

		
</script>
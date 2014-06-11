<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style>

form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }
#progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
#bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
#percent { position:absolute; display:inline-block; top:3px; left:48%; }

form{
	margin:15px;
	padding:10px;
	background-color:#CCC;
}
</style>
</head>

<body>

<form id="myForm" action="<?php echo \Uri::create('FtpFile/uploadFolder'); ?>" method="post" enctype="multipart/form-data">
  <table width="500" border="0">
    <tr>
      <td colspan="3" align="left" style="padding-left:300px;"><h1>Add File</h1></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="10">&nbsp;</td>
      <td width="95">Select File:</td>
      <td width="381"><label for="textfield"></label>
        <label for="fileField"></label>
             <input type="file" size="30" name="myfile">
<input type="hidden" name="currentPath" id="currentPath" value="<?php echo \Input::param('current_path');?>" class="sendToServer" />
      </td>
    </tr>
    <tr>
      <td colspan="3">
      
      
  <div id="progress">
        <div id="bar"></div>
        <div id="percent">0%</div >
</div>
<br/>


      
      
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
          <input type="button" value="Close" class="" onclick="parent.oTable.fnDraw();">
        </div>
        </td>
          <td width="200">
          <div class="btn_75x26 ">
          <input type="submit" name="btn_upload" id="Upload" value="Add File" class="sendToServer">
        </div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>


<script>
$(document).ready(function()
{
	var browserversion = detactbrowser(); //alert(browserversion);
	if(browserversion!=8){

			var options = { 
			beforeSend: function() 
			{
				$("#progress").show();
				//clear everything
				$("#bar").width('0%');
				$("#message").html("");
				$("#percent").html("0%");
			},
			uploadProgress: function(event, position, total, percentComplete) 
			{
				$("#bar").width(percentComplete+'%');
				$("#percent").html(percentComplete+'%');
		
			
			},
			success: function() 
			{
				$("#bar").width('100%');
				$("#percent").html('100%');
		
			},
			complete: function(response) 
			{
						parent.callFromChield();
						 parent.win_close(0,1);
			},
			error: function()
			{
				$("#message").html("<font color='red'> ERROR: unable to upload files</font>");
		
			}
			 
		}; 
			
				 $("#myForm").ajaxForm(options);
			}
		
		});

</script>

</body>
</html>


<script>

function detactbrowser(){
    var _browser = {};
            var uagent = navigator.userAgent.toLowerCase();
           // $("#result").html("User agent string: <b>" + uagent + "</b>");

            
            _browser.msie = /msie/.test(uagent);
            _browser.version = '';

            for (x in _browser)
            {
                if (_browser[x]) {            
                    _browser.version = uagent.match(new RegExp("(" + x + ")( |/)([0-9]+)"))[3];
					if(x=='msie'&& _browser.version==8){
						return 8;
					}else{
                        return 1;       
                	}
            }

          }
}
</script>
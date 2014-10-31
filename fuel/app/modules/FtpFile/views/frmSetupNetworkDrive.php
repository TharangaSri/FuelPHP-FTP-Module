<div id="frmSetupNetworkDrive_div">
<form action="<?php echo \Uri::create('FtpFile/frmSetupNetworkDrive');?>" method="post" >
<div class="entry">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center"><h1>Setup FTP </h1></td>
    </tr>
  <tr>
    <td align="right">IP address&nbsp;</td>
    <td><input type="text" name="txt_ip_address" class="sfield" id="txt_ip_address" style="width:200px;"  value="<?php if(isset($data)){echo $data['txt_ip_address'];}?>" />&nbsp&nbsp</td>
  </tr>
  <tr>
    <td align="right">Username</td>
    <td><label for="textfield"></label>
      <input type="text" name="txt_username" class="sfield" value="<?php if(isset($data)){echo $data['txt_username'];}?>"  id="txt_username" /></td>
  </tr>
  <tr>
    <td align="right">Password</td>
    <td><label for="textfield2"></label>
      <input type="password" name="txt_password" class="sfield"  id="txt_password" value="<?php if(isset($data)){echo $data['txt_password'];}?>"  /></td>
  </tr>
   <tr>
    <td align="right">Port</td>
    <td>
    <input type="text" name="txt_FTPport" class="sfield" value="<?php if(isset($data)){echo $data['txt_FTPport'];}?>"  id="txt_FTPport" /> 
    eg: 21
    </td>
  </tr>
  <tr>
    <td align="right">Timeout</td>
    <td>
        <input type="text" name="txt_FTPtimeout" class="sfield" value="<?php if(isset($data)){echo $data['txt_FTPtimeout'];}?>"  id="txt_FTPtimeout" /> eg:90
        </td>
    
  </tr>
 
  <tr>
    <td align="right">Passive</td>
    <td>
        <?php 
        echo \Form::select('sel_FTPpassive', @$data['sel_FTPpassive'], array('true'=>'True','false'=>"False") , array('class' => 'not_combo sfield'));
        ?>
    </td>
  </tr>
  <tr>
    <td align="right">ssl mode</td>
    <td>
       False
    </td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="80%" align="left" valign="bottom"><div class="btn_155x23">
          <input type="button"  id="testConnection" value="Test Connection" class="not_close"/>
          </div></td>
        <td width="12%" align="right"><table border="0" cellspacing="0" cellpadding="0">

          </table></td>
        <td width="8%">&nbsp;</td>
        </tr>
    </table></td>
    </tr>
</table>
</div>
</form>
</div>
<script>


$('#testConnection').on('click',function(){
	var ip_add = $('#txt_ip_address').val();
	var username = $('#txt_username').val();
	var password = $('#txt_password').val();
	if(ip_add!=''){
		if(username!=''){
			if(	password!=''){
				var filter = {};
            	var dp = $('form .sfield');
				$.each(dp, function(index, val){ 
						filter[$(this).attr('name')] = $(this).val();
										
				});
				filter['ajaxTest'] = 'TestConnection'; 
				 $.ajax({
                        type: $('form').attr('method'),
                        url: $('form').attr('action'),
                        data: filter,
                        dataType: 'json',
                        success: function(data){
 							alert(data.Data);
                        }
                    });
			}
		}
	}
	
});

$('input').on('change',function(){
	var ip_add = $('#txt_ip_address').val();
	var username = $('#txt_username').val();
	var password = $('#txt_password').val();
	if(ip_add!=''){
		if(username!=''){
			if(	password!=''){
				$('#testConnection').removeAttr('disabled');
			}
		}
	}else{
		$('#testConnection').attr('disabled','disabled');
	}
	
})

</script>
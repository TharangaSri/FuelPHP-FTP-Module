

<div id="FtpDiv">
 <div  style="margin:0px; ">
    <table width="100%" id="module_top_menuFTP" >
                    <tr class="pathboxtr">
                        <td width="106%" colspan="5">
                        <select style="width:99%;  margin:0px" id="SelectPath" class="not_combo" >
                          <option value="../">../</option>
                        </select>
                       
                       <input type="hidden" id="Hidden"  value="" name="Hidden" class="filter_field" />
                       <input type="hidden" id="PathBackHidden"   name="BackHidden" value="" class="filter_field" />
                        </td>
                    </tr>
                    <tr>

                    <tr class="pathboxtr">
                      <td colspan="5"><table width="95%" border="0">
                       <tr>
                         <td width="36">
                         
                         <a href="#"><img src=" <?php  $base = Uri::base(false);  echo $base .'assets/img/ftp/' ?>back.png" class="goBack"  style="border:0px;" /></a>
                         </td>
                         <td width="1145" valign="middle"><div class="current_path_show"></div></td>
                         <td width="36" align="right" valign="middle"><a href="#" id="refrishIcon"><img src=" <?php  $base = Uri::base(false);  echo $base .'assets/img/ftp/' ?>refresh-icon.png" alt="" class="refrishIcon"  style="border:0px;" /></a></td>
                         <td width="36" align="right">
                          <a href="#" id="CreateFolder"><img src=" <?php  $base = Uri::base(false);  echo $base .'assets/img/ftp/' ?>addf.png" class="CreateFolder"  style="border:0px;" /></a>
                        </td>
                        <td width="36" align="right">
                        <a href="#" id="btn_add_file"><img src=" <?php  $base = Uri::base(false);  echo $base .'assets/img/ftp/' ?>upf.png" class="addFile"  style="border:0px;" /></a>
                    
                        </td>
                       </tr>
                     </table></td>
                    </tr>
                </table>
<?php /*?><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl_grid_head_admin" style="text-decoration:underline;">
  <thead>
    <tr>
    <td width="%" data="#col1" >icon</td>
      <td width="25px" align="center" data="#col2" >Name</td>
      <td width="" align="center" data="#col3" >Type</td>
      <td width="" align="center" data="#col4" >Action</td>

    </tr>
  </thead>
</table><?php */?>
</div>

 <div id="grid_boxFTP">
   <table class="datatable" width="100%"  >
     <thead>
		<tr>
            <th id="col1" width="" ></th>
            <th id="col2" width="" ></th>
            <th id="col3" width="25px" ></th>
            <th id="col4" width=""></th>
            <th id="col5" width=""></th>
                    
			
		</tr>
	</thead>

</table>

<hr id="refs" />
 </div>
 <div id="taskbar"><table width="100%" border="0">
  <tr>
    <td width="70%">&nbsp;</td>
    <td width="19%">&nbsp;</td>
    <td width="11%"> <div class="btn_75x26 " style="margin-top:10px;">
   <input type="button" value="Close" class="not_close"/>
 </div></td>
  </tr>
</table>


 </div>
</div>

<ul id="myMenu" class="contextMenu">
			<li class="editm separator"><a href="#edit">Rename</a></li>
			<li class="cut separator"><a href="#cut">Cut</a></li>
			<li class="copy"><a href="#copy">Copy</a></li>
			<li class="paste"><a href="#paste">Paste</a></li>
			<li class="delete"><a href="#delete">Delete</a></li>
            <li class="download"><a href="#download">Download</a></li>
            <li class="refresh"><a href="#refresh">Refresh</a></li>
			<li class="quit separator"><a href="#quit">Quit</a></li>
		</ul>


<script type="text/javascript">



//-------------------------------------------------------------------------------------



$.fn.dataTableExt.oApi.fnStandingRedraw = function(oSettings) {
    //redraw to account for filtering and sorting
    // concept here is that (for client side) there is a row got inserted at the end (for an add)
    // or when a record was modified it could be in the middle of the table
    // that is probably not supposed to be there - due to filtering / sorting
    // so we need to re process filtering and sorting
    // BUT - if it is server side - then this should be handled by the server - so skip this step
    if(oSettings.oFeatures.bServerSide === false){
        var before = oSettings._iDisplayStart;
        oSettings.oApi._fnReDraw(oSettings);
        //iDisplayStart has been reset to zero - so lets change it back
        oSettings._iDisplayStart = before;
        oSettings.oApi._fnCalculateEnd(oSettings);
    }
      
    //draw the 'current' page
    oSettings.oApi._fnDraw(oSettings);
};




//--------------------------------------------------------------------------


	var oTable;
	//var orderby = 1;
	

	 oTable = $('.datatable').dataTable( {
			//"callback": function () {fnClickAddRow() }, // or some other function
			"callback": function () { $(".dataTables_processing").css('visibility', 'hidden');/* $('.dis_check').attr('disabled',true);*/ }, 
			"bProcessing": true,
			"bServerSide": true,
			"bJQueryUI": false,
			"bFilter" : false,
                  
                        'iDisplayLength':100,
						
                         "aoColumnDefs": [ { "bSortable": false, "aTargets": [  0, 1, 2, 3, 4] } ],
						 "aoColumns": [			 
						 						 {"sClass": "hidetd"}
											  ,  {"sClass": "hidetd"}
											  ,  {"sClass": "ftpgrid"} 
											  ,	 {"sClass": "ftpgrid"} 
											  ,  {"sClass": "ftpgrid"}  

                                ],
			"sAjaxSource": "<?php echo \Uri::create('FtpFile/loadList'); ?>",
			 "fnDrawCallback": function( oSettings ) {
				$(".datatable tbody tr ").contextMenu({
						menu: 'myMenu'},
						function( action, el, pos ) {//console.log(el)
							var fileFolderName;
							var extension;
							var filenameWithoutExtension;
							
							var aData = oTable.fnGetData( el.context ); //alert(aData[0])
							if(typeof aData === 'undefined' || aData === null)
							{
							}else{
								var fileFolderName = aData[0]; //alert(fileFolderName)
								var extension	=	aData[1];//alert(extension)
								var filenameWithoutExtension = fileFolderName.split(extension); //alert(filenameWithoutExtension[0])
								filenameWithoutExtension = filenameWithoutExtension[0];
							}
							
							if(action == 'delete'){
									callDelete(fileFolderName,extension);
							}
							if(action == 'edit'){ 
									callRename(fileFolderName,filenameWithoutExtension,extension);
							}
							if(action =='copy'){
									copy(fileFolderName,extension,'copy');	
							}
							if(action=='cut'){
									copy(fileFolderName,extension,'cut');
							}
							if(action=='paste'){
								paste();
							}
							if(action=='download'){ 
								DownloadFile(fileFolderName,extension);
							}//alert(action)
							if(action=='refresh'){
								updateGrid();
							}
					
						});
	
				 
				},
			
			"fnServerParams": function ( aoData ) {
			
				var df = $('.filter_field');
									
					var filter = {};
					
					$.each(df, function(index, val){
						if($(this).val() !== null) {
							aoData.push( {"name": "Path"+$(this).attr('name'), "value": $(this).val()} );
							filter['Path'+$(this).attr('name')] = $(this).val();
						}
					});
					
						$.ajax({
						url: "<?php echo \Uri::create('FtpFile/getCurrentPath'); ?>",
						type: "GET",
						dataType: 'json',
						data: filter,
						success: function(data){
								//alert(data.aaData); 
								if(data.aaData==10)
								{
									alert("FTP connection fail");
									return false;
								}
								$('#SelectPath').append('<option value="'+data.aaData+'">'+data.aaData+'</option>');

								if(data.aaData=='../'){
									$('#Hidden').val(''); 
								}else{
									$('#Hidden').val(data.aaData); 
								}
								$('.current_path_show').html(data.aaData);  
								$('#SelectPath').val(data.aaData);                                          
							}
						});
			
			
			 },
			 "fnInitComplete": function(oSettings, json) {
				$('#PathBackHidden').val(' '); 		
			}
			
			
			
	

		});

		$(".datatable").delegate("tr", "click", function(e) {
			
			var findSelect = $('.selected');
			$.each(findSelect,function(){
				$(this).removeClass('selected');
			});
			$(this).addClass('selected');

		})
		
		$('.refrishIcon').on('click',function(){
			oTable.fnDraw();
		});
		
		
		$(".datatable").delegate(".openLinkD", "dblclick", function(e) {

			$('#PathBackHidden').val($('#Hidden').val());
			
			var linkD = $(this).attr('text');
			//$('#').val(linkD);
			$('#SelectPath').append('<option value="'+linkD+'">'+linkD+'</option>');
			$('#Hidden').val(linkD);
			$('.current_path_show').html(linkD);
			oTable.fnDraw();
		});
		
		$(".datatable").delegate(".goBack", "click", function(e) { 
			$('#PathBackHidden').val('goBack');
			   oTable.fnDraw();
		});
		
		
		//goback button
		$('.goBack').on('click',function(){
			$('#PathBackHidden').val('goBack');
			   oTable.fnDraw();
		});
		
			
		function SelectCurrentPath(){
			var currentPath = $('#Hidden').val();
			parent.SetFTPpath(currentPath);
			return true;
		}
		
		
		$(".datatable").delegate(".addToSystem", "dblclick", function(e) {
			alert('hi')
		});
		
		
		$('#CreateFolder').on('click',function(){
			var currentPath = $('#Hidden').val();
			
			w="300"; h="150"; title="Create New Folder";
	 		url="<?php echo \Uri::create('/FtpFile/createFolder_view/?current_path=');?>"+currentPath;
	  		parent.load_window(h,w,title,url);
		});
		
		
		$('#btn_add_file').on('click',function(){
			var currentPath = $('#Hidden').val();
			
			w="430"; h="200"; title="Add File" ;maximize=0 ;
	 		url="<?php echo \Uri::create('/FtpFile/uploadfile_view/?current_path=');?>"+currentPath;
	  		parent.load_window(h,w,title,url);
		});
		
		
		$('#SelectPath').on('change',function(){
			$('#Hidden').val($(this).val());
			oTable.fnDraw();			
		});
		
	function updateGrid(){
		setTimeout("oTable.fnDraw();",500);
	}
		

		
	function callDelete(paradata,extension){
		var conform = confirm('Are you sure? you want to delete this"'+paradata+'"?');// alert(conform)
		if(conform==true){
			
			var filter = {};
			var deletePath= paradata;
			var currentPath =$('#Hidden').val();
			 $.ajax({
					type: 'POST',
					url: '<?php echo Uri::create('FtpFile/delete/?deletePath=');?>'+deletePath+'&currentPath='+currentPath+'&ext='+extension,
					dataType: 'json',
					success: function(data){
						if(data.aaData==1){
								oTable.fnDraw();
						}else{
							alert('Error: delete failed');	
							return false;
						}
					}
				});	
		}
	}
	
	
	function callRename(paradata,filename,exe){
			var currentPath = $('#Hidden').val();
			
			w="430"; h="200"; title="Rename file" ;maximize=0 ;
	 		url="<?php echo \Uri::create('/FtpFile/rename_view/?current_path=');?>"+currentPath+'&filename='+filename+'&exe='+exe;
	  		parent.load_window(h,w,title,url);
	}
			
	var copyPath ='';
	var copyFileName ='';
	var cut ='';
	
	function copy(pathSet,extension,copyOrCut)
	{	
		copyFileName = pathSet;
		cut = copyOrCut; //alert(cut)
		if(extension=='folder')
		{
			copyPath = $('#Hidden').val()+pathSet;
		}else{
		
			if( $('#Hidden').val()=='../')
			{
				copyPath = $('#Hidden').val()+pathSet;
			}else{
				copyPath = $('#Hidden').val()+'/'+pathSet;
			}
		}
			//copyPath = $('#Hidden').val()+'/'+pathSet;
			//alert(copyPath)
			return true;	
	}
	
	
	
	function paste(){
		//alert(copyPath)
		if(copyPath!=''){
			var filter = {};
			var prm_copyPath= copyPath;
			var prm_currentPath = $('#Hidden').val()+'/'+copyFileName;
			$.ajax({
					type: 'POST',
					url: '<?php echo Uri::create('FtpFile/copy_paste/?prmCopyPath=');?>'+prm_copyPath+'&prmPastePath='+prm_currentPath+'&cut='+cut,
					dataType: 'json',
					success: function(data){
						if(data.aaData==1){
							oTable.fnDraw();
							copyPath ='';
							copyFileName ='';
							cut ='';	
						}else{
							alert('Error: paste failed');	
							return false;
						}
					}
				});	
				
		}
	}
	
	
	function DownloadFile(fileName,extension){
		//alert(copyPath)

			var filter = {};
			var filePath = $('#Hidden').val()+'/'+fileName;
			$.ajax({
					type: 'POST',
					url: '<?php echo Uri::create('FtpFile/download/?filePath=');?>'+filePath+'&fileName='+fileName+'&extension='+extension,
					dataType: 'json',
					success: function(data){
						if(data.aaData==0){
							alert('Error: Downlaod failed');	
							return false;
						}else{
							window.location=data.aaData;
						}
					}
				});	
	}

</script>

<script type="text/javascript">
	
	
	$(document).ready(function() {
		var lastIdx = null;
		var table = $('.datatable').DataTable();
		 
		$(".datatable").delegate("tr", "mouseover", function(e) { 
		//$('.datatable tr').on( 'mouseover',  function () {
				$(this).addClass( 'highlight' );

			})
			$('.datatable tbody').on( 'mouseleave', 'tr', function () {
				$(this).removeClass( 'highlight' )
				//$( table.cells().nodes() ).removeClass( 'highlight' );
			});
			
	} );
		


		</script>

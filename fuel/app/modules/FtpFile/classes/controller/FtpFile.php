<?php

namespace FtpFile;

class Controller_FtpFile extends \Controller_Base {

    public $ftp;
    public $dirPath;
    
    function __construct() {
         	
        // create an ftp object, but don't connect
        $this->ftp = \Fuel\Core\Ftp::forge(array(
            'hostname' => \Session::get('Settings.txt_ip_address'),
            'username' => \Session::get('Settings.txt_username'),
            'password' => \Session::get('Settings.txt_password'),
            'timeout'  => \Session::get('Settings.txt_FTPtimeout'),
            'port'     => \Session::get('Settings.txt_FTPport'),
            'passive'  => \FtpFile\Controller_FtpFile::trueFalse(\Session::get('Settings.sel_FTPpassive')),
            'ssl_mode' => false,
            'debug'    => false
        ), false);

        // do some stuff here

        // now connect to the server
        return $this->ftp->connect();
    }
    
      function  testConnect() {
         	
        // create an ftp object, but don't connect
        $this->ftp = \Fuel\Core\Ftp::forge(array(
            'hostname' => \Session::get('Settings.txt_ip_address'),
            'username' => \Session::get('Settings.txt_username'),
            'password' => \Session::get('Settings.txt_password'),
            'timeout'  => \Session::get('Settings.txt_FTPtimeout'),
            'port'     => \Session::get('Settings.txt_FTPport'),
            'passive'  => \FtpFile\Controller_FtpFile::trueFalse(\Session::get('Settings.sel_FTPpassive')),
            'ssl_mode' => false,
            'debug'    => false
        ), false);

        // do some stuff here

        // now connect to the server
        return $this->ftp->connect();
    }
    
    
    public  function trueFalse($value){
        if($value=='true'){
            return true;
        }else{
            return false;
        }
    }
    
    
    
    
    
    function action_frmSetupNetworkDrive(){
        
        if(\Input::param('ajaxTest')){
            $data = \Input::all();
            \Session::set('Settings',$data);
            if($this->testConnect()){
                
                $json = array(
                    //  'sEcho' => (int) \Input::get('sEcho'),
                      'success' => 'success',
                      'Data' => 'Successfully Connect!',
                  );
              echo json_encode($json);exit;

             }else{
               $json = array(
                //  'sEcho' => (int) \Input::get('sEcho'),
                  'success' => 'success',
               // 'Data' => $ftpConnect,
                  'Data' => 'Connection Fail!',
                  );
              echo json_encode($json);exit; 
            }
        }
        
        $data = \Session::get('Settings');
        $this->set_filebrowser_template();
        $view = \View::forge('frmSetupNetworkDrive');
        $view->set('data',$data);
        $this->template->content = $view;
    }
    
    
    /**
     * Quote listing
     * @return [type] [description]
     * 
     */
    function action_index()
    {
       $this->set_filebrowser_template();
        $view = \View::forge('files');
        $this->template->content = $view;
    }
    

    
    function action_loadList(){
        
        $path = '';
        $pathHidden = ''; 
        $pathset = '';
        $PathBackHidden=\Input::param('PathBackHidden');
        
        if(\Input::param('PathBox')){}
        if(\Input::param('PathHidden')){$path = \Input::param('PathHidden');}
        
        
        if($PathBackHidden=='goBack'){
            $setback = explode('/', $path); 
            foreach ($setback as $key => $value) {
                  if($value==''){unset($setback[$key]);}
            }
            for($x=0;$x<count($setback);$x++){
              if($x!=count($setback)-1){     
                $pathset .= $setback[$x].'/';
              }

            }
            $path = $pathset;    
        }
        //$files = array();
        $this->dirPath = $path;
       // $files = $this->ftp->list_files($path);
        
         if ( $files = $this->ftp->list_files($path) === false)
        {
            $json = array(
                'success'=>'success',
                'aaData' => '',
             );
            echo json_encode($json);
            $this->ftp->close();
            exit;
        }else{
             $files = $this->ftp->list_files($path);
        }
        
        
        
       // echo print_r($files); exit;
        $array = array();
        $x=0;
        $data = array();
        if(count($files)>=1){
            foreach($files as $val) {
                    $key = 'k'.$x;
                    $ext = 'e'.$x;

                 $fext = pathinfo($val, PATHINFO_EXTENSION);
                 switch ($fext){
                    case "png": $extn="PNG Image"; break;
                    case "jpg": $extn="JPEG Image"; break;
                    case "svg": $extn="SVG Image"; break;
                    case "gif": $extn="GIF Image"; break;
                    case "ico": $extn="Windows Icon"; break;

                    case "txt": $extn="Text File"; break;
                    case "log": $extn="Log File"; break;
                    case "htm": $extn="HTML File"; break;
                    case "php": $extn="PHP Script"; break;
                    case "js": $extn="Javascript"; break;
                    case "css": $extn="Stylesheet"; break;
                    case "pdf": $extn="PDF Document"; break;

                    case "zip": $extn="ZIP Archive"; break;
                    case "bak": $extn="Backup File"; break;

                    case "doc": $extn="Word File"; break;
                    case "docx": $extn="Word File"; break;
                    case "dot": $extn="Word File"; break;

                    default: $extn=strtoupper($fext)." Folder"; break;
                  }


                  if($fext==''){$fext='folder';}
                  $fextdiv = '<div class="'.$fext.'" ></div>';
                  $valText = $val;
                  if($path!=''){
                    $valEx = explode($path,$val);
                    if(isset($valEx[1])){$valText   = $valEx[1];}else{$valText='';}
                  }
                  
                  $valText = explode('/',$valText); //
                  if(isset($valText[1])){$valText   = $valText[1];}else{$valText   = $valText[0];}
                   // print_r($valText);exit;
                    
                  if($fext=='folder'){
                     $valuA   = '<a style="width:300px; height:15px;" class="openLinkD " href="#" text="'.$val.'">'.$valText.'</a>';
                    
                  }else{
                       $valuA   = '<a style="width:300px; height:15px;" class="addToSystem" href="#" text="'.$val.'">'.$valText.'</a>';
                  }
                  $base = \Uri::base(false);
                  //$action = '<a onClick="callDelete('."'".$valText. "','" .$extn."'".')" title="'.$valText.'"  class="delete"><img src="'. $base .'assets/img/ftp/del.png" class="delete_f"/></a>';

                  $fextwithDot = '.'.$fext;
                  $removeExt = explode($fextwithDot, $valText); 
                  if(isset($removeExt[0])){
                    $removeExt = $removeExt[0];
                  }  else {
                    $removeExt = $removeExt[1];    
                  }
                 // $action = '<a onClick="callRename('."'".$valText. "','" .$removeExt. "','" .$fext."'".')" title="'.$valText.'"  class="rename"><img src="'. $base .'assets/img/ftp/edit.png" class="edit"/></a>';
                 /// $action_rename ='<div class="btn_date_50x22" ><input type="button" value="Rename" class="" onClick="callRename('."'".$valText. "','" .$removeExt. "','" .$fext."'".')" /></div>';
                    $data[] = array(
                        $valText,
                        '.'.$fext,
                        $fextdiv,
                        $valuA,
                        $extn
                        );
            }
        }

        
        
        $json = array(
          //  'sEcho' => (int) \Input::get('sEcho'),
            'iTotalRecords' => 1,
           'iTotalDisplayRecords' => 1,
            'aaData' => $data,
        );


         echo json_encode($json);
         $this->ftp->close();
         exit;
    }
    
    public function action_getCurrentPath(){
        if ( $files = $this->ftp->list_files($this->dirPath) === false)
        {
            $json = array(
                'success'=>'success',
                'aaData' => 10,
             );
            echo json_encode($json);
            $this->ftp->close();
            exit;
        }
        $path = '';
        $pathHidden = ''; //print_r(\Input::all());
        $pathset = '';
        $PathBackHidden=\Input::param('PathBackHidden');
        
        if(\Input::param('PathBox')){}//$path = \Input::param('PathBox');}
        if(\Input::param('PathHidden')){$path = \Input::param('PathHidden');}
        
        if($PathBackHidden=='goBack'){
            $setback = explode('/', $path); 
            foreach ($setback as $key => $value) {
                  if($value==''){unset($setback[$key]);}
            }
            for($x=0;$x<count($setback);$x++){
              if($x!=count($setback)-1){     
                $pathset .= $setback[$x].'/';
              }

            }
            $path = $pathset;    
        }
        $json = array(
          //  'sEcho' => (int) \Input::get('sEcho'),
            'success' => 'success',
            'aaData' => $path,
        );


         echo json_encode($json);exit;
    }

    public function action_createFolder_view(){
        $this->set_filebrowser_template();
        $view = \View::forge('createFolder');
        $this->template->content = $view;
        
    }
    
    public function action_CreateFolder(){
        $input = \Input::all();
        $newName    =   $input['newName'];
        $currentPath = $input['currentPath'];
        
        if(isset($input['btn_create'])){
        // Make a write-able uploads folder
            try{
                
                $create = @$this->ftp->mkdir($currentPath.'/'.$newName, 0777);
                
                $json = array(
                    'success' => 'success',
                    'aaData' => $create,
                );
          echo json_encode($json);exit;
         
            }catch(\Exception $e){
                echo $e.'fail';
                exit;
            }    
        }
    }
        
        
        
    public function action_uploadfile_view(){
        $this->set_filebrowser_template();
        $view = \View::forge('uploadFile');
        $this->template->content = $view;
        
    }
    
    
    public function action_uploadFolder(){
        $input = \Input::all();
        $fileName = $_FILES['myfile']['name'];
        $currentPath    =   $input['currentPath'];
        $upload_key='';
        $path = DOCROOT.'/ftp';
      
        ///\Nmi_File::upload_file($upload_key, $path, $config = array(), $required = false);
        
        // Custom configuration for this upload
        $config = array(
            'path' => $path,
            'randomize' => false,
        );

        // process the uploaded files in $_FILES
        \Upload::process($config);

        // if there are any valid files
        if (\Upload::is_valid())
        {
            // save them according to the config
            $webServerUpload = \Upload::save();
        }
        //sleep(15);  
        //print_r($webServerUpload); exit;
        //if($webServerUpload==true){
            try{
                // Upload myfile.html
                $saveFile = $this->ftp->upload($path.'/'.$fileName, $currentPath.'/'.$fileName, 'auto', 0775);
                if($saveFile==true){
                    unlink($path.'/'.$fileName);
                }
                 echo '<script> parent.callFromChield();  parent.win_close(0,1); </script>';
                 exit;
            } catch (Exception $ex) {
                echo $ex;
            }
        //}

        // and process any errors
        foreach (\Upload::get_errors() as $file)
        {
            // $file is an array with all file information,
            // $file['errors'] contains an array of all error occurred
            // each array element is an an array containing 'error' and 'message'
        }
        exit;
    }
    
    
    public function action_delete(){
        $input = \Input::all();
        $ext = trim($input['ext']);
        $path = $input['deletePath'];
        $currentPath = $input['currentPath'];
        $path  = $currentPath.'/'.$path;
        
        if($ext=='.folder'){
            // delete a folder with all it's contents
            if ( ! $this->ftp->delete_dir($path))
            {
                // delete failed
                echo 'error'; exit;
            }else{
                $json = array(
                    'success' => 'success',
                    'aaData' => 1,
                );
                
                echo json_encode($json); exit;
            }
            
        }else{
             // delete a file
            if ( ! $this->ftp->delete_file($path))
            {
                // delete failed
                echo 'error'; exit;
            }else{
                $json = array(
                    'success' => 'success',
                    'aaData' => 1,
                );
                
                echo json_encode($json); exit;
            }
        }
        
    }
    
    
    public function action_rename(){
        $input = \Input::all();
        $currentFileName = $input['currentFileName'];
        $currentPath    =   $input['currentPath'];

        $hid_exe    =   $input['hid_exe'];
        if($hid_exe=='.folder')
        {
            $newName    =   $input['newName'];
            $currentFileName = explode('.folder', $currentFileName);
            $currentFileName = $currentFileName[0];
        }else{
            $newName    =   $input['newName'].$hid_exe;
        }
        
        $currentfile = $currentPath.'/'.$currentFileName;
        $newNamePath = $currentPath.'/'.$newName;
        
       // echo $currentfile; echo '</br>'; echo $newNamePath;
        
        //$newPath = str_replace($currentFileName, $newName,$currentPath);
        //print_r($newPath); exit;
       // print_r($currentPath.$newName); exit;
        // rename the file
        $rename= $this->ftp->rename($currentfile, $newNamePath, false);
        if($rename==1){
             $json = array(
                    'success' => 'success',
                    'aaData' => 1,
                );
             echo json_encode($json); exit;
        }else{
            echo 0; exit;
        }
    }
        
        

    public function action_rename_view(){
        $this->set_filebrowser_template();
        $view = \View::forge('rename');
        $this->template->content = $view;
        
    }
    
    
    public function action_copy_paste(){
        $input = \Input::all();
        $copyFilePath = $input['prmCopyPath'];
        $pastePath    =   $input['prmPastePath'];
        $cutOrCopy = $input['cut']; //echo $cutOrCopy;
        $rename = 0;
        //echo $copyFilePath; echo '-----'; echo $pastePath;
        if($cutOrCopy=='copy')
        {
            $rename= $this->ftp->rename($copyFilePath, $pastePath, FALSE);
        }
        if($cutOrCopy=='cut'){
            $rename= $this->ftp->rename($copyFilePath, $pastePath, FALSE);
        }
        if($rename==1){
             $json = array(
                    'success' => 'success',
                    'aaData' => 1,
                );
             echo json_encode($json); exit;
        }else{
            echo 0; exit;
        }
    }
    
    public function action_download(){
        $input = \Input::all();
        $filePath = $input['filePath'];
        $fileName = $input['fileName'];
        $extension = $input['extension'];
        $localPath = DOCROOT.'ftp/'.$fileName;
        //echo $fileName; echo '----'; echo $localPath;
        // Download myotherfile.html
        $downlaod = $this->ftp->download($filePath, $localPath, 'ascii');
        sleep(10);
       // echo '<script> window.location="'.$localPath.'" </script>';exit;
  
        if($downlaod==1){
             $json = array(
                    'success' => 'success',
                    'aaData' => $localPath,
                );
             echo json_encode($json); exit;
        }else{
            $json = array(
                    'success' => 'success',
                    'aaData' => 0,
                );
             echo json_encode($json); exit;
        }
    }

        public function action_test_view(){
         $this->set_iframe_template();
        $view = \View::forge('test');
        $this->template->content = $view;
        
    }
   


    


}
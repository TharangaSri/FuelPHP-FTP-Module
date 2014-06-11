<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consclasser adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
        <meta http-equiv="X-UA-Compatible" content="IE=9" >
        
         <LINK REL="SHORTCUT ICON" HREF="<?php echo \Uri::base(false); ?>/assets/img/woodfin_logo.ico">
     <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
        

        <title><?php echo \Config::get('title'); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="wclassth=device-wclassth">
         <?php  $base = Uri::base(false); ?>
        
       <?php echo Asset::css('jquery-ui-1.10.2.custom.css'); ?>
        
        <?php echo Asset::css('datatables.css'); ?>
       <?php echo Asset::css('app.css'); ?>
        <?php echo Asset::css('ftp.css'); ?>
         <?php echo Asset::css('dashboard.css');?>
        
        <style>body{overflow: hidden;}</style>
       
        <script type="text/javascript"> APP = {}; APP.base_url = '<?php echo Uri::base(); ?>'; </script>

         
         <?php echo Asset::js('jquery-1.9.1.js'); ?>
         <?php echo Asset::js('jquery-migrate-1.2.1.min.js'); ?>
         <?php echo Asset::js('jquery-ui-1.10.2.custom.js'); ?>
         
         
          <!-- /// contextMenu ///// --> 
         <?php //echo Asset::js('contextMenu/jquery-1.4.2.min.js'); ?>
        <?php echo Asset::js('jquery.contextMenu.js'); ?>      
        <?php echo Asset::css('jquery.contextMenu.css'); ?>
        <!-- //////////////////////////////////////////-->
        
         <?php echo Asset::js('jquery.dataTables.js'); ?>  
        <?php echo Asset::js('jquery.h5validate.js'); ?>   
        <?php echo Asset::js('ajaxUpload.js');?>
         <?php echo Asset::js('dashboard.js');?>
        <?php echo Asset::js('app.js'); ?>
         
        
       

        
        <?php if(isset($template_js) and !empty($template_js)) echo Asset::js($template_js); ?>

    </head>

<body>
	<div id="wrap">
		<h1 class="app_title">FuelPHP FTP File Manager</h1>
		
	  <h2>MAIN MENU</h2>
		<p>Welcome<br>
		  Please make a selection from the menu.</p>
          
          <div id="dash_back" class="dash_back_small" >
		<ul class="icons_grid">
			
<li class="contacts">
				<a  class="win" url="#" win_width="1100" win_height="650" id="btn1" type="button" title="frmInsertExam" win_scrolling="0"  win_resize="0" href="<?php echo \Uri::create('FtpFile'); ?>"><?php echo \Asset::img('dashboard/Smart-FTP-icon.png'); ?>
					<span>FTP Manager</span>
				</a>
			</li>
			
			
    </ul>
        <p  style="text-align: right; font-size:12px; margin-top: 350px;">
		<?php Config::load('deployment', true); ?>
                <?php echo Config::get('deployment.version_number'); ?>    <?php echo Config::get('deployment.timestamp'); ?>  | <?php echo Config::get('deployment.version'); ?>  
            </p>
            
		
        
		
	</div>
	
</body>
</html>
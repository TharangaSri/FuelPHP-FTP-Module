/* APP WIDE JS */
jQuery(document).ready(function($){


        /*
         *export to excel
         */
        var original_object;

           
        
        /*
         *floating window close
         */
        $('.winclose').attr('Onclick','parent.win_close(0,1)');
        $('input[value="Close"],input[value="Cancel"],input[value="Close"],input[value="Cancel/Close"],.closeform').on('click',function(){
            if($(this).hasClass('not_close')){
               /// parent.dt.fnDraw();
            }else{
                
                parent.pageupdate();

            }
        });
       
        
  
          
          /*
           *Datatable table hedder click event
           */
          $('#tbl_grid_head td ').on('click',function(){
              if($(this).attr('data')){
                var click_name = $(this).attr('data'); 
                $(click_name).click();
                $('#tbl_grid_head td').css('color', '#000000');
                $(this).css('color', '#0209c7');
              }
              
          })
          
          $('#tbl_grid_head td').each(function(){
                if($(this).attr('data')){
                    $(this).css('text-decoration', 'underline');
                }
            })



        
        /*
         *Message Close
         */
        $('.close').click(function(){
            $('.alert-message').fadeOut("slow");
        });
        
        if($('.alert-message')){
             setTimeout(function(){
                 $('.alert-message').fadeOut("slow");}, 1700); 
        }
        
 
        
        
        
    
        
    
            /**
             * Global Disable submit buttons inmiddle of ajax calls
             */
            $('input[type=submit]').ajaxStart(function() {
              $(this).attr('disabled', 'disabled');
            }).ajaxComplete(function() {
              $(this).removeAttr('disabled');
            });
            
            
           
            $(document).ajaxStart(function() {
                
                    $('#ajax-load').stop(true, true).animate({'right': 0}, 500);
                    $('input').attr('disabled', 'disabled');
                    $('text').attr('disabled', 'disabled');
                    $('textarea').attr('disabled', 'disabled');
                    $('button').attr('disabled', 'disabled');
                    $('select').attr('disabled', 'disabled');
                    
            }).ajaxComplete(function(){
                    $('#ajax-load').stop(true, true).animate({'right': -100});
                    setTimeout("$('input').removeAttr('disabled')",200);
                    $('text').removeAttr('disabled');
                    $('textarea').removeAttr('disabled');
                    $('button').removeAttr('disabled');
                    $('select').removeAttr('disabled');
                    
                   
            });
        
        
        //open window
        $('.win').on('click', function(){
            //dhtmlwindow.open("googlebox", "iframe", $(this).attr('href'),$(this).attr('title'), $(this).attr('win_width'),$(this).attr('win_height'),"resize=1,scrolling=1,center=1", "recal");
            if($(this).attr('win_height')!=''){var height = $(this).attr('win_height');}else{height = 250;}
            if($(this).attr('win_width')!=''){var width = $(this).attr('win_width');}else{width = 250;}
            if($(this).attr('title')!=''){var title = $(this).attr('title');}else{title = 'Title';}
            if($(this).attr('url')!=''){var url = $(this).attr('url');}else{url = '';}
            if($(this).attr('win_resize')!=''){var resize = $(this).attr('win_resize');}else{resize = 0;}
            if($(this).attr('win_scrolling')!=''){var win_scrolling = $(this).attr('win_scrolling');}else{win_scrolling = 1;}
            parent.load_window(height,width,title,url,resize,win_scrolling)

        })
        

});
      
       





$(window).load(function(){
    try{
            $('#header').animate({top:15}, 800);
    }catch(err){ return true;}
});





/**
 * Build a URL relative to base
 * @return {[type]} [description]
 */
function url(path) {
      try{
	return APP.base_url + path;
      }catch(err){ return true;}
}
 
            
var window_id=[];
var x=0;
 function load_window(h,w,title,url,resize,maximize,win_scrolling,closetrue){
   try{
	 if( typeof closetrue == 'undefined' ) {closetrue=0}
     w=parseInt(50)+parseInt(w);
     h=parseInt(50)+parseInt(h);
     
     var $iframeID = "ifrm-"+x;
     
     var $iframe = "<iframe id='"+$iframeID+"' width='"+w+"px' height='"+h+"px'></iframe>";
     
     var $divID = "div-"+x;
     
     var $div = "<div id='"+$divID+"' nameid='"+title+"'/>";
     
     var $iframeID = "#ifrm-"+x;
     
     var $divID = "#div-"+x;
     
     parent.$("#window_dialog").append($div);
     
     parent.$($divID).append($iframe);
     
     url = url.split('?');
    
     var pathUrl;
     
     for(u=0;u<url.length;u++){
         if(u==0){
            pathUrl = url[0]+'?';
        }
         if(u!=0){
            pathUrl = pathUrl+url[u];
        }
     }

     url = pathUrl+'&math='+Math.random()*Math.random();
     
     parent.$("#window_dialog "+$divID+" "+$iframeID).attr('src', url);
     
     parent.$($divID).attr('title', title)
      
    setTimeout(window_id[x]=parent.$($divID).dialog({
    
    autoOpen: true,
    modal: true,
    width:w,
    height:h,
    resize:resize,
    resizable: false      
              }),10000);
       
     if(closetrue==0){$(".ui-dialog-titlebar-close").hide();}     
     $('body').scrollTop();
     $('body').css('overflow','hidden')
     if(closetrue==0){parent.$(".ui-dialog-titlebar-close").hide();}
        parent.$('body').css('overflow','hidden')
        x++;
        
        }catch(err){ return true;}
    };
    
 
 
    
    
    
 /*
 *Page update
 */
function pageupdate(e){ 
 
 try{
    // alert(x)
   var m = x-2;
   //alert("#ifrm-"+m)

    var val = parent.$("#ifrm-"+m).attr("src");
    //parent.$("#ifrm-"+m).attr("src", currSrc);
	$( "#ifrm-"+m ).attr( 'src', function ( i, val ) { return val; });

        setTimeout("win_close()",50);
        return true;

 }catch(err){ return true;}
	//alert(err)
}


    
    

    function reset_win(){
        //alert('hi')
        try{

            $(".ui-dialog-title").text("");
            $("#window_dialog iframe").removeAttr('title');
            $("#window_dialog iframe").removeAttr('src');
        }catch(err){ return true;}
    };
    
    function savewinId(windialog){
        try{
            var winid = windialog;
         }catch(err){ return true;}
    }
    
   
    var close_set
    
    function win_close(){
        try{
            x = x-1;
            
            parent.$(window_id[x]).dialog('close');
            $('body').css('overflow','auto');
            
           // parent.$.domCache('#ifrm-'+x).remove();
            //arent.jQuery('#ifrm-'+x).empty();

            //parent.$('#ifrm-'+x).remove();
        }catch(err){ return true;}
 };
 
 function child_win_close(){
     s=0;
      try{
            s = x-2;
            parent.$(window_id[s]).dialog('close');
            parent.$('#ifrm-'+x).remove();
        }catch(err){ return true;}
 }



function detectBrowser() {
    try{
            var _browser = {};
            var uagent = navigator.userAgent.toLowerCase();
           // $("#result").html("User agent string: <b>" + uagent + "</b>");

            _browser.firefox = /mozilla/.test(uagent) && /firefox/.test(uagent);
            _browser.chrome = /webkit/.test(uagent) && /chrome/.test(uagent);
            _browser.safari = /applewebkit/.test(uagent) && /safari/.test(uagent) && !/chrome/.test(uagent);
            _browser.opera = /opera/.test(uagent);
            _browser.msie = /msie/.test(uagent);
            _browser.version = '';

            for (x in _browser)
            {
                if (_browser[x]) {            
                    _browser.version = uagent.match(new RegExp("(" + x + ")( |/)([0-9]+)"))[3];
                                if(x=='msie'&& _browser.version>=8){
                                }else{
                                        alert('This browser is not supported. Supported browsers are: IE8.');
                                        setTimeout("parent.location.reload()",30);
                    //$("#result").append("<br/>The browser is " + x + " " + _browser.version);
                    break;
                }
            }

          }
}catch(err){ return true;}



}

 


function callFromChield(){
                $('#ifrm-2')[0].contentWindow.updateGrid();
		return;
}

function SetFTPpath(currentPath){
    var h = x-2;
    alert(h)
     $('#ifrm-'+h)[0].contentWindow.addPath(currentPath);
		return;    
}


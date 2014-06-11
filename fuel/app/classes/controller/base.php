<?php

class Controller_Base extends Controller_Template
{
	public function before()
	{
		parent::before();

	
		
	}


        /**
	 * Set the template to iframe based, hide footer etc.
	 */
	public function set_filebrowser_template()
	{
		$body_classes = func_get_args();
		$this->template = \View::forge('template_filebrowser');
                $this->template->body_classes = (array) $body_classes;
                $this->template_init();
	}
        
        
        public function template_init()
	{
		//-----------------------------------------------------------
		// Load Module Based JS
		//-----------------------------------------------------------
		$controller = Str::lower(substr(Inflector::denamespace(Request::active()->controller), 11));
		$this->template->template_js = array();
		
		//load js
		if(\Asset::forge()->find_file("modules/{$controller}.js", 'js'))
		{
			$this->template->template_js[] = "modules/{$controller}.js";
		}

	}




}
/* EOF */
<?php

/**

 * @copyright	Copyright (c) 2015 AGP O3. All rights reserved.

 * @license		GNU General Public License version 2 or later; see LICENSE.txt

 */



// no direct access

defined('_JEXEC') or die;



jimport('joomla.plugin.plugin');



/**

 * CONTENT - Speedbumps Plugin

 *

 * @package		Joomla.Plugin

 * @subpakage	AGPO3.Speedbumps

 */

class plgContentSpeedbumps extends JPlugin {



	/**

	 * Constructor.

	 *

	 * @param 	$subject

	 * @param	array $config

	 */

	function __construct(&$subject, $config = array()) {

		// call parent constructor

		parent::__construct($subject, $config);



		JHtml::_('jquery.framework');



		$document = JFactory::getDocument();



		$social_networks = array("");

		$exclude_domains = array("");



		//Load jQuery

		if($this->params->get("include_jquery")) {

			JHtml::script(Juri::base() . 'plugins/content/speedbumps/js/jquery-1.11.1.min.js');

		}



		//Rest of the libraries

		JHtml::script(Juri::base() . 'plugins/content/speedbumps/js/speedbumps.js');



		//Load Styles

		JHtml::stylesheet(Juri::base() . 'plugins/content/speedbumps/css/overlay.css');



		if($this->params->get("custom_css")!="") {

			$document->addStyleDeclaration($this->params->get("custom_css"));

		}


		//Get custom Overlay Text

			$custom_text = 

				$this->params->get("custom_text") != "" ? 

					$this->params->get("custom_text") : 

					"You are about to visit <br>[link]<br>which is an external link.<br>Please confirm this action or close this window.";




		//Exclude selected domains

		if( $this->params->get("social_networks")!="" && $this->params->get("exclude_social_networks") ) {

			$social_networks = explode(",",str_replace(" ","",$this->params->get("social_networks")));

		}



		if($this->params->get("exclude_domains")!="") {

			$exclude_domains = explode(",",str_replace(" ","",$this->params->get("exclude_domains")));

		}



		$exclude = str_replace(array("[","]"),array("",""),json_encode(array_merge($exclude_domains, $social_networks)));



		//Start the plugin

		$document->addScriptDeclaration('

		    jQuery(document).ready(function(){

				var exclude = Array('.$exclude.');
				var custom_text = "'.str_replace("<br><br>","<br>",preg_replace( "/\r|\n/", "<br>", $custom_text )).'<br><br>";

		        jQuery("a").speedbumpLinks(exclude, custom_text);

		    });

		');

	}

}
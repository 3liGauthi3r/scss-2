<?php

/**
 * @package ddLightboxPlugin
 * 
 * @author David Durost
 * 
 */

/**
 *
 * @param string $name
 * @param string $url
 * @param array $opts
 * @return string 
 */
function lb_link_to($name,$url,$lnk_opts = array(), $lb_opts = array()) {
  if(!isset($lb_opts['width'])) $lb_opts['width'] = sfConfig::get('app_ddlightbox_width');
  if(!isset($lb_opts['height'])) $lb_opts['height'] = sfConfig::get('app_ddlightbox_height');
  if(!isset($lb_opts['modal'])) $lb_opts['modal'] = false;
  $class = isset($lb_opts['class']) ? $lb_opts['class'] : 'lightbox';
  
  $response = sfContext::getInstance()->getResponse();
  $response->addJavascript(sfConfig::get("app_ddlightbox_js_dir").'jquery.lightbox.min.js');
  $response->addStylesheet(sfConfig::get("app_ddlightbox_css_dir").'jquery.lightbox.css');  
  
  echo javascript_tag('$(\''.$class.'\').lightbox();');
  $o = '<a href="'.url_for($url,$lnk_opts).'?';
  $c = 0;
  foreach($lb_opts as $k => $v) $o .= ($c!=0?'&':'').'lightbox['.$k.']='.$v;
  $o .= '" class="'.$class.'">'.$name.'</a>';
  echo $o;
          
}
<?php

namespace Kanboard\Plugin\Greenwing;

use Kanboard\Core\Base;

/**
 * Url Helper
 *
 * @package helper
 * @author  Frederic Guillot
 */
class MyUrlHelper extends Base
{

/**
     * Link element with icon
     *
     * @access public
     * @param  string  $icon        Icon name
     * @param  string  $label       Link label
     * @param  string  $controller  Controller name
     * @param  string  $action      Action name
     * @param  array   $params      Url parameters
     * @param  boolean $csrf        Add a CSRF token
     * @param  string  $class       CSS class attribute
     * @param  string  $title       Link title
     * @param  boolean $newTab      Open the link in a new tab
     * @param  string  $anchor      Link Anchor
     * @param  bool    $absolute
     * @return string
     */
    public function icon($icon, $label, $controller, $action, array $params = array(), $csrf = false, $class = '', $title = '', $newTab = false, $anchor = '', $absolute = false)
    {
        $html = '<i class="fa fa-fw fa-'.$icon.'" aria-hidden="true"></i><span>'.$label.'</span>';
        return $this->helper->url->link($html, $controller, $action, $params, $csrf, $class, $title, $newTab, $anchor, $absolute);
    }
  }
<?php
/**
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2015, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */

// ------------------------------------------------------------------------
//	HybridAuth End Point
// ------------------------------------------------------------------------


$url = str_replace('yahoo.php', '',$_SERVER["REQUEST_URI"]);
if(strpos($url,'?') !== false) {
	$url .= '&hauth.done=Yahoo';
} else {
	$url .= '?hauth.done=Yahoo';
}


header("Location:".$url);
<?php
/* 
Combine, minify, gzip and cache LESS files
*/

// Include LESS library
include "includes/lessc.inc.php";

// Minify CSS
function minifyCSS($css) {
    $css = trim($css);
    $css = str_replace("\r\n", "\n", $css);
    $search = array("/\/\*[^!][\d\D]*?\*\/|\t+/", "/\s+/", "/\}\s+/");
    $replace = array(null, " ", "}\n");
    $css = preg_replace($search, $replace, $css);
    $search = array("/;[\s+]/", "/[\s+];/", "/\s+\{\\s+/", "/\\:\s+\\#/", "/,\s+/i", "/\\:\s+\\\'/i", "/\\:\s+([0-9]+|[A-F]+)/i", "/\{\\s+/", "/;}/");
    $replace = array(";", ";", "{", ":#", ",", ":\'", ":$1", "{", "}");
    $css = preg_replace($search, $replace, $css);
    $css = str_replace("\n", null, $css);
    return $css;
}

// Compile LESS
function auto_compile_less($less_fname, $css_fname) {
  
  // Check cache status and replace if necessary
  $cache_fname = $less_fname.".cache";
  if (file_exists($cache_fname)) {
    $cache = unserialize(file_get_contents($cache_fname));
  } else {
    $cache = $less_fname;
  }
  $new_cache = lessc::cexecute($cache);
  if (!is_array($cache) || $new_cache['updated'] > $cache['updated']) {
    file_put_contents($cache_fname, serialize($new_cache));
    file_put_contents($css_fname, minifyCSS($new_cache['compiled']));
  }
  
  // Enabled gzipping
  if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    ob_start("ob_gzhandler");
  } else {
    ob_start();
  }
  
  // Add CSS header
  header('Content-type: text/css');
  
  // Output CSS
  readfile('styles.css');
}

auto_compile_less('styles.less', 'styles.css')
?>
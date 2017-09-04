<?php

function cleanInput($input) {
   $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Remove javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Remove HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Remove css tags
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Remove multi-line comments
  );
 
    $output = preg_replace($search, '', $input);
    return $output;
  }
 
 function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}





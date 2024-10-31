<?php

add_action('init', 'simpleSessionStart', 1);
add_action('wp_logout', 'simpleSessionDestroy');
add_action('wp_login', 'simpleSessionDestroy');

/**
 * start the session, after this call the PHP $_SESSION super global is available
 */
function simpleSessionStart() {
    if(!session_id())session_start();
}

/**
 * destroy the session, this removes any data saved in the session over logout-login
 */              
function simpleSessionDestroy() {
    session_destroy ();
}

/**
 * get a value from the session array
 * @param type $key the key in the array
 * @param type $default the value to use if the key is not present. empty string if not present
 * @return type the value found or the default if not found
 */
function simpleSessionGet($key, $default='') {
    if(isset($_SESSION[$key])) {
        return $_SESSION[$key];
    } else {
        return $default;
    }
}

/**
 * set a value in the session array
 * @param type $key the key in the array
 * @param type $value the value to set
 */
function simpleSessionSet($key, $value) {
    $_SESSION[$key] = $value;
}

?>
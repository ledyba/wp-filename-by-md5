<?php
/**
 * Plugin Name: wp-filename-by-md5
 * Plugin URI: https://github.com/ledyba/wp-filename-by-md5
 * Description: Hashify filename from content
 * Author: Kaede Fujisaki
 * Author URI: https://7io.org
 * Version: 1.0.1
 * License: AGPLv3 or later
 * GitHub Plugin URL: ledyba/wp-filename-by-md5
 */

if( !function_exists( 'wp_rename_filename_by_md5' ) ) {
  function wp_rename_filename_by_md5( $file ) {
    // @See also: 
    // $file: http://php.net/manual/en/reserved.variables.files.php#89674
    $info = pathinfo($file['name']);
    $ext  = empty($info['extension']) ? '' : '.' . $info['extension'];
    $hash = md5_file($file['tmp_name'], false);
    $file['name'] = $hash . $ext;
    return $file;
  }
}
add_filter( 'wp_handle_upload_prefilter', 'wp_rename_filename_by_md5', 10 );

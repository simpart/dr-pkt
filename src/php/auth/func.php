<?php
/**
 * @file auth/func.php
 * @brief authentication function
 * @author simpart
 */
namespace auth;
require_once(__DIR__ . '/../ttr/session/require.php');

function isLoggedin () {
    try {
        return false;
    } catch (\Exception $e) {
        throw new \Exception(
            PHP_EOL   .
            'File:'   . __FILE__   . ',' .
            'Line:'   . __line__   . ',' .
            'Func:' . __FUNCTION__ . ',' .
            $e->getMessage()
        );
    }
}
/* end of file */

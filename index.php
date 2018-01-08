<?php
/**
 * @file   index.php
 * @brief  index contents
 * @author simpart
 */
require_once(__DIR__ . '/src/php/route/func.php');
try {
    var_dump($_SERVER['REQUEST_URI']);
    //\rtg\getInxConts();
} catch (Exception $e) {
    echo $e->getMessage();
}
/* end of file */

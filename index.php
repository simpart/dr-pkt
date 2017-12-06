<?php
require_once(__DIR__ . '/src/php/route/func.php');

try {
    \rtg\getInxConts();
} catch (Exception $e) {
    echo $e->getMessage();
}
/* end of file */

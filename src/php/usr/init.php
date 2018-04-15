<?php
/**
 * @file init.php
 * @brief 
 */
namespace usr;
require_once(__DIR__ . '/../ttr/class.php');

try {
    $user = new User(
                'admin',
                'drpkt123',
                DUSR_ROLE_ADMIN
            );
    $db = new ctl\Mongo();
    $db->add($user);
} catch (\Exception $e) {
    throw new \Exception(
        PHP_EOL   .
        'File:'   . __FILE__   . ',' .
        'Line:'   . __line__   . ',' .
        $e->getMessage()
    );
}
/* end of file */

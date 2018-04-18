<?php
/**
 * @file init.php
 * @brief 
 */
namespace usr;
require_once(__DIR__ . '/../ttr/class.php');

try {
    $user = new User(
                'drpkt',
                'drpkt123',
                DUSR_ROLE_ADMIN
            );
    $db = new ctl\Mongo();
    $db->add($user);
} catch (\Exception $e) {
    echo $e->getMessage();
}
/* end of file */

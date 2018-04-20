<?php
/**
 * @file init.php
 * @brief 
 */
namespace usr;
require_once(__DIR__ . '/../ttr/class.php');
require_once(__DIR__ . '/define.php');
require_once(__DIR__ . '/../com/define.php');

try {
    $ctrl = new \ttr\db\mongo\ctrl\Collection(
                DCOM_DB_HOST,
                DCOM_APP_TITLE,
                'user'
            );
    $user = new User(
                'drpkt',
                'drpkt123',
                DUSR_ROLE_ADMIN
            );
    $ctrl->add($user);
} catch (\Exception $e) {
    echo $e->getMessage();
}
/* end of file */

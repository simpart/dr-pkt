<?php
/**
 * @file   ctrl.php
 * @brief  url routing contoroller
 * @author simpart
 */
namespace rtg;
require_once(__DIR__ . '/../ttr/require.php');
require_once(__DIR__ . '/../com/define.php');
require_once(__DIR__ . '/define.php');
require_once(__DIR__ . '/../auth/login.php');

try {
    // check url, check contents path
    $rtg = new UrlRouting(
                   $_SERVER['REQUEST_URI'],
                   DCOM_APP_TITLE,
                   DRTG_CNF_PATH
               );
    // check request type
    if (true === $rtg->isRest()) {
        // check token
        
    } else {
        // check login
        if (true === $rtg->loginRequired()) {
            if (true !== \auth\login\isLoggedin()) {
                header('location: /'. DRTG_APP_TITLE .'/login');
                exit();
            }
        }
    }
    $path = $rtg->getContsPath();
    // set contents type, etc..
    \ttr\header\setContsType($path);
    // return contents or execute api
    $ret = require($path);
    
    // return api value
    if (0 !== strcmp(gettype($ret), 'integer')) {
        \ttr\rest\resp($ret_val);
    }
    
} catch (\rtg\err\RtgExcp $rtg_exp) {
    $rtg_exp->responce();
} catch (\Exception $e) {
    http_response_code(500);
    // get debug log
    //\ttr\rest\errResp($e->getMessage());
    var_dump($e->getMessage());
}
/* end of file */
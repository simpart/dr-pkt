<?php
/**
 * @file   ctrl.php
 * @brief  url routing contoroller
 * @author simpart
 */
namespace rtg;
require_once(__DIR__ . '/../ttr/class/require.php');
require_once(__DIR__ . '/define.php');
//require_once(__DIR__ . 'util.php');

try {
    global $Grtg_api_ret;
    $Grtg_api_ret = null;
    
    // check url, check contents path
    $rtg = new UrlRouting(
                   $_SERVER['REQUEST_URI'],
                   DRTG_APP_TITLE,
                   DRTG_CNF_PATH
               );
    // check login
    if ( (true === $rtg->isEnabledLogin()) &&
         (true !== $rtg->isLoginRequest()) ) {
            \ath\chkLoggedin();
        }
    }
    
#    // set contents type, etc..
#    $rtg->getContsType();
     
#    // return contents or execute api
#    $rtg->getContsPath();   // include conf header
#    $ret = require($path);
     
#    // return api value
#    if (null !== $ret_val) {
#        \ttr\rest\resp($ret_val);
#    }
} catch (\rtg\Excp $rtg_exp) {
    // set error code
    //$rtg_exp->getRespCode();
    // redirect
    
} catch (\Exception $e) {
    // set error code 500
    
    // get debug log
    //\ttr\rest\errResp($e->getMessage());

}
/* end of file */

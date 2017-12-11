<?php
/**
 * @file   UrlRouting.php
 * @brief  url routing class
 * @author simpart
 */
namespace rtg;
require_once(__DIR__ . '/../ttr/file/require.php');

/**
 * @class UrlRouting
 */
class UrlRouting {
    private $url      = null;
    private $conf     = null;
    private $cnt_path = null;
    
    /**
     * check uri format, and get request contents
     * 
     * @param[in] uri : request uri string
     */
    function __construct($u, $t, $c) {
        try {
            $this->url = new \ttr\routing\URL($u);
            if (0 === strcmp($this->url->getUrl(0), $t)) {
                $this->url->setOffset(1);
            }
            $this->map      = new UrlMap($c);
            //$this->cnt_path = $this->getContsPath();
        } catch (err\RtgExcp $rtg_exp) {
            throw $rtg_exp;
        } catch (\Exception $e) {
            throw new \Exception(
                PHP_EOL   .
                'File:'   . __FILE__         . ',' .
                'Line:'   . __line__         . ',' .
                'Class:'  . get_class($this) . ',' .
                'Method:' . __FUNCTION__     . ',' .
                $e->getMessage()
            );
        }
    }
    
    public function isRest () {
        try {
            return $this->map->isAttr($this->url, 'rest');
        } catch (\Exception $e) {
            throw new \Exception(
                PHP_EOL   .
                'File:'   . __FILE__         . ',' .
                'Line:'   . __line__         . ',' .
                'Class:'  . get_class($this) . ',' .
                'Method:' . __FUNCTION__     . ',' .
                $e->getMessage()
            );
        }
    }
    
    public function loginRequired () {
        try {
            // check attr whether login attr is exists
            $cnf_lst = $this->map->getList();
            $hit_lgn = false;
            foreach ($cnf_lst as $celm) {
                if (false === array_key_exists('attr', $celm)) {
                    continue;
                }
                foreach ($celm['attr'] as $aelm) {
                    if (0 === strcmp('login', $aelm)) {
                        $hit_lgn = true;
                        break 2;
                    }
                }
            }
            
            if (false === $hit_lgn) {
                return false;
            }
            
            // check login request
            return !($this->map->isAttr($this->url, 'login'));
        } catch (\Exception $e) {
            throw new \Exception(
                PHP_EOL   .
                'File:'   . __FILE__         . ',' .
                'Line:'   . __line__         . ',' .
                'Class:'  . get_class($this) . ',' .
                'Method:' . __FUNCTION__     . ',' .
                $e->getMessage()
            );
        }
    }
    
    public function getContsPath () {
        try {
            if (null !== $this->cnt_path) {
                // get from buffering
                return $this->cnt_path;
            }
            $toroot = __DIR__ . '/../../../';
            // check map config
            $chk_path = $this->map->getConts($this->url);
            if (null !== $chk_path) {
                $this->cnt_path = $toroot . $chk_path;
                return $this->cnt_path;
            }
            // check file path
            if (true === \ttr\file\isExists($toroot . $path)) {
                $this->cnt_path = $toroot . $path;
                return $this->cnt_path;
            }
            
            // error : not matched contents
            $err = new err\RtgExcp($path);
            $err->setRespCode(400);
            throw $err;
        } catch (err\RtgExcp $rtg_exp) {
            throw $rtg_exp;
        } catch (\Exception $e) {
            throw new \Exception(
                PHP_EOL   .
                'File:'   . __FILE__         . ',' .
                'Line:'   . __line__         . ',' .
                'Class:'  . get_class($this) . ',' .
                'Method:' . __FUNCTION__     . ',' .
                $e->getMessage()
            );
        }
    }
    
    //private 
}
/* end of file */

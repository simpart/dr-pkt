<?php
/**
 * @file   UrlMap.php
 * @brief  config manager for url mapping
 * @author simpart
 */
namespace rtg;

/**
 * @class UrlMap
 */
class UrlMap {
    private $conf = null;

    /**
     * check uri format, and get request contents
     * 
     * @param[in] uri : request uri string
     */
    function __construct($c) {
        try {
            $this->conf = yaml_parse_file($c);
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
    
    public function getContsPath ($url_key) {
        try {
            foreach ($this->conf as $cidx => $cval) {
                if (0 === strcmp($cval['url'], $url_key)) {
                    return $cval['conts'];
                }
            }
            return null;
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
}
/* end of file */

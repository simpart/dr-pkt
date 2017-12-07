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
            $this->url      = new \ttr\routing\URL($u, $t);
            $this->map      = new UrlMap($c);
            $this->cnt_path = $this->getContsPath();
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
    
    public function isEnabledLogin () {
        try {
            if (null === $this->map->getContsPath('/login')) {
                return false;
            }
            return true;
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
    
    public function getContsType () {
        try {
            
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
                return $this->cnt_path;
            }
            
            $toroot = __DIR__ . '/../../../';
            $path   = '';
            $url    = $this->url->getUrl();
            foreach ($url as $uelm) {
                $path .= DIRECTORY_SEPARATOR . $uelm;
            }
            if (0 === strcmp($path, '')) {
                // this request is / (root)
                $this->cnt_path = $toroot . $this->map->getContsPath('/');
                return $this->cnt_path;
            }
            // check file path
            if (true === \ttr\file\isExists($path)) {
                $this->cnt_path = $toroot . $path;
                return $this->cnt_path;
            }
            // check config
            $path = $this->map->getContsPath('/' . $path);
            if (null !== $path) {
                $this->cnt_path = $toroot . $path;
                return $this->cnt_path;
            }
            
            throw new \Exception('no matched contents'); 
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

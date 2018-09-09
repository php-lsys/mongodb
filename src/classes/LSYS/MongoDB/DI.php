<?php
namespace LSYS\MongoDB;
/**
 * @method \LSYS\MongoDB mongodb($config=null)
 */
class DI extends \LSYS\DI{
    /**
     *
     * @var string default config
     */
    public static $config = 'mongodb.default';
    /**
     * @return static
     */
    public static function get(){
        $di=parent::get();
        !isset($di->mongodb)&&$di->mongodb(new \LSYS\DI\ShareCallback(function($config=null){
            return $config?$config:self::$config;
        },function($config=null){
            $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
            return new \LSYS\MongoDB($config);
        }));
        return $di;
    }
}
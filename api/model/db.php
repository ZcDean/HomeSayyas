<?php
/**
 * Created by PhpStorm.
 * User: Dean
 * Date: 2017/8/15
 * Time: 11:08
 */


use Medoo\Medoo;

class db
{
    private static $connect = null;
    public static function getConnect(){
        if(db::$connect == null){
            try{
                db::$connect = new Medoo(
                    [
                        // 必须配置项
                        'database_type' => 'mysql',
                        'database_name' => $GLOBALS['config']['mysql']['database'],
                        'server' => $GLOBALS['config']['mysql']['host'],
                        'username' => $GLOBALS['config']['mysql']['user'],
                        'password' => $GLOBALS['config']['mysql']['password'],
                        'charset' => 'utf8',
                        'port' => $GLOBALS['config']['mysql']['port'],
                        //前缀
                        'prefix' => 'db_',
                    ]

                );
            }catch (Exception $e){
                return null;
            }
        }
        return db::$connect;

}
}
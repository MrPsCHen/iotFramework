<?php

namespace Framework;

use Swoole\Process;

final class Kernel extends Process
{
    private static ?Kernel  $instance;

    private function __construct($callback, $redirect_stdin_stdout = false, $create_pipe = true)
    {
        parent::__construct($callback, $redirect_stdin_stdout, $create_pipe);
    }

    private function __clone(){

    }

    public static function getInstance($callback = null){
        if(!(self::$instance instanceof self)){
            self::$instance = new self($callback);
        }
    }



//    /** @var \Swoole\Process|null 主进程 */
//    private static  ?Process    $master_process     = null;
//    private static  array       $work_process       = [];
//    private static  ?Kernel     $kernel             = null;
//    private static  array       $services           = [];
//    private static  array       $services_instance  = [];
//    /**
//     * @var int|\Swoole\Process
//     */
//
//
//    private function __construct(){
//        $this->setConfig();
//        $atomic = new Atomic(0);
//        self::$master_process = new Process(function() use($atomic){
//            ;
//        });
//        var_export($atomic->wait(-1));
//        self::$master_process->name('PHP-MASTER');
//    }
//    private function __clone(){}
//
//    public function setConfig(){
//        self::$services = [
//            HttpServ::class
//        ];
//
//    }
//
//
//    public static function getInstance():?Kernel
//    {
//
//
//
//        if(!(self::$kernel instanceof Kernel)){
//            Kernel::$kernel = new self();
//        }
//        return self::$kernel;
//    }
//
//
//    private function createMasterProcess(){
//        self::$master_process = new Process(function(){
//            foreach (self::$services as $service){
//                $instance = new $service();
//                $instance->run();
//                self::$work_process[$service] = $instance;
//            }
//        });
//    }
}
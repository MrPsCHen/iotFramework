<?php

namespace Framework;

use Services\HttpServ;
use Swoole\Process;

final class Kernel
{
    private                     $master_process     = null;
    private static  ?Kernel     $kernel             = null;
    private static  array       $services           = [];
    private static  array       $services_instance  = [];


    private function __construct(){
        $this->setConfig();
        $this->createMasterProcess();
    }
    private function __clone(){}

    public function setConfig(){
        self::$services = [
            HttpServ::class
        ];

    }


    public static function getInstance():?Kernel
    {
        if(!(self::$kernel instanceof Kernel)){
            Kernel::$kernel = new self();
        }
        return self::$kernel;
    }


    private function createMasterProcess(){
        $this->master_process = new Process(function(){
            $masterProcess = $this->master_process;
            foreach (self::$services as $service){
                $instance = new $service();
                $instance->run();
                self::$services_instance[$service] = $instance;
            }
        });

        $this->master_process->start();
    }
}
<?php


namespace Framework;


abstract class AbstractService
{
    abstract public function getServiceName():string;
    abstract public function getServiceId():string;
    abstract public function run():bool;
    abstract public function getProcessId():int;

}
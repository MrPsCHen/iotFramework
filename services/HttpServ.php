<?php
/**
 * @author cps_1993@126.com
 * @desc
 */
namespace Services;
use Framework\AbstractService;
use Swoole\Http\Server;
use Swoole\Timer;

class HttpServ extends AbstractService
{
    protected ?Server $server = null;
    protected int     $runtime= 0;

    public function __construct()
    {
        $servIns = $this;
        $this->server = new \Swoole\Http\Server('0.0.0.0', 9501);

        $this->server->on('start', function ($server) {
            echo "Swoole http server is started at http://127.0.0.1:9501\n";
        });

        $this->server->on('request', function ($request, $response) use($servIns){

            $response->header('Content-Type', 'text/plain');
            $response->end('runtime:'.$servIns->runtime);
        });

        Timer::tick(1000,function() use ($servIns){
            $servIns->runtime++;
        });

    }

    public function getServiceName(): string
    {
        return "Http Server";
    }

    public function getServiceId(): string
    {
        return "NULL";
    }

    public function getProcessId():int{
        return 0;
    }

    public function run(): bool
    {
        // TODO: Implement run() method.
        $this->server->start();
        return true;
    }
}
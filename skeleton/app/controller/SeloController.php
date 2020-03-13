<?php

namespace shineblue\controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SeloController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $selos = [
            ["nome" => "Raul", "idade" => 10],
            ["nome" => "Carlos", "idade" => 12],
        ];
        return new Response(200, [], json_encode($selos));
    }
}
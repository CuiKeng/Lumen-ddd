<?php

declare(strict_types = 1);

namespace App\Domains\Cargo;

/**
 * 路线
 * 
 * @author cuikeng
 */
class RouteSpecification
{
    /**
     * 路线起点
     * 
     * @var string
     */
    protected $origin;
    /**
     * 路线终点
     * 
     * @var string
     */
    protected $destination;
    
    /**
     * 构造函数
     * 
     * @param string $origin
     * @param string $destination
     */
    public function __construct(string $origin, string $destination)
    {
        $this->origin = $origin;
        $this->destination = $destination;
    }
    
    public function getOrigin(): string
    {
        return $this->origin;
    }
    
    public function getDestination(): string
    {
        return $this->destination;
    }
}
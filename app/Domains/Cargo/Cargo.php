<?php

namespace App\Domains\Cargo;

/**
 * 货运
 * 
 * @author cuikeng
 */
class Cargo
{
    /**
     * 货运单号
     * 
     * @var TrackingId
     */
    protected $trackingId;
    /**
     * 货运路线
     * 
     * @var RouteSpecification
     */
    protected $routeSpecification;
    
    /**
     * 构造函数
     * 
     * @param TrackingId $trackingId
     * @param RouteSpecification $routeSpecification
     */
    public function __construct(TrackingId $trackingId, RouteSpecification $routeSpecification)
    {
        $this->trackingId = $trackingId;
        $this->routeSpecification = $routeSpecification;
    }
    
    public function getTrackingId()
    {
        return $this->trackingId;
    }
    
    public function getRouteSpecification()
    {
        return $this->routeSpecification;
    }
}
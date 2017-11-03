<?php

namespace App\Domains\Cargo;

use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

/**
 * 货运单号
 * 
 * @author cuikeng
 */
class TrackingId
{
    /**
     * @var Uuid
     */
    private $uuid;
    
    /**
     * 构造函数
     * 
     * @param UuidInterface $uuid
     */
    public function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }
    
    /**
     * 生成货运单号
     * 
     * @return \App\Domains\Cargo\TrackingId
     */
    public static function generate(): TrackingId
    {
        return new self(Uuid::uuid4());
    }
    
    /**
     * 通过标识构建货运单号
     * 
     * @param string $trackingId
     * @return \App\Domains\Cargo\TrackingId
     */
    public static function fromString(string $trackingId): TrackingId
    {
        return new self(Uuid::fromString($trackingId));
    }
    
    /**
     * @return string
     */
    public function toString()
    {
        return $this->uuid->toString();
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
}
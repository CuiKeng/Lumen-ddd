<?php

namespace App\Persistence\Doctrine\Type;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use App\Domain\Cargo\TrackingId;

class CargoTrackingIdType extends Type
{
    const TYPE_NAME = 'cargo_tracking_id';
    
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getClobTypeDeclarationSQL($fieldDeclaration);
    }
    
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (is_null($value)) {
            return '';
        }
        
        if (! $value instanceof TrackingId) {
            throw ConversionException($value, $this->getName());
        }
        
        return $value->toString();
    }
    
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }
        
        try {
            return TrackingId::fromString($value);
        } catch (\Exception $e) {
            throw ConversionException($value, $this->getName());
        }
    }
    
    public function getName()
    {
        return static::TYPE_NAME;
    }
}
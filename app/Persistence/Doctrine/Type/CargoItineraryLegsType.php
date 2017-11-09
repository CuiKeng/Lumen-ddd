<?php

namespace App\Persistence\Doctrine\Type;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use App\Domain\Cargo\Leg;

class CargoItineraryLegsType extends Type
{
    const TYPE_NAME = 'cargo_itinerary_legs';
    
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getClobTypeDeclarationSQL($fieldDeclaration);
    }
    
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return '';
        }
        
        if (! is_array($value)) {
            throw ConversionException::conversionFailed($value, $this->getName());
        }
        
        $legsData = json_encode(array_map(function ($leg) {
            if (! $leg instanceof Leg) {
                throw ConversionException::conversionFailed($value, $this->getName());
            }
            
            return [
                'load_location' => $leg->getLoadLocation(),
                'unload_location' => $leg->getUnloadLocation(),
                'load_time' => $leg->getLoadTime()->format(\DateTime::ISO8601),
                'unload_time' => $leg->getUnloadTime()->format(\DateTime::ISO8601)
            ];
        }, $value));
        
        return $legsData;
    }
    
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return [];
        }

        $legsData = json_decode($value, true);
        if (! $legsData) {
            throw ConversionException::conversionFailed($value, $this->getName());
        }
        
        $legs = [];
        
        foreach ($legsData as $legData) {
            $legs[] = app()->make(Leg::class, [
                'loadLocation' => $legData['load_location'],
                'unloadLocation' => $legData['unload_location'],
                'loadTime' => \DateTime::createFromFormat(\DateTime::ISO8601, $legData['load_time']),
                'unloadTime' => \DateTime::createFromFormat(\DateTime::ISO8601, $legData['unload_time'])
            ]);
        }
        
        return $legs;
    }
    
    public function getName()
    {
        return static::TYPE_NAME;
    }
}
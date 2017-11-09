<?php

namespace App\Domain\Location;

use App\Domain\Aggregate;

class Schedule implements Aggregate
{
    /**
     * @var array
     */
    private $carrierMovements;
    
    /**
     * Schedule construct
     * 
     * @param array $carrierMovements
     */
    public function __construct(array $carrierMovements)
    {
        $this->setCarrierMovements($carrierMovements);
    }
    
    /**
     * @return array
     */
    public function getCarrierMovements(): array
    {
        return $this->carrierMovements;
    }
    
    private function setCarrierMovements(array $carrierMovements): void
    {
        $this->carrierMovements = [];
        
        foreach ($carrierMovements as $carrierMovement) {
            $this->setCarrierMovement($carrierMovement);
        }
    }
    
    private function setCarrierMovement(CarrierMovement $carrierMovement): void
    {
        $this->carrierMovements[] = $carrierMovement;
    }
}
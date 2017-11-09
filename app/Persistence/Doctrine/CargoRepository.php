<?php

namespace App\Persistence\Doctrine;

use Doctrine\ORM\EntityRepository;
use App\Domain\Cargo\TrackingId;
use App\Domain\Cargo\Cargo;
use App\Domain\Cargo\CargoRepositoryInterface;

class CargoRepository extends EntityRepository implements CargoRepositoryInterface
{
    public function store(Cargo $cargo): void
    {
        $this->getEntityManager()->persist($cargo);
        $this->getEntityManager()->flush();
    }
    
    public function get(TrackingId $trackingId): Cargo
    {
        return $this->find($trackingId);
    }
    
    public function getAll(): array
    {
        return $this->findAll();
    }
}
<?php

namespace App\Persistence\Doctrine;

use Doctrine\ORM\EntityRepository;
use App\Domain\Location\LocationRepositoryInterface;

class LocationRepository extends EntityRepository implements LocationRepositoryInterface
{
    public function store()
    {
        
    }
    
    public function get()
    {
        
    }
    
    public function getAll()
    {
        
    }
}
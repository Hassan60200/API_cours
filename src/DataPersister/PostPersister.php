<?php

namespace App\DataPersister;

use App\Entity\Post;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;

class PostPersister implements DataPersisterInterface
{

    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function supports($data): bool
    {
        return $data instanceof Post;
    }

    public function persist($data)
    {
        $data->setCreatedAt(new \DateTime());

        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();
    }
}

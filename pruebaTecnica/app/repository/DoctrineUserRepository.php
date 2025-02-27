<?php

namespace app\repository;

use app\entity\User;
use app\valueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(User $user): void
{
    try {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    } catch (\Exception $e) {
        echo "Error al guardar el usuario: " . $e->getMessage();
    }
}

    public function findById(UserId $id): ?User
    {
        return $this->entityManager->getRepository(User::class)->find($id->value());
    }

    public function delete(UserId $id): void
    {
        $user = $this->findById($id);
        if ($user !== null) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }
    }

    public function findByEmail(String $email): ?User
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
    }
}
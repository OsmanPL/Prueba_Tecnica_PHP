<?php

namespace app\repository;

use app\entity\User;
use app\valueObject\UserId;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function findById(UserId $id): ?User;

    public function delete(UserId $id): void;

    public function findByEmail(String $email): ?User;
}
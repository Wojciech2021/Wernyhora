<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

class UsersService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function getUser(int $id)
    {
        return $this->userRepository->findOneBy(['id' => $id]);
    }

    public function assignRoleToUser(User $user, string $role, )
    {
        $user->setRoles([$role]);
        $this->userRepository->add($user);
    }

}
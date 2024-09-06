<?php

namespace App\tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase
{
    public function testGetId()
    {
        $user = new User();
        $this->assertNull($user->getId());
    }

    public function testGetSetEmail()
    {
        $user = new User();
        $email = 'test@example.com';
        $user->setEmail($email);
        $this->assertSame($email, $user->getEmail());
    }

    public function testGetUserIdentifier()
    {
        $user = new User();
        $email = 'test@example.com';
        $user->setEmail($email);
        $this->assertSame($email, $user->getUserIdentifier());
    }

    public function testGetSetRoles()
    {
        $user = new User();
        $roles = ['ROLE_ADMIN'];
        $user->setRoles($roles);
        $this->assertSame(['ROLE_ADMIN', 'ROLE_USER'], $user->getRoles());
    }

    public function testGetSetPassword()
    {
        $user = new User();
        $password = 'hashed_password';
        $user->setPassword($password);
        $this->assertSame($password, $user->getPassword());
    }

    public function testEraseCredentials()
    {
        $user = new User();
        $user->eraseCredentials();
        $this->assertTrue(true); // Just to ensure the method runs without errors
    }

    public function testGetSetUsername()
    {
        $user = new User();
        $username = 'testuser';
        $user->setUsername($username);
        $this->assertSame($username, $user->getUsername());
    }
}
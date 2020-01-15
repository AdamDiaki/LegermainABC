<?php


namespace App\Tests\Entity;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{

    public function testValidEntity () {
        $user = (new User())
            ->setName("nametest")
            ->setFirstname("firstnametest")
            ->setEmail("email@test.com")
            ->setAddress("1 rue test")
            ->setNumber("0237904165");
        self::bootKernel();
        $error = self::$container->get('validator')->validate($user);
        $this->assertCount(0, $error);
    }
}
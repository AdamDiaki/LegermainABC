<?php


namespace App\Tests\Entity;


use App\Entity\Category;
use App\Entity\RequestProject;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RequestProjectTest extends KernelTestCase
{

    public function testValidEntity () {
        $request = (new RequestProject())
            ->setUser(new User())
            ->setTitle("Titre test")
            ->setCategory(new Category())
            ->setSaw("0")
            ->setCreatedAt(new \DateTime())
            ->setContacted(0)
            ->setContent("Contenu test");
        self::bootKernel();
        $error = self::$container->get('validator')->validate($request);
        $this->assertCount(0, $error);
    }
}
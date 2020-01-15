<?php


namespace App\Tests\Entity;


use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryTest extends KernelTestCase
{

    public function testValidEntity () {
        $category = (new Category())
            ->setTitle("TitreCategory")
            ->setContent("ContenuCategory");
        self::bootKernel();
        $error = self::$container->get('validator')->validate($category);
        $this->assertCount(0, $error);
    }
}
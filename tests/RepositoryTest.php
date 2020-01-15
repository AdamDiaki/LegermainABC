<?php
namespace App\Tests;


use App\DataFixtures\AdminFixtures;
use App\Repository\AdminRepository;
use App\Repository\CategoryRepository;
use App\Repository\OfferTypeRepository;
use App\Repository\OfferRepository;
use App\Repository\ArticleRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use PHPUnit\Framework\TestCase;


class RepositoryTest extends KernelTestCase
{


    public function testCount()
    {
        self::bootKernel();



        $admin = self::$container->get( AdminRepository::class )->count( [] );
        $this->assertEquals( 1, $admin );
        $category = self::$container->get(CategoryRepository::class)->count([]);
        $this->assertEquals(3,$category);
        $offerType = self::$container->get(OfferTypeRepository::class)->count([]);
        $this->assertEquals(4,$offerType);
        $offer = self::$container->get(OfferRepository::class)->count([]);
        $this->assertEquals(8,$offer);
        $article = self::$container->get(ArticleRepository::class)->count([]);
        $this->assertEquals(9,$article);

    }


}
<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 * Class ArticleFixtures
 * @package App\DataFixtures
 */
class ArticleFixtures extends Fixture
{
    /**
     * elle permet d'ajouter les différentes catégories dans la liste
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $category = new Category();
        $category1 = new Category();
        $category2 = new Category();
        $category->setTitle("Charpente");
        $category1->setTitle("Couverture");
        $category2->setTitle("Ouvrages spécifiques");
        $category->setContent("Les charpentes ABC Legermain couvrent une large gamme de produits (du hangar agricole aux monuments historiques en passant bien sur par la charpente traditionnelle). Elles sont réalisées artisanalement en employant les assemblages traditionnels correspondant aux style et à l’époque de l’ouvrage (tenons mortaise, chevilles en bois...) ");
        $category1->setContent("Nous sommes également en mesure de protéger vos demeures des intempéries. Utilisant autant la tuile que l’ardoise ou le bardeau de châtaignier, la société ABC Legermain réalisera la couverture de vos charpentes, en l'agrémentant, si vous le souhaitez de quelques éléments décoratifs. ");
        $category2->setContent("Escaliers, rambardes et garde-corps, lucarnes et autres menuiseries artisanales… Nous mettons notre maîtrise de l'ouvrage au service de vos attentes.Sobre ou travaillé, d'un style rustique ou moderne, racontez nous de votre projet et nous trouverons ensemble une réponse adaptée à votre budget et à votre demande.");
        $manager->persist($category);
        $manager->persist($category1);
        $manager->persist($category2);

        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 3; $i++) {
            $art = new Article();
            $art->setTitle($faker->sentence( $nbWords = 3, $variableNbWords = true ));
            $art->setContent($faker->sentence( $nbWords = 2000, $variableNbWords = true ));
            $art->setCategory($category);

            $manager->persist( $art );

        } for ($i = 1; $i <= 3; $i++) {
            $art = new Article();
            $art->setTitle($faker->sentence( $nbWords = 3, $variableNbWords = true ));
            $art->setContent($faker->sentence( $nbWords = 2000, $variableNbWords = true ));
            $art->setCategory($category1);

            $manager->persist( $art );

        } for ($i = 1; $i <= 3; $i++) {
            $art = new Article();
            $art->setTitle($faker->sentence( $nbWords = 3, $variableNbWords = true ));
            $art->setContent($faker->sentence( $nbWords = 2000, $variableNbWords = true ));
            $art->setCategory($category2);

            $manager->persist( $art );

        }

        $manager->flush();
    }
}

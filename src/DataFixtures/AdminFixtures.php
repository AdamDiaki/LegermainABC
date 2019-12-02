<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoder $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    /**
     * Cette fonction permet d'ajouter un utilisateur à la base de données sans passer par un formulaire
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {


        $user = new Admin();
        $user->setUsername( "Christian" )
            ->setEmail( "christianmadambari@yahoo.fr" )
            ->setNumber( "0607213520" )
            ->setPassword( $this->encoder->encodePassword( $user, "azertyui2019" ) );;
        $manager->persist( $user );

        $manager->flush();
    }
}

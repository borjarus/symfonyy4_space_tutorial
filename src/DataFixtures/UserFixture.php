<?php

namespace App\DataFixtures;

use App\DataFixtures\BaseFixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    // TODO -2:49
    private $psswordEncoder;
    public function __construct(UserPasswordEncoderInterface $psswordEncoder) {
        $this->psswordEncoder = $psswordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users',  function($i){
            $user = new User();
            $user->setEmail(sprintf('spacebar%d@example.com', $i));
            $user->setFirstName($this->faker->firstName);

            $user->setPassword($this->psswordEncoder->encodePassword(
                $user,
                'engage'               
            ));
            return $user;
        });

        $manager->flush();
    }
}

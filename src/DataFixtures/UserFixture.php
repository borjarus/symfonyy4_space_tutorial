<?php

namespace App\DataFixtures;

use App\DataFixtures\BaseFixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\ApiToken;

class UserFixture extends BaseFixture
{
    private $psswordEncoder;
    public function __construct(UserPasswordEncoderInterface $psswordEncoder) {
        $this->psswordEncoder = $psswordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users',  function($i) use ($manager){
            $user = new User();
            $user->setEmail(sprintf('spacebar%d@example.com', $i));
            $user->setFirstName($this->faker->firstName);

            $user->setPassword($this->psswordEncoder->encodePassword(
                $user,
                'engage'               
            ));

            if($this->faker->boolean){
                $user->setTwitterUsername($this->faker->userName);
            }

            $apiToken1 = new ApiToken($user);
            $apiToken2 = new ApiToken($user);
            $manager->persist($apiToken1);
            $manager->persist($apiToken2);
            return $user;
        });

        $this->createMany(3, 'admin_users',  function($i){
            $user = new User();
            $user->setEmail(sprintf('admin%d@thespacebar.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_ADMIN']);

            $user->setPassword($this->psswordEncoder->encodePassword(
                $user,
                'engage'               
            ));
            return $user;
        });

        $manager->flush();
    }
}

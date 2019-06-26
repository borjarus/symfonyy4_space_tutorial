<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Comment;
use App\Entity\Article;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixture extends BaseFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(100, 'main_comments', function() {
            $comment = new Comment();
            $comment->setContent(
                $this->faker->boolean ? $this->faker->paragraph : $this->faker->sentences(2, true)
            );

            $comment->setAuthorName($this->faker->name);
            $comment->setCreatedAt($this->faker->dateTimeBetween('- 1 months', '- 1 seconds'));
            $comment->setIsDeleted($this->faker->boolean(20));

            $comment->setArticle($this->getRandomReference(Article::class));
        });


        $manager->flush();
    }

    public function getDependencies()
    {
        return [ArticleFixtures::class];
    }
}

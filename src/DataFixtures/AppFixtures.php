<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\ReserveTask;
use App\Entity\Tag;
use App\Entity\Task;
use App\Entity\Theme;
use App\Entity\Timer;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Core\DateTime;
use Faker\Factory;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeImmutableToDateTimeTransformer;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function __construct(SluggerInterface $sluggerInterface)
    {
        $this->sluggerInterface = $sluggerInterface;
    }


    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        $faker->seed(2022);

        //-------USER-----------------------------------------------//
        //----------------------------------------------------------//

        // Creation of two users with different roles
        $allUser = []; 
        $user = new User();
        $user->setEmail('louise@oclock.io');
        $user->setRoles(['ROLE_ADMIN']);
        // password hased from "louise"
        $user->setPassword('$2y$13$E5eBRuUJuqggR/LafTmgPOqlZsPd/uN2J5o10D0K.piSrwBQ8g08W');
        $user->setName('Louise');

        $manager->persist($user);
        $allUser[] = $user; 
        
        $user = new User();
        $user->setEmail('ayesha@oclock.io');
        $user->setRoles(['ROLE_USER']);
        // password hased from "ayesha"
        $user->setPassword('$2y$13$u56G8JZzpaKc209uZHeHqerqowSHlwWFRh7PwoNej.rFZI7HCAuY.');
        $user->setName('Ayesha');

        $manager->persist($user);

        $allUser[] = $user; 
        
        //-------BLOG-----------------------------------------------//
        //----------------------------------------------------------//

        // Generation of fake Theme with Faker
        $allTheme = [];
        for ($i=0; $i < 10; $i++) { 
            $theme = new Theme();
            $theme->setName($faker->words($nb = 3, $asText = true));
            $slug = $this->sluggerInterface->slug($theme->getName());
            $theme->setSlug($slug);
            $theme->setDescription($faker->realText($maxNbChars = 100, $indexSize = 3));
            $theme->setImage($faker->imageUrl($width = 640, $height = 480, 'cats'));
            $theme->setImageDescription($faker->realText($maxNbChars = 30, $indexSize = 2));

            $manager->persist($theme);

            $allTheme[] = $theme;
        }

        // Generation of fake Article with Faker
        $allArticle = [];
        for ($j=0; $j < 150; $j++) {
            $article = new Article();
            $article->setTitle($faker->words($nb = 10, $asText = true));
            $slug = $this->sluggerInterface->slug($article->getTitle());
            $article->setSlug($slug);
            $article->setSummary($faker->realText($maxNbChars = 100, $indexSize = 3));
            $article->setContent($faker->realText($maxNbChars = 500, $indexSize = 3));
            $article->setImage($faker->imageUrl($width = 640, $height = 480, 'dogs'));
            $article->setImageDescription($faker->realText($maxNbChars = 30, $indexSize = 2));

            // * linking the themes
            $themesAlreadyAdded[] = $article->getThemes();
            // between 1 and 3 themes
            for ($k=0; $k<rand(1, 3); $k++) {
                // random selection
                $themeToAdd = $allTheme[rand(0, count($allTheme)-1)];
                
                // checking the random theme isn't already linked to the article
                if (!in_array($themeToAdd, $themesAlreadyAdded)) {
                    // if it isn't
                    $article->addTheme($themeToAdd);
                    // adding to the current list
                    $themesAlreadyAdded[] = $theme;
                }
            }

            $manager->persist($article);

            $allArticle[] =$article;
        }

        //-------TODOLIST-------------------------------------------//
        //----------------------------------------------------------//

        //Generation of fake Tag with Faker
        $allTag = [];
        for ($m=0; $m < 10; $m++) {
            $tag = new Tag();
            $tag->setName($faker->word());
            
            $manager->persist($tag);

            $allTag[] = $tag;
        }

        // * linking the tags to user
        $tagsAlreadyAdded[] = $user->getTags();
        // between 1 and 5 tags
        for ($k=0; $k<rand(1, 5); $k++) {
            // random selection
            $tagToAdd = $allTag[rand(0, count($allTag)-1)];
            
            // checking the random tag isn't already linked to the user
            if (!in_array($tagToAdd, $tagsAlreadyAdded)) {
                // if it isn't
                $user->addTag($tagToAdd);
                // adding to the current list
                $tagsAlreadyAdded[] = $tagToAdd;
            }
        }

        // Generation of fake ReserveTask with Faker
        $allReserveTask = [];
        for ($l=0; $l < 40; $l++) {
            $reserveTask = new ReserveTask();
            $reserveTask->setName($faker->word());
            $tagToAdd = $allTag[rand(0, count($allTag)-1)];
            $reserveTask->setTag($tagToAdd);

            $manager->persist($reserveTask);

            $allReserveTask[] = $reserveTask;
        }

        // Generation of fake Task with Faker
        $allTask = [];
        for ($n = 0; $n < 5; $n++) {
            $task = new Task();
            $task->setName($faker->words($nb = 3, $asText = true));
            $userToAdd = $allUser[rand(0, count($allUser)-1)];
            $task->setUser($userToAdd);
            $task->setDone('false');

            $manager->persist($task);

            $allTask[] = $task;
        }

        $manager->flush();
    }
}

<?php

namespace App\Command;

use App\Entity\Article;
use App\Entity\ReserveTask;
use App\Entity\Tag;
use App\Entity\Theme;
use App\Entity\User;
use App\Models\AppDataModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class DataLoadCommand extends Command
{
    // the command name is "bin/console app:data:load"
    protected static $defaultName = 'app:data:load';

    // description of the command
    protected static $defaultDescription = 'loads all data in the obox database';

    private $appDataModel;
    private $entityManagerInterface;
    private $hasher;

    /**
     * Constructor with dependances injection
     */
    public function __construct(
        AppDataModel $appDataModel, 
        EntityManagerInterface $entityManagerInterface,
        UserPasswordHasherInterface $userPasswordHasherInterface
        )
    {
        // call to the parent cnstructor or else this construct won't work
        parent::__construct();

        $this->appDataModel = $appDataModel;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->hasher = $userPasswordHasherInterface;
    }

    protected function configure(): void
    {
        // usefull if we want to add arguments or options to the command later
        // $this
        //     ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
        //     ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        // ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // creation of the tags
        $tags = $this->appDataModel->getTagsData();
        $allTags = [];

        foreach ($tags as $tag) {
            $newTag = new Tag();
            $newTag->setName($tag['name']);

            $this->entityManagerInterface->persist($newTag);
            // stock all the tags in the $allTags array to link them to the reserveTasks later
            $allTags[] = $newTag;
        }

        // creation of the reserveTasks
        $reserveTasks = $this->appDataModel->getReserveTasksData();

        foreach ($reserveTasks as $reserveTask) {
            $newReserveTask = new ReserveTask();
            $newReserveTask->setName($reserveTask['name']);
            // get the tag by its rank in the $allTags array
            $newReserveTask->setTag($allTags[$reserveTask['tagRank']]);

            $this->entityManagerInterface->persist($newReserveTask);
        }

        // creation of the themes
        $themes = $this->appDataModel->getThemesData();
        $allThemes = [];

        foreach ($themes as $theme) {
            $newTheme = new Theme();
            $newTheme->setName($theme['name']);
            $newTheme->setSlug($theme['slug']);
            $newTheme->setImage($theme['image']);
            $newTheme->setDescription($theme['description']);
            $newTheme->setImageDescription(($theme['image_description']));

            $this->entityManagerInterface->persist($newTheme);
            // stock all themes to link them to the articles later
            $allThemes[] = $newTheme;
        }

        // creation of the articles
        $articles = $this->appDataModel->getArticlesData();

        foreach ($articles as $article) {
            $newArticle = new Article();
            $newArticle->setTitle($article['title']);
            $newArticle->setSlug($article['slug']);
            $newArticle->setSummary($article['summary']);
            $newArticle->setContent($article['content']);
            $newArticle->setImage($article['image']);
            $newArticle->setImageDescription($article['image_description']);

            // link the article to the themes
            foreach ($article['themeRanks'] as $themeToAdd) {
            $newArticle->addTheme($allThemes[$themeToAdd]);
            }

            $this->entityManagerInterface->persist($newArticle);
        }

        // creation of the users
        $users = $this->appDataModel->getUsersData();

        foreach ($users as $user) {
            $newUser = new User();
            $newUser->setEmail($user['email']);
            $newUser->setRoles($user['roles']);
            $hashedPassword = $this->hasher->hashPassword($newUser, $user['password']);
            $newUser->setPassword($hashedPassword);
            $newUser->setName($user['name']);

            $this->entityManagerInterface->persist($newUser);
        }


        $this->entityManagerInterface->flush();


        // to have color in the terminal (success green, etc)
        $io = new SymfonyStyle($input, $output);

        // usefull if we want to add arguments or options to the command later
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        // custom success message
        $io->success('Data loaded successfully !');

        return Command::SUCCESS;
    }
}

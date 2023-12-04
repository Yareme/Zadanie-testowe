<?php

namespace App\Command;

use App\Entity\Rest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:all-post',
    description: 'Add a short description for your command',
)]
class AllPostCommand extends Command
{
    private $entityManager;
    private $httpClient;

    public function __construct(EntityManagerInterface $entityManager, HttpClientInterface $httpClient)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
        $this->httpClient = $httpClient;
    }

    protected function configure()
    {
        $this->setName('app:load-posts')
            ->setDescription('Load posts from API and store in the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Здесь вам нужно реализовать логику загрузки данных из API и их сохранение в базе данных.
        // Пример использования HttpClient:
        $postResponse = $this->httpClient->request('GET', 'https://jsonplaceholder.typicode.com/posts');
        $data = $postResponse->toArray();

        // Пример сохранения данных в базе данных:
        foreach ($data as $restData) {
            $rest = new Rest();
            $rest->setTitle($restData['title']);
            $rest->setBody($restData['body']);
            $rest->setUserId($restData['userId']);
            $rest->setPostId($restData['id']);
            $userResponse = $this->httpClient->request('GET', 'https://jsonplaceholder.typicode.com/users/'.$restData['userId']);
            $userData= $userResponse->toArray();
            $rest->setImie($userData['name']);

            $this->entityManager->persist($rest);
        }

        $this->entityManager->flush();

        $output->writeln('Posts loaded and stored successfully.');

        return Command::SUCCESS;
    }
}

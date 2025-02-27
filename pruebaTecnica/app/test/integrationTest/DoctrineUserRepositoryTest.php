<?php

use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use app\repository\DoctrineUserRepository;
use app\entity\User;
use app\valueObject\Name;
use app\valueObject\Email;
use app\valueObject\Password;

class DoctrineUserRepositoryTest extends TestCase
{
    private EntityManager $entityManager;

    protected function setUp(): void
    {
        $dbParams = [
            'driver' => 'pdo_mysql',
            'user' => 'root',
            'password' => 'secret',
            'port' => 3306,
            'dbname' => 'pruebaTecnicaPHP',
            'host' => 'db',
        ];
        $config = ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/../../app/entity'], true);
        $connection = DriverManager::getConnection($dbParams, $config);
        $this->entityManager = new EntityManager($connection, $config);
    }

    public function testSaveAndFindUser()
    {
        echo "----- Test Integration ----\n";
        $userRepository = new DoctrineUserRepository($this->entityManager);

        $name = new Name('Osman Perez');
        $email = new Email('osmanplIntegrationTest@example.com');
        $password = new Password('P@ssw0rd');
        $user = new User($name, $email, $password);

        $userRepository->save($user);

        $foundUser = $userRepository->findByEmail($email->value());
        $this->assertNotNull($foundUser);
        $this->assertEquals('Osman Perez', $foundUser->name());
        $this->assertEquals('osmanplIntegrationTest@example.com', $foundUser->email());
        echo "----- Test Integration Passed ----\n\n";
    }
}
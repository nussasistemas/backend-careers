<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    // ...

    public function testVisitingWhileLoggedIn()
    {
        $client = static::createClient();

        $userEmail = 'alanhfs@gmail.com';

        // get or create the user somehow (e.g. creating some users only
        // for tests while loading the test fixtures)
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($userEmail);

        $client->loginUser($testUser);

        // user is now logged in, so you can test protected resources 
        $client->request('GET', '/job/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('em', $userEmail);
    }
}

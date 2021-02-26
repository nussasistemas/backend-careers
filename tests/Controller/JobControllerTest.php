<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobControllerTest extends WebTestCase
{
    // ...

    public function testJobShow()
    {
        $client = static::createClient();

        $userEmail = 'alanhfs@gmail.com';

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($userEmail);

        $client->loginUser($testUser);

        $jobId = 2;

        $client->request('GET', '/job/'.$jobId);
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('td', $jobId);
    }

    public function testJobEdit()
    {
        $client = static::createClient();

        // Login needed
        $userEmail = 'alanhfs@gmail.com';
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($userEmail);
        $client->loginUser($testUser);

        // Select the job
        $jobId = 2;
        $jobRepository = static::$container->get(JobRepository::class);
        $testJob = $jobRepository->find($jobId);

        $client->request('GET', '/job/'.$jobId.'/edit');
        $this->assertResponseIsSuccessful();
        $this->assertInputValueSame('job[title]', $testJob->getTitle());
        $this->assertInputValueSame('job[workplace]', $testJob->getWorkplace());
        $this->assertSelectorTextSame('textarea',$testJob->getDescription());
    }

    public function testJobNew()
    {
        $client = static::createClient();

        // Login needed
        $userEmail = 'alanhfs@gmail.com';
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($userEmail);
        $client->loginUser($testUser);
        
        $client->request('GET', '/job/new');
        $this->assertResponseIsSuccessful();
        $this->assertInputValueSame('job[title]', '');
        $this->assertInputValueSame('job[salary]', '');
        $this->assertInputValueSame('job[workplace]', '');
        $this->assertSelectorTextSame('textarea','');
    }

    public function testJobCreate() 
    {
        $client = static::createClient();
        
        // Login needed
        $userEmail = 'alanhfs@gmail.com';
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($userEmail);
        $client->loginUser($testUser);

        // send request and get token for POST
        $crawler = $client->request('GET', '/job/new');
        $form = $crawler->selectButton('Save')->form();
        $token = $form->get('job[_token]')->getValue();

        // Data to submit
        $form['job[title]'] = 'PHP Developer';
        $form['job[description]'] = 'Full-stack developer';
        $form['job[status]'] = 'visible';
        $form['job[salary]'] = '2345.67';
        $form['job[workplace]'] = 'Canada';
        $form['job[_token]'] = $token;

        // submit the form
        $crawler = $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());

    }

    public function testJobUpdate() 
    {
        $client = static::createClient();
        
        // Login needed
        $userEmail = 'alanhfs@gmail.com';
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($userEmail);
        $client->loginUser($testUser);

         // Select the job
         $jobId = 2;
         $jobRepository = static::$container->get(JobRepository::class);
         $testJob = $jobRepository->find($jobId);

        // send request and get token for POST
        $crawler = $client->request('GET', '/job/'.$jobId.'/edit');
        $form = $crawler->selectButton('Save')->form();
        $token = $form->get('job[_token]')->getValue();

        // Data to submit
        $form['job[title]'] = 'Caregiver';
        $form['job[description]'] = 'Details about the job';
        $form['job[status]'] = 'invisible';
        $form['job[salary]'] = '1500.00';
        $form['job[workplace]'] = 'Brazil';
        $form['job[_token]'] = $token;

        // submit the form
        $crawler = $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());

    }

    public function testJobDelete() 
    {
        $client = static::createClient();
        
        // Login needed
        $userEmail = 'alanhfs@gmail.com';
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($userEmail);
        $client->loginUser($testUser);

         // Select the job
         $jobId = 3;
         $jobRepository = static::$container->get(JobRepository::class);
         $testJob = $jobRepository->find($jobId);

        // send request and get token for POST
        $crawler = $client->request('GET', '/job/'.$jobId.'/edit');
        $form = $crawler->selectButton('Delete')->form();
        $token = $form->get('_token')->getValue();

        // Data to submit
        $form['_method'] = 'DELETE';
        $form['_token'] = $token;

        // submit the form
        $crawler = $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());

    }
}

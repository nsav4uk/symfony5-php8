<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testGetLogin(): void
    {
        $this->client->request('GET', '/login');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Please sign in');
        self::assertPageTitleContains('Log In!');
    }

    public function testPostLogin(): void
    {
        $crawler = $this->client->request('GET', '/login');
        $buttonCrawlerNode = $crawler->selectButton('Sign In');
        $form = $buttonCrawlerNode->form();

        $this->client->submit($form, [
            'email' => 'test@test.com',
            'password' => '111111',
        ]);

        $response = $this->client->getResponse();

        self::assertEquals(302, $response->getStatusCode());
    }

    public function testGetRegistration(): void
    {
        $this->client->request('GET', '/registration');

        self::assertResponseIsSuccessful();
        self::assertPageTitleContains('Registration');
    }

    public function testPostRegistration(): void
    {
        $crawler = $this->client->request('GET', '/registration');
        $buttonCrawlerNode = $crawler->selectButton('Sign Up');
        $form = $buttonCrawlerNode->form();

        $this->client->submit($form, [
            'registration[email]' => 'another.test@test.com',
            'registration[password]' => '111111',
        ]);

        $response = $this->client->getResponse();

        self::assertEquals(302, $response->getStatusCode());
    }
}

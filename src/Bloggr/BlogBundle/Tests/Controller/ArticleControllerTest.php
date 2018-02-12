<?php

namespace Bloggr\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testArticle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Article');
    }

}

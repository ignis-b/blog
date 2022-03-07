<?php
namespace App\Test;

use App\Services\ArticleService;
use App\CreateConnection;
use PHPUnit\Framework\TestCase;

class TestUpdateArticle extends TestCase
{

    public function testIndex()
    {
        CreateConnection::makeConnection();

        $input = [
            'id' => 1,
            'title' => 'Title',
            'summary' => 'Test Summary.',
            'content' => 'Test content.',
            'image' => '1.jpg',
        ];
        $update_article = new ArticleService();

        $this->assertEquals(true, $update_article->updateDatabase($input));
    }
}

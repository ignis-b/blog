<?php
namespace App\Test;

use App\Services\ArticleCreateService;
use App\CreateConnection;
use PHPUnit\Framework\TestCase;

class TestCreateArticle extends TestCase
{

    public function testIndex()
    {
        CreateConnection::makeConnection();
        $_SESSION['id'] = 1;
        $input = [
            'title' => 'Title',
            'summary' => 'Test Summary.',
            'content' => 'Test content.',
            'image' => '1.jpg',
            'authorId' => $_SESSION['id'],
        ];
        $create_article = new ArticleCreateService();

        $this->assertEquals(true, $create_article->insertDatabase($input));
    }
}

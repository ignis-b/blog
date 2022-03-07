<?php
namespace App\Test;

use App\Services\ArticleService;
use App\CreateConnection;
use PHPUnit\Framework\TestCase;

class TestDeleteArticle extends TestCase
{

    public function testIndex()
    {
        CreateConnection::makeConnection();
        $id = 1;
        $delete_article = new ArticleService();

        $this->assertEquals(true, $delete_article->deleteDatabase($id));
    }
}

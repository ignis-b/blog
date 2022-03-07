<?php
namespace App\Controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Services\ArticleService;

final class ArticleViewController
{
    private $view;
    private $logger;
    private $articleEditService;
    
    /**
     * Controller constructor.
     * @param Twig $view
     * @param LoggerInterface $logger
     * @param ArticleService $articleService
     */
    public function __construct(Twig $view, LoggerInterface $logger, ArticleService $articleService)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->articleService = $articleService;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        $this->logger->info("Article View Controller");
        $id = !empty($args['id']) ? $args['id'] : 0;
        $data = $this->articleService->selectDatabase($id);
        if (empty($data)) {
            return $response->withStatus(302)->withHeader('Location', '/');
        }
        $this->view
            ->render($response, 'article/article.twig',
                [
                    'article' => $data,
                    'sess_name' => $_SESSION['name'],
                    'sess_loggedin' => $_SESSION['loggedin']
                ]);
        return $response;
    }
}

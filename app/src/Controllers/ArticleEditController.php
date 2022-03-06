<?php
namespace App\Controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Services\ArticleService;

final class ArticleEditController
{
    private $view;
    private $logger;
    private $articleService;
    
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
        $this->logger->info("Article Edit Controller");
        $id = !empty($args['id']) ? $args['id'] : 0;

        if ($request->isPost()) {
            $input = $request->getParsedBody();
            if ($this->articleService->updateDatabase($input) === TRUE
            ) {
                $success = "Article was updated.";
            }
        }
        $data = $this->articleService->selectDatabase($id);

        $this->view->render($response, 'article/edit.twig',
         [
            'sess_name' => $_SESSION['name'],
            'sess_loggedin' => $_SESSION['loggedin'],
            'article' => $data,
            'nameSuccess' => $success
         ]);
        return $response;
    }
}

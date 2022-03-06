<?php
namespace App\Controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Services\ArticleService;

final class ArticleDeleteController
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
        $this->logger->info("Article Delete Controller");
        $id = !empty($args['id']) ? $args['id'] : 0;
        $template = 'delete';

        if ($request->isPost()) {
            $input = $request->getParsedBody();
            if ($this->articleService->deleteDatabase($input['id']) === TRUE
            ) {
                $success = 'Article was deleted.';
                $template = 'create';
            }
        }
        $data = $this->articleService->selectDatabase($id);

        $this->view
            ->render($response, 'article/' . $template . '.twig',
                [
                    'nameSuccess' => $success,
                    'sess_name' => $_SESSION['name'],
                    'article' => $data,
                    'sess_loggedin' => $_SESSION['loggedin']
                ]);
        return $response;
    }
}

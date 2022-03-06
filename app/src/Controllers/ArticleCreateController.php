<?php
namespace App\Controllers;

use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;
use App\Services\ArticleCreateService;

class ArticleCreateController
{
    private $view;
    private $logger;

    /**
     * Controller constructor.
     * @param Twig $view
     * @param LoggerInterface $logger
     * @param ArticleCreateService $articleCreateService
     */
    public function __construct(Twig $view, LoggerInterface $logger, ArticleCreateService $articleCreateService) {
        $this->view = $view;
        $this->logger = $logger;
        $this->articleCreateService = $articleCreateService;
    }
    public function __invoke(Request $request, Response $response, $args) {
        $this->logger->info("Article is created.");
        if ($request->isPost()) {
            $input = $request->getParsedBody();

            if ($this->articleCreateService->validate($input) === TRUE &&
                $this->articleCreateService->insertDatabase($input) === TRUE
            ) {
                $success = 'Article was created.';
            } else {
                $error = $this->articleCreateService->validate($input);
            }
        }

        $this->view
            ->render($response, 'article/create.twig',
            [
                'nameSuccess' => $success,
                'nameError' => $error,
                'sess_name' => $_SESSION['name'],
                'sess_loggedin' => $_SESSION['loggedin']
            ]
        );

        return $response;
    }
}
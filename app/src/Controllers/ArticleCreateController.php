<?php
namespace App\Controllers;

use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;
use App\Services\ArticleCreateService;
use App\Services\ImageService;

class ArticleCreateController
{
    private $view;
    private $logger;
    private $articleCreateService;
    private $imageService;
    /**
     * Controller constructor.
     * @param Twig $view
     * @param LoggerInterface $logger
     * @param ArticleCreateService $articleCreateService
     * @param ImageService $imageService
     */
    public function __construct(Twig $view, LoggerInterface $logger, ArticleCreateService $articleCreateService, ImageService $imageService) {
        $this->view = $view;
        $this->logger = $logger;
        $this->articleCreateService = $articleCreateService;
        $this->imageService = $imageService;
    }
    public function __invoke(Request $request, Response $response, $args) {
        $this->logger->info("Article is created.");
        if ($request->isPost()) {
            $input = $request->getParsedBody();
            $image = $request->getUploadedFiles();

            if ($this->imageService->image($image['image'])) {
                $input['image'] = $image['image']->getClientFilename();
            }

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
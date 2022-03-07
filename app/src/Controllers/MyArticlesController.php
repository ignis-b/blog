<?php
namespace App\Controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Services\HomeService;

final class MyArticlesController
{
    private $view;
    private $logger;
    private $homeService;

    /**
     * Controller constructor.
     * @param Twig $view
     * @param LoggerInterface $logger
     * @param HomeService $homeService
     */
    public function __construct(Twig $view, LoggerInterface $logger, HomeService $homeService)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->homeService = $homeService;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        $this->logger->info("My articles action dispatched");

        $page = !empty($args['page']) ? $args['page'] : 0;
        $data = $this->homeService->selectDatabase($page, $_SESSION['id']);

        $count = $this->homeService->countArticles($_SESSION['id']);
        $limit = HomeService::PER_PAGE;
        $this->view->render($response, 'article/myArticles.twig',
            [
                 'sess_name' => $_SESSION['name'],
                 'sess_loggedin' => $_SESSION['loggedin'],
                 'articles' => $data,
                 'pagination'    => [
                      'needed'        => $count > $limit,
                      'count'         => $count,
                      'page'          => $page,
                      'lastpage'      => (ceil($count / $limit) == 0 ? 1 : ceil($count / $limit)),
                      'limit'         => $limit,
                 ],
            ]
        );

        return $response;
    }
}

<?php
namespace App\Controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Services\HomeService;

final class HomeController
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
        $this->logger->info("Home page action dispatched");

        $page = !empty($args['page']) ? $args['page'] : 1;
        $limit = HomeService::PER_PAGE;
        $count = $this->homeService->countArticles();

        if ($page > ceil($count / $limit)) {
            return $response->withStatus(302)->withHeader('Location', '/');
        }

        $offset = ($page - 1) * $limit;

        $data = $this->homeService->selectDatabase($offset);

        $this->view->render($response, 'home.twig',
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

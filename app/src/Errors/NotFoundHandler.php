<?php

namespace App\Errors;

use Slim\Handlers\NotFound;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class NotFoundHandler extends NotFound
{
    private $view;
    
    /**
     * Controller constructor.
     * @param Twig $view
     */
    public function __construct(Twig $view) {
        $this->view = $view;
    }
    
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {
        parent::__invoke($request, $response);

        return $this->view->render($response, '404.twig', [
         'sess_name' => $_SESSION['name'],
         'sess_loggedin' => $_SESSION['loggedin']
        ])->withStatus(404);
    }
}
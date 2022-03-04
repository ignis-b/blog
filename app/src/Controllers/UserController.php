<?php
namespace App\Controllers;

use App\Services\AuthService;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class UserController {
    
    const SUBTEMPLATE = 'login';
    private $authService;
    private $view;
    private $logger;
    /**
     * Controller constructor.
     * @param AuthService $authService
     */
    public function __construct(Twig $view, LoggerInterface $logger, AuthService $authService)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->authService = $authService;
    }
    
    public function __invoke(Request $request, Response $response, $pageNumber = 1)
    {
var_dump(1);
        if ($this->authService->check()) {
            var_dump(3);
            return $response->withRedirect('/');
        }

        $pageData = [
            'title' => 'Авторизация',
            'title_seo' => 'Авторизация',
            'meta_d' => '',
            'meta_k' => ''
        ];

//
//        $categoryList = $this->categoryListService->getAllCategories();
//        $tagList = $this->tagListService->getAllTags();
//        $errors = ['auth' => $request->getQueryParam('errors')];
//
//
//        return $this->view->render($response, 'layout.php', [
//            'subtemplate' => self::SUBTEMPLATE,
//            'pageData' => $pageData,
//            'categoryList' => $categoryList,
//            'tagList' => $tagList,
//            'errors' => $errors
//        ]);

    }

//    public function actionLogin(Request $request, Response $response)
//    {
//
//        if ($request->isPost()) {
//
//            $formData = $request->getParsedBody();
//            $authService = new AuthService;
//            $isAuth = $authService->attempt(
//                $formData['email'],
//                $formData['password']
//            );
//
//            if ($isAuth) {
//                return $response->withRedirect('/admin/panel');
//            }
//        }
//
//        return $response->withRedirect('/user/login?errors=1');
//    }
}
<?php 

    require __DIR__ . "/../vendor/autoload.php";

    session_start();

    $app = new \Slim\App([
        'settings' => [
            'displayErrorDetails' => 'true',
            'db' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'database' => 'klix2o',
                'username' => 'root',
                'password' => ''
            ],
        ]
    ]);


    $container = $app->getContainer();
        

    $container['auth'] = function($container) {
        return new App\Auth\Auth;
    };
    $container['CommentController'] = function($container) {
        return new App\Controllers\CommentController($container);
    };
    $container['DashboardController'] = function($container){
        return new App\Controllers\DashboardController($container);
    };


    $container['view'] = function($container){
        $view  = new \Slim\Views\Twig(__DIR__ . '/../resources/views',[
            'cahce' => 'false',
        ]);

        $view -> addExtension(new \Slim\Views\TwigExtension(
            $container->router,
            $container->request->getUri()
        ));

        $view -> getEnvironment() -> addGlobal('auth', [
            'user' => $container->auth->user(),
            'check' => $container->auth->check(),
            'getBack' => $container->auth->getBack()
        ]);

        $view -> getEnvironment() -> addGlobal('comments', [
            'reply' => $container->CommentController->replies(),
            'comment' => $container->CommentController->comments()
        ]);

        $view -> getEnvironment() -> addGlobal('news', [
            'list' => $container->NewsController->getNews()
        ]);

        return $view;
    };

    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule -> addConnection($container['settings']['db']);
    $capsule -> setAsGlobal();
    $capsule -> bootEloquent();


    $container['db'] = function($container){
        return $capsule;
    };

    //Controller bindings:

    $container['HomeController'] = function($container){
        return new App\Controllers\HomeController($container);
    };
    $container['NewsController'] = function($container){
        return new App\Controllers\NewsController($container);
    };
    $container['AuthController'] = function($container){
        return new App\Controllers\AuthController($container);
    };
    $container['auth'] = function($container) {
        return new App\Auth\Auth;
    };




    require __DIR__ . "/../app/routes.php";








?>
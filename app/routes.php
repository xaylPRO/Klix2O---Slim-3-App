<?php 

    $app->get("/", "HomeController:index");
    $app->get("/news", "NewsController:displayNews");
    $app->get("/news/preview/{id}", "NewsController:preview");
    $app->get("/news/create", "NewsController:addNews");
    $app->get("/login", "AuthController:getLogin")->setName("auth.login");
    $app->post("/login", "AuthController:postLogin");
    $app->get("/logout", "auth:logout");
    $app->get("/news/category/{category}", "NewsController:byCategory");
    $app->post("/addComment", 'CommentController:addComment');
    $app->get("/register", "AuthController:getRegister")->setName('auth.register');
    $app->post("/register", "AuthController:postRegister");
    $app->get("/dashboard", "DashboardController:home");
    $app->get("/dashboard/comments/{user_id}", "DashboardController:myComments");
    $app->get("/dashboard/users", "DashboardController:users");
    $app->get("/dashboard/news", "DashboardController:listNews");
    $app->get("/dashboard/news/edit/{id}", "NewsController:editArticle");
    $app->get("/dashboard/comments/editcomment/{id}", "CommentController:editComment");
    $app->post("/dashboard/comments/savecomment", "CommentController:saveComment");
    $app->post("/dashboard/news/edit", "NewsController:updateArticle");
    $app->get("/dashboard/news/delete/{id}", "NewsController:deleteArticle");
    $app->get("/dashboard/users/edit/{id}", "AuthController:getEdit");
    $app->post("/dashboard/users/edit", "AuthController:postEdit");
    $app->post("/dashboard/users/delete/{id}", "AuthController:deleteUser");
    $app->post("/dashboard/news/add", "NewsController:addNews");
    $app->get("/dashboard/news/add", "NewsController:getAdd");
    $app->get("/dashboard/comments/delete/{id}/{userId}", "CommentController:delete");







?>
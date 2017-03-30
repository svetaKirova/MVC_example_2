<?php

class App
{
    protected static $router;

    /**
     * @return mixed
     */
    public static function getRouter()
    {
        return self::$router;
    }
    //Method which is responsible for processing(обработка) of requests of application
    public static function run($uri){
        self::$router = new Router($uri);

        Lang::load(self::$router->getLanguage());

        $controller_class = ucfirst(self::$router->getController()).'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction());

        //Collong controller's method
        $controller_object = new $controller_class();

        if(method_exists($controller_object, $controller_method )){
            //Controller's action may return a view
            $view_path = $controller_object->$controller_method();
            $view_object = new View($controller_object->getData(), $view_path);
            $content = $view_object->render();
        } else{
            // не срабатывает исключение
            //throw new Exception('nononono');
            echo "Method '$controller_method' of '$controller_class' doesn't exist";

        }
        $layout = self::$router->getRoute();
        $layout_path = VIEWS_PATH.DS.$layout.'.html';
        $layout_view_object = new View(compact('content'), $layout_path);
        echo $layout_view_object->render();

    }
}
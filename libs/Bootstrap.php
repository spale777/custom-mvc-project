<?php

class Bootstrap
/*Pokrece aplikaciju uzima parametre ukucane
* u url-u i na osnovu parametara pokrece odgovarajuci kontroler model i view
*/
{
    function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url_params = explode('/', $url);

        if (empty($url_params[0])) {
            require 'controllers/News.php';
            $controller = new News();
            $controller->loadModel('News');
            $controller->index();
            return false;
        }

        $file = 'controllers/' . $url_params[0] . '.php';

        if (file_exists($file)){
            require $file;
        } else {
            require 'controllers/Error.php';
            $controller = new Error();
            $controller->index();
            return false;
        }
        $control = isset($url_params[0]) ? $url_params['0'] : null;
        $method = isset($url_params[1]) ? $url_params['1'] : null;
        $method_param = isset($url_params[2]) ? $url_params['2'] : null;
        $method_params = [];
        $params_count = count($url_params);

        for ($i = 2; $i < $params_count; $i++ ) {
            if (isset($url_params[$i])) {
                array_push($method_params, $url_params[$i]);
            }
        }

        // Ucitava kontroler i model za taj kontroler

        $controller = new $control;
        $controller->loadModel($control);

        switch ($params_count) {
            case $params_count == 1:
                $controller->index();
                break;
            case $params_count == 2;
                if (method_exists($controller, $method)) {
                    $controller->$method();
                    break;
                } else {
                    header('Location:' . URI . '/error');
                    exit;
                }
            case $params_count === 3;
                if (method_exists($controller, $method)) {
                    $controller->$method($method_param);
                    break;
                } else {
                    header('Location:' . URI . '/error');
                    exit;
                }
            case $params_count > 3;
                if (method_exists($controller, $method)) {
                    $controller->$method($method_params);
                    break;
                } else {
                    header('Location:' . URI . '/error');
                    exit;
                }
        }

    }

}



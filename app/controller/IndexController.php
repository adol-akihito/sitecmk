<?php

namespace Application\controller;

use Application\core\Controller;
use Application\engine\Route;

class IndexController extends Controller
{
    public function indexAction()
    {
        $data = [];

        $data['logged'] = $this->app->get('user')->isLogged();
//        $data['logged'] ? $data['username'] = $this->app->get('user')->getUsername() : $data['username'] = 'Guest';
            if ($data['logged']) {
              $data['username'] = $this->app->get('user')->getUsername();
              $data['user_id'] = $this->app->get('user')->getId();
            } else {
                $data['username'] = 'Guest';
            }

        if (isset($_SESSION['error'])) {
            $data['error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        } else {
            $data['error'] = '';
        }
        $data['topics'] = $this->app->model('topic')->getTopics();
        $data['comments'] = $this->app->model('comment')->getComments();

        $data['header'] = $this->app->execute(new Route('header'));
        $data['footer'] = $this->app->execute(new Route('footer'));

        $this->app->get('response')->setOutput($this->app->view('home', $data));
    }

}
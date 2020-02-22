<?php

namespace Application\controller;

use Application\core\Controller;
use Application\engine\Route;

/**
 * Class IndexController
 * @package Application\controller
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        $data = [];

        $data['logged'] = $this->app->get('user')->isLogged();
            if ($data['logged']) {
              $data['username'] = $this->app->get('user')->getUsername();
              $data['user_id'] = $this->app->get('user')->getId();
            } else {
                $data['username'] = 'Guest';
            }

        $data['login'] = $this->url->link('account/login');
        $data['logout'] = $this->url->link('account/logout');
        $data['register'] = $this->url->link('account/register');
        $data['add_posts'] = $this->url->link('content/post/add');

        if (isset($_SESSION['error'])) {
            $data['error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        } else {
            $data['error'] = '';
        }
        $data['posts'] = $this->app->model('post')->getPosts();

        $data['header'] = $this->app->view('layout/header');
        $data['footer'] = $this->app->execute(new Route('footer'));

        $this->app->get('response')->setOutput($this->app->view('home', $data));
    }

}
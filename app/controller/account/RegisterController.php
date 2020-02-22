<?php

namespace Application\controller\account;

use Application\core\Controller;
use Application\engine\Route;

class RegisterController extends Controller
{
    public function indexAction()
    {
        $data['err'] = '';
        //Layout
        $data['header_login'] = $this->url->link('login');
        $data['back'] = $this->url->link();
        $data['header'] = $this->app->view('layout/header', $data);
        $data['footer'] = $this->app->view('layout/footer');

        $this->app->get('response')->setOutput($this->app->view('account/register', $data));
    }

    public function validate()
    {
        $err = '';

        if (strlen(trim($this->app->get('request')->post['username'])) < 1 || strlen(trim($this->app->get('request')->post['username'])) > 255) {
            $err = 'Error: Username must be between 1 and 255 characters!';
        } elseif (strlen($this->app->get('request')->post['email']) > 96) {
            $err = 'Error: Email must be less than 96 characters!';
        } elseif ($this->app->model('users')->allowUserByEmail($this->app->get('request')->post['email'])) {
            $err = 'Error: E-Mail Address is already registered!';
        } elseif ((strlen($this->app->get('request')->post['password']) < 4) || strlen($this->app->get('request')->post['passwordVerify']) > 40) {
            $err = 'Error: Password must be between 4 and 20 characters!';
        } elseif ($this->app->get('request')->post['password'] !== $this->app->get('request')->post['passwordVerify']) {
            $err = 'Error: Your password do not matches!';
        }

        return $err;
    }

    public function applyAction()
    {
        $err = $this->validate();
        if ($this->request->isPost() && !$err) {
            $this->app->model('users')->addUser($this->request->post);
            $this->user->login($this->request->post);
            $this->response->redirect($this->url->link('home'));
        } else {
            $this->response->redirect($this->url->link('register'));
            echo $err;
        }

    }
}
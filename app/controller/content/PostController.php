<?php


namespace Application\controller\content;


use Application\core\Controller;

class PostController extends Controller
{
    private $error;

    public function indexAction()
    {
        $data = [
            'logged' => $this->user->isLogged(),
            'action' => $this->url->link('content/post/addComment') . '?id=' . $this->request->get['id'],
            'show_comments' => $this->url->link('content/post/showComments') . '?id=' . $this->request->get['id'],
            'back' => $this->url->link(),
            'error' => ($this->error) ? $this->error : ''
        ];
        $post = $this->app->model('post')->getPost($this->request->get['id']);
        $data = array_merge($data, $post);

        $data['header'] = $this->app->view('layout/header', $data);
        $data['footer'] = $this->app->view('layout/footer');

        $this->app->get('response')->setOutput($this->app->view('post/view', $data));
    }

    public function addAction()
    {
        if (!$this->user->isLogged()) {
            $this->app->get('response')->redirect($this->url->link());
        }

        if ($this->request->isPost()) {
            $post = $this->request->post;
            $post['user_id'] = $this->user->getId();
            $this->app->model('post')->addPost($post);
            $this->url->link('home');
        }

        $data['action'] = $this->url->link('content/post/add');
        $data['back'] = $this->url->link();
        $data['header'] = $this->app->view('layout/header', $data);
        $data['footer'] = $this->app->view('layout/footer');
        $data['error'] = ($this->error) ? $this->error : '';

        $this->app->get('response')->setOutput($this->app->view('post/form', $data));
    }

    public function addCommentAction()
    {
        if ($this->request->isPost()) {
            $comment = [
                'parent_id' => isset($this->request->get['parent_id']) ? $this->request->get['parent_id'] : 0,
                'text' => $this->request->post['text'],
                'post_id' => $this->request->get['id'],
                'user_id' => $this->user->getId(),
                'author' => $this->user->getUsername()
            ];
            $res = $this->app->model('comment')->addComment($comment);

            $json = $comment;
            $json['comment_id'] = $res;
            $json['date_added'] = date('Y-m-d H:i:s');

            echo json_encode($json);
        }
    }

    public function showCommentsAction()
    {
        $comments = (array)$this->app->model('comment')->getCommentByPostId($this->request->get['id']);

        $data = $this->commentSort($comments);
        echo json_encode($data);
    }

    protected function commentSort($comments, $parent_id = 0)
    {
        $answers = [];

        foreach ($comments as $comment1) {
            if ($comment1['parent_id'] == $parent_id) {
                if ($comment1['answers'] = $this->commentSort($comments, $comment1['id'])) {
                    $answers[] = $comment1;
                } else {
                    array_push($answers, $comment1);
                }
            }
        }

        return $answers;
    }

}
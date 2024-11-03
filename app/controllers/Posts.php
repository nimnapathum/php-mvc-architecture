<?php
class Posts extends Controller
{
    public function __construct()
    {
        $this->postsModel = $this->model('m_Posts');
    }

    public function index()
    {
        $posts = $this->postsModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/v_index', $data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'title_err' => '',
                'body_err' => ''
            ];

            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter a title';
            }
            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter the content';
            }

            if (empty($data['title_err']) && empty($data['body_err'])) {
                if ($this->postsModel->create($data)) {
                    flash('post_message', 'Post Created');
                    redirect('Posts/index');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('posts/v_create', $data);
            }
        } else {
            $data = [
                'title' => '',
                'body' => '',
                'title_err' => '',
                'body_err' => ''
            ];
            $this->view('posts/v_create', $data);
        }
    }

    public function edit($postID)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'post_id' => $postID,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'title_err' => '',
                'body_err' => ''
            ];

            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter a title';
            }
            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter the content';
            }

            if (empty($data['title_err']) && empty($data['body_err'])) {
                if ($this->postsModel->edit($data)) {
                    flash('post_message', 'Post is Updated');
                    redirect('Posts/v_edit');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('posts/v_edit', $data);
            }
        } else {
            $post = $this->postsModel->getPostByID($postID);

            //check the owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('Posts/v_index');
            }

            $data = [
                'post_id' => $postID,
                'title' => $post->title,
                'body' => $post->body,
                'title_err' => '',
                'body_err' => ''
            ];
            $this->view('posts/v_edit', $data);
        }
    }

    public function delete($postID)
    {
        $post = $this->postsModel->getPostById($postID);

        //check owner
        if ($post->user_id != $_SESSION['user_id']) {
            redirect('Posts/v_index');
        }else{
            if ($this->postsModel->delete($postID)) {
                flash('post_message', 'Post is deleted');
                redirect('Posts/v_index');
            } else {
                die('Something went wrong!');
            }
        }

    }

    public function show() {}
}

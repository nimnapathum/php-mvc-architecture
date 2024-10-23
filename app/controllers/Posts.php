<?php
    class Posts extends Controller{
        public function __construct(){
            $this->postsModel = $this->model('m_Posts');
        }

        public function index(){
            $data = [];
            $this->view('posts/v_index' , $data);
        }

        public function create(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'title_err' => '',
                    'body_err' => ''
                ];

                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter a title';
                }
                if(empty($data['body'])){
                    $data['body_err'] = 'Please enter the content';
                }

                if(empty($data['title_err']) && empty($data['body_err'])){
                    if($this->postsModel->create($data)){
                        flash('post_message' , 'Post Created');
                        redirect('Posts/index');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                    $this->view('posts/v_create' , $data);
                }

            }else{
                $data = [
                    'title' => '',
                    'body' => '',
                    'title_err' => '',
                    'body_err' => ''
                ];
                $this->view('posts/v_create', $data);
            }
        }
    }
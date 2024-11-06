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

    public function show($postID){
        $post = $this->postsModel->getPostById($postID);

        $data = [
            'posts' => $post
        ];

        $this->view('Posts/v_show' , $data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'image' => $_FILES['image'],
                'image_name' => time() . '_' . $_FILES['image']['name'],
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'image_err' => '',
                'title_err' => '',
                'body_err' => ''
            ];

            if ($data['image']['size'] > 0) {
                if (uploadImage($data['image']['tmp_name'], $data['image_name'], '/img/postsImgs/')) {
                } else {
                    $data['image_err'] = 'Unsuccessfull Image uploading';
                    die('Unsuccessfull Image Uploading');
                }
            } else {
                $data['image_name'] = null;
            }

            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter a title';
            }
            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter the content';
            }

            if (empty($data['title_err']) && empty($data['body_err']) && empty($data['image_err'])) {
                if ($this->postsModel->create($data)) {
                    //get the post id
                    $postID = $this->postsModel->getPostIdByContent($data);
                    $userID = $_SESSION['user_id'];
                    $this->postsModel->addPostInteractions($postID, $userID, 'new');
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
                'image' => '',
                'image_err' => '',
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
                'image' => $_FILES['image'],
                'image_name' => time() . '_' . $_FILES['image']['name'],
                'post_id' => $postID,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'image_err' => '',
                'title_err' => '',
                'body_err' => ''
            ];

            //validation
            $post = $this->postsModel->getPostById($postID);
            $oldImage = PUBROOT . '/img/postsImgs/' . $post->image;

            // photo updated
            // user havent changed the existing image
            if ($_POST['intentionally_removed'] == 'removed') {
                deleteImage($oldImage);
                $data['image_name'] = '';
            } else {
                if ($_FILES['image']['name'] == '') {
                    $data['image_name'] = $post->image;
                } else {
                    updateImage($oldImage, $data['image']['tmp_name'], $data['image_name'], '/img/postsImgs/');
                }
            }

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
                'image' => '',
                'image_name' => $post->image,
                'post_id' => $postID,
                'title' => $post->title,
                'body' => $post->body,
                'image_err' => '',
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
        } else {
            $post = $this->postsModel->getPostByID($postID);
            $oldImage = PUBROOT . '/img/postsImgs/' . $post->image;
            deleteImage($oldImage);

            if ($this->postsModel->delete($postID)) {
                flash('post_message', 'Post is deleted');
                redirect('Posts/v_index');
            } else {
                die('Something went wrong!');
            }
        }
    }

    // post interactions
    // Likes
    public function incPostsLikes($postID)
    {
        $likes = $this->postsModel->incLikes($postID);
        $userID = $_SESSION['user_id'];
        if ($this->postsModel->isPostInteractionsExists($postID, $userID)) {
            $res = $this->postsModel->setPostInteractions($postID, $userID, 'liked');
        } else {
            $res = $this->postsModel->addPostInteractions($postID, $userID, 'liked');
        }

        if ($likes != false && $res != false) {
            echo $likes->likes;
        }
    }

    public function decPostsLikes($postID)
    {
        $likes = $this->postsModel->decLikes($postID);
        $userID = $_SESSION['user_id'];

        $res = $this->postsModel->setPostInteractions($postID, $userID, 'like removed');

        if ($likes != false && $res != false) {
            echo $likes->likes;
        }
    }

    public function incPostsDislikes($postID)
    {
        $dislikes = $this->postsModel->incDislikes($postID);
        $userID = $_SESSION['user_id'];
        if ($this->postsModel->isPostInteractionsExists($postID, $userID)) {
            $res = $this->postsModel->setPostInteractions($postID, $userID, 'disliked');
        } else {
            $res = $this->postsModel->addPostInteractions($postID, $userID, 'disliked');
        }

        if ($dislikes != false && $res != false) {
            echo $dislikes->dislikes;
        }
    }

    public function decPostsDislikes($postID)
    {
        $dislikes = $this->postsModel->decDislikes($postID);
        $userID = $_SESSION['user_id'];

        $res = $this->postsModel->setPostInteractions($postID, $userID, 'dislike removed');

        if ($dislikes != false && $res != false) {
            echo $dislikes->dislikes;
        }
    }
}

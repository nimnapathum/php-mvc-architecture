<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->pagesModel = $this->model('m_Pages');
    }

    public function index()
    {
        $data = [];
        $this->view('pages/v_index', $data);
    }

    public function about()
    {
        $users = $this->pagesModel->getUsers();
        $data = [
            'users' => $users
        ];

        $this->view('v_about', $data);
    }

    public function slider(){
        $this->view('slider');
    }

    public function portpolio(){
        $this->view('portpolio');
    }
}

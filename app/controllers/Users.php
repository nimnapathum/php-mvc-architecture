<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->usersModel = $this->model('m_Users');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // form is submitting
            //validate the data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'age' => trim($_POST['age']),

                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'age_err' => ''
            ];

            //validate each input
            //validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter the name';
            }
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter the email';
            } else {
                if ($this->usersModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already registered!';
                }
            }

            // validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter the password';
            } else if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm the password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // validation is completed and no error then register the user
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['age_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // register user
                if ($this->usersModel->register($data)) {
                    flash('reg_flash' , 'You are successfully registered!');
                    redirect('Users/login');
                } else {
                    die('Something went wrong!');
                }
            } else {
                // load view with errors
                $this->view('users/v_register', $data);
            }
        } else {
            // initial form
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'age' => '',

                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'age_err' => ''
            ];

            // Load view
            $this->view('users/v_register', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // form is submitting
            //validate the data
            $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

            $data=[
                'email'=> trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'email_err'=>'',
                'password_err'=>''
            ];

            //validate the email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter the email';
            }else{
                if($this->usersModel->findUserByEmail($data['email'])){
                    //user found
                }else{
                    //user not found
                    $data['email_err'] = 'No user found';
                }
            }

            //validate the password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter the password';
            }

            //check if all the errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])){
                //login the user
                $loggedUser = $this->usersModel->login($data['email'] , $data['password']);
                if($loggedUser){
                    // User is authenticated
                    // create user session
                    $this->createUserSession($loggedUser);
                }else{
                    $data['password_err'] = 'Password is incorrect';
                    $this->view('users/v_login' , $data);
                }
            }else{
                // Load view with errors
                $this->view('users/v_login' , $data);
            }

        }else{
            $data=[
                'email'=>'',
                'password'=>'',
                'email_err'=>'',
                'password_err'=>''
            ];

            // Load view
            $this->view('users/v_login', $data);
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('Pages/index');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('User/login');
    }

    public function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        }else{
            return false;
        }
    }
}

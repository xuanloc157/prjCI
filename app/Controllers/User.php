<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
session_start();
class User extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            $model = new UserModel();
            $data = [
                'product'  => $model->getUser(),
                'title' => 'Products',
            ];
            echo view('templates/header');
            echo view('user/overview');
            echo view('templates/footer');
        }
        else{
            echo view('templates/header', ['title' => "Login"]);
            echo view('user/login');
            echo view('templates/footer');
        }
        
    }

    public function view($slug = null)
    {
        if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
            echo view('templates/header', ['title' => "Login"]);
            echo view('user/login');
            echo view('templates/footer');
        }else
        {
        $model = new UserModel();

        $data['product'] = $model->getUser($slug);
        if (empty($data['product']))
    {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $slug);
    }
    $data['title'] = $data['product']['name'];
        echo view('templates/header', $data);
        echo view('product/view', $data);
        echo view('templates/footer', $data);
}
    }
    public function create()
{
    
    $model = new UserModel();

    if ($this->request->getMethod() === 'post' && $this->validate([
            'username' => 'required|min_length[3]|max_length[20]',
            'password' => 'required|min_length[3]|max_length[16]',
        ]))
    {
        $model->save([
            'username' => $this->request->getPost('username'),
            'password'  => $this->request->getPost('password'),
            'permission'  => $this->request->getPost('permisstion'),
        ]);

     $this->index();

    }
    else
    {
        echo view('templates/header', ['title' => 'Create a new user']);
        echo view('user/registration');
        echo view('templates/footer');
    }
    
}
public function login(){
    $model = new UserModel();
    if ($this->request->getMethod() === 'post' && $this->validate([
        'username' => 'required|min_length[3]|max_length[20]|is_unique[usersname]',
        'password' => 'required|min_length[3]|max_length[16]',
    ])){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data['user'] = $model->login($username, $password);
        if (empty($data['user'])) {
            echo view('templates/header', ['title' => 'Create a new user']);
        echo view('user/login', ['error' => "wrong password or user name"]);
        echo view('templates/footer');
        }
        else{
            $product = new Product();
            $_SESSION['user'] = $data['user'];
            $product->index();
        }
    }
    else{
        echo view('templates/header', ['title' => "Login"]);
        echo view('user/login');
        echo view('templates/footer');
    }
}
}
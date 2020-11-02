<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['username', 'password', 'permission'];
    public function getUser($slug = false)
{
    if ($slug === false)
    {
        return $this->findAll();
    }

    return $this->asArray()
                ->where(['id' => $slug])
                ->first();
}
public function login($username, $password)
{
   $data =  $this->asArray()
   ->where(['username' => $username, 'password' => $password])
   ->first();

    return $data;
}

}
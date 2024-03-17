<?php

namespace App\Models;

use CodeIgniter\Model;


class UserModel extends Model
{
    //nama table
    protected $table = 'users';
    //primary key
    protected $primaryKey = 'id';
    protected $userTimestamps = true;
    protected $userSoftDeletes = true;
    protected $allowedFields = ['username', 'email', 'password', 'name', 'user_image', 'active', 'created_at', 'updated_at', 'deleted_at'];


    public function getUsers()
    {
        return $this->select('users.id, username, email, name, fullname, user_image, created_at, active, password_hash')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->findAll();
    }

    public function getUser($id)
    {
        return $this->select('users.id, username, email, name, fullname, user_image, created_at, active')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('users.id', $id)
            ->get()->getRowArray();
    }

    public function updateUser($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id' => $id]);
    }

    public function deleteUser($id)
    {
        return $this->db->table($this->table)->delete(['id' => $id]);
    }

    public function searchUser($keyword)
    {
        return $this->table('users')->like('name', $keyword)->orLike('email', $keyword);
    }

    public function getRole($id)
    {
        return $this->db->table('auth_groups_users')->where('user_id', $id)->get()->getResultArray();
    }

    public function addRole($data)
    {
        return $this->db->table('auth_groups_users')->insert($data);
    }

    public function withGroup(string $groupName)
    {
        $group = $this->db->table('auth_groups')->where('name', $groupName)->get()->getFirstRow();

        $this->assignGroup = $group->id;

        return $this;
    }
}

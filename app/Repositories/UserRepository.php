<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getAll()
    {
        return $this->model->with('hobbies')->get();
    }

    public function find($id)
    {
        return $this->model->with('hobbies')->find($id);
    }

    public function create(array $data): User
    {
        return $this->model->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function update($id, array $data): User
    {
        $user = $this->find($id);

        $user->update([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => !empty($data['password'])
                ? bcrypt($data['password'])
                : $user->password,
        ]);

        return $user;
    }

    public function delete($id): bool
    {
        $user = $this->find($id);
        return $user->delete();
    }
}

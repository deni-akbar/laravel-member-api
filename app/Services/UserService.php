<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function create(array $data)
    {
        $user = $this->repo->create($data);

        if (!empty($data['hobbies'])) {
            $user->hobbies()->createMany(
                collect($data['hobbies'])->map(fn($hobby) => ['name' => $hobby])->toArray()
            );
        }

        return $user->load('hobbies');
    }

    public function update($id, array $data)
    {
        $user = $this->repo->find($id);

        if (!$user) {
            return null;
        }

        $user = $this->repo->update($id, $data);

        if (isset($data['hobbies'])) {
            $user->hobbies()->delete();
            $user->hobbies()->createMany(
                collect($data['hobbies'])->map(fn($hobby) => ['name' => $hobby])->toArray()
            );
        }

        return $user->load('hobbies');
    }

    public function delete($id)
    {
        $user = $this->repo->find($id);

        if (!$user) {
            return null;
        }

        return $this->repo->delete($id);
    }
}

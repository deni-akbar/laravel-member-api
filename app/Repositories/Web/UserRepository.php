<?php

namespace App\Repositories\Web;

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
        return $this->model->with('hobbies')->paginate(10); // biasanya web pakai paginate
    }

    public function find($id)
    {
        return $this->model->with('hobbies')->findOrFail($id);
    }

    public function create(array $data)
    {
        // dd($data);
        $user = $this->model->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password'])
        ]);


        if (!empty($data['hobbies'])) {
            // Ambil elemen pertama dari array, lalu pecah dengan koma
            $hobbies = explode(',', $data['hobbies'][0]);

            $user->hobbies()->createMany(
                collect($hobbies)
                    ->map(fn($hobby) => ['name' => trim($hobby)]) // trim untuk hapus spasi
                    ->toArray()
            );
        }

        return $user;
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);
        $user->update([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => !empty($data['password']) ? bcrypt($data['password']) : $user->password,
        ]);

        if (isset($data['hobbies'])) {
            $user->hobbies()->delete();

            $hobbies = collect($data['hobbies'])
                ->filter(fn($hobby) => !empty($hobby))
                ->map(fn($hobby) => ['name' => trim($hobby)])
                ->toArray();

            if (!empty($hobbies)) {
                $user->hobbies()->createMany($hobbies);
            }
        }

        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }
}

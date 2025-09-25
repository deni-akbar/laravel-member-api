<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserStoreRequest;
use App\Http\Requests\Web\UserUpdateRequest;
use App\Services\Web\UserService;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $users = $this->service->getAll();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserStoreRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $user = $this->service->find($id);
        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}

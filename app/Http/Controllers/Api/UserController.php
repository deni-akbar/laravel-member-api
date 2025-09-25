<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->middleware('auth:api'); // JWT
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAll());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->service->find($id));
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        return response()->json(
            $this->service->create($request->validated()),
            201
        );
    }

    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        $user = $this->service->update($id, $request->validated());

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data'    => $user
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }
}

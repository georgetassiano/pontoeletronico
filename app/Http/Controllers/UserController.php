<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Inertia\Inertia;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getUsersByAdmin(Auth::guard('admin')->id());
        
        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'admin' => Auth::guard('admin')->user()
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $data = $request->validated();
            $data['admin_id'] = Auth::guard('admin')->id();
            $user = $this->userService->create($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Usuário criado com sucesso',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar usuário: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            $updatedUser = $this->userService->update($data, $user->id);
            
            return response()->json([
                'success' => true,
                'message' => 'Usuário atualizado com sucesso',
                'data' => $updatedUser
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar usuário: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $this->userService->delete($user->id);
            
            return response()->json([
                'success' => true,
                'message' => 'Usuário excluído com sucesso'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir usuário: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getAllUsers()
    {
        try {
            $users = $this->userService->getUsersByAdmin(Auth::guard('admin')->id());
            
            return response()->json([
                'success' => true,
                'data' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar usuários: ' . $e->getMessage()
            ], 500);
        }
    }
}

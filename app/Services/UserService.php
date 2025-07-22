<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class UserService extends BaseService implements UserServiceInterface
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        $data['admin_id'] = Auth::id();
        return $this->getRepository()->create($data);
    }

    public function update(array $data, int $userId): User
    {
        // Remove password se estiver vazio para não atualizar
        if (isset($data['password']) && empty($data['password'])) {
            unset($data['password']);
        } elseif (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        
        return $this->getRepository()->update($data, $userId);
    }

    public function delete(int $userId): JsonResponse
    {
        return $this->getRepository()->delete($userId);
    }

    public function getUsersByAdmin(int $adminId): Collection
    {
        return $this->getRepository()->where('admin_id', $adminId)->get();
    }
}
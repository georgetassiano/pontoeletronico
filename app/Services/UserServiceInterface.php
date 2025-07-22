<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use App\Models\Admin;

interface UserServiceInterface extends BaseServiceInterface
{
    public function create(array $data): User;
    public function update(array $data, int $userId): User;
    public function delete(int $userId): JsonResponse;
    public function getUsersByAdmin(int $adminId): Collection;
}

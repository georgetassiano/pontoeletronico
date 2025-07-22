<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface TimesheetServiceInterface extends BaseServiceInterface
{
    public function store(User $user): JsonResponse;
    public function getAllTimesheets(): JsonResponse;
    public function getUserTimesheets(User $user): JsonResponse;
}

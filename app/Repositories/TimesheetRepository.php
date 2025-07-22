<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Interface TimesheetRepository.
 *
 * @package namespace App\Repositories;
 */
interface TimesheetRepository extends RepositoryInterface
{
    public function getAll() : Collection;
    public function getByUserId(int $userId) : Collection;
}

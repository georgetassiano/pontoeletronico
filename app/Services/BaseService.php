<?php
namespace App\Services;
use Prettus\Repository\Eloquent\BaseRepository;
class BaseService implements BaseServiceInterface
{

    private BaseRepository $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getRepository() {
        return $this->repository;
    }
}

<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TimesheetRepository;
use App\Models\Timesheet;
use App\Validators\TimesheetValidator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class TimesheetRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TimesheetRepositoryEloquent extends BaseRepository implements TimesheetRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Timesheet::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAll() : Collection
    {
        $results = DB::select("
            SELECT 
                timesheets.id,
                users.name as user_name,
                users.position,
                FLOOR(DATEDIFF(CURDATE(), users.birth_date) / 365.25) as age,
                admins.name as admin_name,
                DATE_FORMAT(timesheets.created_at, '%d/%m/%Y') as date,
                DATE_FORMAT(timesheets.created_at, '%H:%i:%s') as time,
                timesheets.created_at
            FROM timesheets 
            JOIN users ON timesheets.user_id = users.id 
            JOIN admins ON users.admin_id = admins.id 
            ORDER BY timesheets.created_at DESC
        ");
        
        return collect($results);
    }

    public function getByUserId(int $userId) : Collection
    {
        return $this->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }


    
}

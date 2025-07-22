<?php
namespace App\Services;

use App\Models\User;
use App\Models\Timesheet;
use Illuminate\Http\JsonResponse;
use App\Repositories\TimesheetRepository;
use Carbon\Carbon;

class TimesheetService extends BaseService implements TimesheetServiceInterface
{
    public function __construct(TimesheetRepository $repository)
    {
        parent::__construct($repository);
    }

    public function store(User $user): JsonResponse
    {
        try {
            // Verificar se já existe um registro de ponto hoje
            $today = Carbon::today();
            $existingTimesheet = Timesheet::where('user_id', $user->id)
                ->whereDate('created_at', $today)
                ->first();

            if ($existingTimesheet) {
                return response()->json([
                    'success' => false,
                    'message' => 'Você já registrou seu ponto hoje.',
                    'timesheet' => $existingTimesheet
                ], 400);
            }

            // Criar novo registro de ponto
            $timesheet = $this->getRepository()->create([
                'user_id' => $user->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Ponto registrado com sucesso!',
                'timesheet' => $timesheet,
                'registered_at' => Carbon::now()->format('d/m/Y H:i:s')
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao registrar ponto. Tente novamente.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAllTimesheets(): JsonResponse
    {
        try {
            $timesheets = $this->getRepository()->getAll();
            
            return response()->json([
                'success' => true,
                'timesheets' => $timesheets
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar registros.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getUserTimesheets(User $user): JsonResponse
    {
        try {
            $timesheets = $this->getRepository()->getByUserId($user->id)
                ->map(function ($timesheet) {
                    return [
                        'id' => $timesheet->id,
                        'date' => $timesheet->created_at->format('d/m/Y'),
                        'time' => $timesheet->created_at->format('H:i:s'),
                        'datetime' => $timesheet->created_at->format('d/m/Y H:i:s')
                    ];
                });

            return response()->json([
                'success' => true,
                'timesheets' => $timesheets
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar seus registros.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
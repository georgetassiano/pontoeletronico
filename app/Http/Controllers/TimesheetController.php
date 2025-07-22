<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TimesheetService;

class TimesheetController extends Controller
{
    public function __construct(private TimesheetService $timesheetService)
    {
    }

    /**
     * Registra o ponto do funcionário
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return $this->timesheetService->store($request->user());
    }

    /**
     * Busca todos os registros de ponto (para administradores)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllTimesheets(Request $request)
    {
        return $this->timesheetService->getAllTimesheets();
    }

    /**
     * Busca os registros de ponto do usuário logado
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserTimesheets(Request $request)
    {
        return $this->timesheetService->getUserTimesheets($request->user());
    }
}

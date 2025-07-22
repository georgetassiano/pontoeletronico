<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Send a success response
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResponse($data = null, $message = 'Success', $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * Send an error response
     *
     * @param string $message
     * @param int $status
     * @param mixed $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendError($message = 'Error', $status = 400, $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $status);
    }
}

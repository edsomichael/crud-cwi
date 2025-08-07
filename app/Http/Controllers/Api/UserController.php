<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Helpers\ApiResponse;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return ApiResponse::success([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                    ], 'Usuário criado com sucesso', 201);
            } catch (ValidationException $e) {
                return ApiResponse::error('Erro de validação.', $e->errors(), 422);
            } catch (\Exception $e) {
                return ApiResponse::error('Erro interno no servidor.', [], 500);
            }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:6',
        ]);

        $user->update($data);

        return response()->json($user);
    }

     public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
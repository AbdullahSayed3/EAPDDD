<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\Application;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $model;
    public function __construct(Application $model)
    {
        $this->model = $model;
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();
            $applicant = Application::where('email_address', $data['email'])->first();

            if (! $applicant || ! Hash::check($request->password, $applicant->password)) {
                return ApiResponser::unauthorizedResponse();
            }
            $applicant->tokens()->delete();
            $applicant['token'] = $applicant->createToken('user Token')->plainTextToken;
            return ApiResponser::successResponse(trans('main.login_successfuly'), 200, new UserResource($applicant));
        } catch (Exception $e) {
            return ApiResponser::serverErrorsResponse($e->getMessage());
        }
    }
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return ApiResponser::successResponse('Success Logout');
    }
}

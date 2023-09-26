<?php

namespace App\Modules\User\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Core\Responses\DataResponse;
use App\Modules\Core\Responses\ErrorResponse;
use App\Modules\User\Dto\Auth\LoginUserDto;
use App\Modules\User\Dto\Auth\RegisterUserDto;
use App\Modules\User\Requests\Auth\LoginUserRequest;
use App\Modules\User\Requests\Auth\RegisterUserRequest;
use App\Modules\User\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller {
    public function __construct(private readonly AuthService $authService,
    ){}

    /**
     * @param LoginUserRequest $request
     * @return JsonResponse
     */
    final public function login(LoginUserRequest $request): JsonResponse
    {
        try {
            $dto = new LoginUserDto($request->validated());

            $token = $this->authService->login($dto);

            return (new DataResponse([
                "access_token" => $token,
            ]))->toJson();

        } catch (\InvalidArgumentException $e) {
            return (new ErrorResponse(message: $e->getMessage(), status: $e->getCode()))->toJson();
        }
         catch (Exception $e) {
            return (new ErrorResponse(message: 'Server Error', status: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR))->toJson();
        }

    }

    final public function logout(Request $request): JsonResponse
    {
        try {
            $this->authService->logout($request->user());

            return (new DataResponse(message: 'logged out successfully'))->toJson();

        } catch (\Exception $e) {
            return (new ErrorResponse(message: 'Server Error', status: $e->getCode()))->toJson();
        }
    }

    /**
     * @param RegisterUserRequest $request
     * @return JsonResponse
     */
    final public function register(RegisterUserRequest $request): JsonResponse
    {
        try {
            $dto = new RegisterUserDto($request->validated());

            $this->authService->register($dto);

            return (new DataResponse(message: 'User registered successfully'))->toJson();

        } catch (Exception $e) {
            return (new ErrorResponse(message: 'Server Error', status: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR))->toJson();
        }

    }
}

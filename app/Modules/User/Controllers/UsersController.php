<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Accommodation\Exceptions\AccommodationNotAvailableException;
use App\Modules\Core\Responses\DataResponse;
use App\Modules\Core\Responses\ErrorResponse;
use App\Modules\User\Resources\UserResource;
use App\Modules\User\Services\UsersService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UsersController extends Controller {
    public function __construct(private readonly UsersService $usersServers){}


    /**
     * Register any application services.
     * @param Request $request
     * @return JsonResponse
     */
    final public function index(Request $request): JsonResponse
    {
        try {
            $users = $this->usersServers->getAllUsers();

            $users = UserResource::collection($users);

            return (new DataResponse(data:$users->toArray($request)))->toJson();

        } catch (AccommodationNotAvailableException $e) {
            return (new ErrorResponse(message: $e->getMessage(), status: $e->getCode()))->toJson();
        } catch (Exception $e) {
            return (new ErrorResponse(message: 'Server Error', status: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, exception: $e))->toJson();
        }
    }
}

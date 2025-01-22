<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Service\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 查詢 特定日期範圍內 的 口罩交易 總金額最高的 X位 ( startDate , endDate , 前X名 )
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function topBuyer(UserRequest $request): JsonResponse
    {
        $params = $request->only(['startDate', 'endDate', 'top']);

        $this->responseData['response'] = $this->userService->topBuyer($params)[0];

        return response()->json($this->responseData);
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Service\OrderService;
use App\Service\UserService;
use Illuminate\Http\JsonResponse;


class OrderController extends Controller
{
    private $orderService;
    private $userService;

    public function __construct(OrderService $orderService, UserService $userService){
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    /**
     * 買口罩(使用者、口罩、藥局)
     *
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function buyMask(OrderRequest $request): JsonResponse
    {
        $params = $request->only([
            'userID',
            'userName',
            'pharmacyName',
            'maskName',
            'amount',
            'maskID',
            'pharmacyID',
            'date'
        ]);


        if(!$this->userService->checkUser($params['userID'])){
            $this->responseData['error'] = "user not found";
            return response()->json($this->responseData);
        }

        $result = $this->orderService->buyMask($params);

        if($result['status'])
        {
            $this->responseData['response'] = $result['msg'];
            $this->responseData['error'] = null;
        }else{
            $this->responseData['error'] = $result['msg'];
        }

        return response()->json($this->responseData);
    }

    /**
     * 查詢 時間內 口罩的 交易總金額、總數量 (startDate , endDate)
     *
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function statisticsByDate(OrderRequest $request): JsonResponse
    {
        $params = $request->only(['startDate', 'endDate']);

        $this->responseData['response'] = $this->orderService->statisticsByDate($params);

        return response()->json($this->responseData);
    }
}

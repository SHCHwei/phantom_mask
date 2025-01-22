<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaskRequest;
use App\Service\MaskService;
use Illuminate\Http\JsonResponse;


class MaskController extends Controller
{
    private $maskService;

    public function __construct(MaskService $maskService){
        $this->maskService = $maskService;
    }


    /**
     * 查詢某間藥局的所有口罩 ( 藥局名稱 )
     *
     * @param MaskRequest $request
     * @return JsonResponse
     */
    public function getMasks(MaskRequest $request): JsonResponse
    {
        $params = $request->only(['id']);

        $this->responseData['response'] = $this->maskService->getMasks($params['id']);

        return response()->json($this->responseData);
    }


    /**
     * 查詢 價位 XXX~XXX 內 & 口罩種類有 X種 的藥局 ( 價錢範圍, 大於|小於 X種類     )
     *
     * @param MaskRequest $request
     * @return JsonResponse
     */
    public function priceAndKind(MaskRequest $request): JsonResponse
    {
        $params = $request->only(['topLimit', 'bottomLimit', 'operators', 'kinds']);

        $this->responseData['response'] = $this->maskService->priceAndKind($params);

        return response()->json($this->responseData);
    }

}

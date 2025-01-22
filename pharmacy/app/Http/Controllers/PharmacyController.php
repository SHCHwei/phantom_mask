<?php

namespace App\Http\Controllers;


use App\Http\Requests\PharmacyRequest;
use App\Service\MaskService;
use App\Service\PharmacyService;
use Illuminate\Http\JsonResponse;


class PharmacyController extends Controller
{
    private $pharmacyService;
    private $maskService;

    public function __construct(PharmacyService $pharmacyService, MaskService $maskService){
        $this->pharmacyService = $pharmacyService;
        $this->maskService = $maskService;
    }

    /**
     * 查詢特定時間內有營業的藥局 (禮拜幾 或是 幾點~幾點 )
     *
     * @param PharmacyRequest $request
     * @return JsonResponse
     */
    public function searchByOpeningHours(PharmacyRequest $request): JsonResponse
    {
        if($request->exists('day')){
            $this->responseData['response'] = $this->pharmacyService->searchPharmacyByDay($request->get('day'));
        }
        else{
            $data = $request->only('hour');
            $this->responseData['response'] = $this->pharmacyService->searchPharmacyByHours($data);
        }

        return response()->json($this->responseData);
    }


    /**
     * 模糊搜索 口罩和藥局 (名稱)
     *
     * @param PharmacyRequest $request
     * @return JsonResponse
     */
    public function keywordSearch(PharmacyRequest $request): JsonResponse
    {
        $keyword = $request->get('name');
        $this->responseData['response'] = $this->pharmacyService->keywordSearch($keyword);

        return response()->json($this->responseData);
    }

}

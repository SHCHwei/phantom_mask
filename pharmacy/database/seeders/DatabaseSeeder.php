<?php

namespace Database\Seeders;

use App\Models\Mask;
use App\Models\Order;
use App\Models\Pharmacy;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public $pharmacyID = null;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = Storage::disk('local')->json('pharmacies.json');

        foreach ($data as $item) {

            $pharmacy = [
                'name' => $item['name'],
                'openingHours' => $item['openingHours'],
                'cashBalance' => $item['cashBalance'],
            ];

            $resultPharmacy = Pharmacy::query()->create($pharmacy);

            $this->pharmacyID = $resultPharmacy->id;

            $opening = $this->formatOpeningHours($item['openingHours']);
            DB::table('opening')->insert($opening);


            foreach ($item['masks'] as $mask) {
                $masks = [
                    'name' => $mask['name'],
                    'price' => $mask['price'],
                    'pharmacyID' => $resultPharmacy->id,
                ];

                Mask::query()->create($masks);
            }

        }

        var_dump("First over");


        $data = Storage::disk('local')->json('users.json');

        foreach($data as $item)
        {
            $user = [
                'name' => $item['name'],
                'cashBalance' => $item['cashBalance'],
            ];

            $resultUser = User::query()->create($user);

            foreach ($item['purchaseHistories'] as $row)
            {
                $pid = Pharmacy::query()->where("name", $row['pharmacyName'])->first()->id;
                $mid = Mask::query()->where([["name", "=" , $row['maskName']], ["pharmacyID", "=", $pid]])->first()->id;

                $order = [
                    'pharmacyName' => $row['pharmacyName'],
                    'maskName' => $row['maskName'],
                    'transactionAmount' => $row['transactionAmount'],
                    'transactionDate' => $row['transactionDate'],
                    'userID' => $resultUser->id,
                    'pharmacyID' => $pid,
                    'maskID' => $mid
                ];

                Order::query()->create($order);
            }
        }

        var_dump("Second over");
    }


    public function formatOpeningHours(string $information, $openInfo = [])
    {
        $weeks = [
            'Mon',
            'Tue',
            'Wed',
            'Thur',
            'Fri',
            'Sat',
            'Sun'
        ];

        $doDetail = function($target) use($weeks) {

            $result = array();

            if(str_contains($target, ",")){
                $detail = explode(" ", str_replace(",", "", trim($target)));

                $strLen = count($detail);

                $days = array_slice($detail, 0, $strLen-3);

                $start = $detail[$strLen-3].":00";
                $end = $detail[$strLen-1].":00";

                if($start < $end){
                    foreach($days as $day) {
                        $result[] = [
                            "pharmacyID" => $this->pharmacyID,
                            "days" => $day,
                            "timeStart" => $start,
                            "timeEnd" => $end
                        ];
                    }
                } else{

                    foreach($days as $day)
                    {
                        $result[] = [
                            "pharmacyID" => $this->pharmacyID,
                            "days" => $day,
                            "timeStart" => $start,
                            "timeEnd" => "23:59:00",
                        ];

                        $target = array_search($day, $weeks);
                        $target = ($target == 7) ? 0 : $target+1;

                        $result[] = [
                            "pharmacyID" => $this->pharmacyID,
                            "days" => $weeks[$target],
                            "timeStart" => "00:00:00",
                            "timeEnd" => $end,
                        ];
                    }
                }

            }
            else if(str_contains($target, "-")){

                $detail = explode(" ", trim($target));

                $strLen = count($detail);

                $startDataKey = array_search($detail[0], $weeks);
                $endDataKey = array_search($detail[2], $weeks);

                $start = $detail[$strLen-3].":00";
                $end = $detail[$strLen-1].":00";


                for($i = $startDataKey; $i <= $endDataKey; $i++)
                {
                    if( $start < $end )
                    {
                        $result[] = [
                            "pharmacyID" => $this->pharmacyID,
                            "days" => $weeks[$i],
                            "timeStart" => $start,
                            "timeEnd" => $end,
                        ];
                    } else{

                        $result[] = [
                            "pharmacyID" => $this->pharmacyID,
                            "days" => $weeks[$i],
                            "timeStart" => $start,
                            "timeEnd" => "23:59:00",
                        ];

                        $weeksKey = ($i == 6) ? 0 : $i+1 ;

                        $result[] = [
                            "pharmacyID" => $this->pharmacyID,
                            "days" => $weeks[$weeksKey],
                            "timeStart" => "00:00:00",
                            "timeEnd" => $end,
                        ];

                    }
                }

            }

            return $result;
        };

        if (substr_count( $information , "/") == 0)
        {
            $openInfo = array_merge($openInfo, $doDetail($information));

            return $openInfo;
        }else{

            $infoList = explode("/", $information);

            return $this->formatOpeningHours( $infoList[1], array_merge($openInfo, $doDetail($infoList[0])) );
        }

    }
}

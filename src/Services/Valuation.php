<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/7/15
 * Time: 15:25
 */

namespace SquRab\Common\Services;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use SquRab\Common\Exception\ErrorException;

class Valuation
{
    private $config;
    private $temperature = 34.5;

    /**
     * 获取配置
     * Valuation constructor.
     */
    public function __construct()
    {
        $this->config = json_decode(DB::table('sys_conf')->where('c_key', 'order_premium')->value('c_value'), true);
    }

    /**
     * 笛卡尔积
     * @param array $sets
     * @return array|mixed
     */
    private function CartesianProduct(array $sets)
    {
        $result = [];
        for ($i = 0, $count = count($sets); $i < $count - 1; $i++) {
            if ($i == 0) {
                $result = $sets[$i];
            }
            $tmp = [];
            foreach ($result as $res) {
                foreach ($sets[$i + 1] as $set) {
                    $tmp[] = $res . $set;
                    $tmp[] = $set . $res;
                }
            }
            $result = $tmp;
        }
        return $result;
    }

    /**
     * 计算过桥费
     * @param int $adCode
     * @param int $start_district
     * @param int $end_district
     * @return int
     * @throws ErrorException
     */
    public function riverFee(int $adCode, int $start_district, int $end_district)
    {
        if ($this->config['is_open_river_fee']) {
            $openCity = DB::table('region_opened')->pluck('region_id')->toArray();
            if (in_array($adCode, $openCity)) {
                switch ($adCode) {
                    case 420100:
                        $params = [
                            [
                                420102,
                                420103,
                                420104,
                                420105,
                                420112,
                                420113,
                                420114,
                                420116,
                                420117],
                            [
                                420106,
                                420107,
                                420111,
                                420115
                            ]
                        ];
                        $array = array_merge($params[0], $params[1]);
                        if (!in_array($start_district, $array) && !in_array($end_district, $array))
                            throw new ErrorException('起始行政区或结束行政区未在开放城市');

                        $res = $this->CartesianProduct($params);

                        if (in_array($start_district . $end_district, $res))
                            return $this->config['river_fee'];
                        else
                            return 0;
                }
            }
            throw new ErrorException('该城市未开通');
        }
        return 0;
    }

    /**
     * 计算天气溢价
     * @param int $district
     * @return mixed
     * @throws ErrorException
     */
    public function weatherFee(int $district)
    {
        $key = config('squrab.amap.key');

        if (!$key)
            throw new ErrorException('请配置正确的高德key');

        $http = new Client();
        $result = $http->get('https://restapi.amap.com/v3/weather/weatherInfo?parameters', [
            'query' => [
                'key' => $key,
                'city' => $district,
                'extensions' => 'base'
            ]
        ]);

        if ($result->getStatusCode() === 200) {
            $response = json_decode($result->getBody()->getContents(), true);
            if (!empty($response['infocode']) && $response['infocode'] === '10000') {
                $weather = current($response['lives'])['weather'];
                foreach ($this->config['weather_fee'] as $key => $value) {
                    if (strpos($weather, '-') !== false) {
                        $ele = explode('-', $weather);
                        $weather = end($ele);
                    }
                    if (in_array($weather, $value['type']) && $this->config['is_open_weather_fee']) {
                        $one['weather'] = $weather;
                        $one['fee'] = $value['fee'];
                    } else {
                        $one['weather'] = $weather;
                        $one['fee'] = 0;
                    }
                    if ((int)$one['fee'] === 0 && (real)current($response['lives'])['temperature'] > $this->temperature)
                        $one['fee'] = 1;
                    return $one;
                }
            }
        }

        throw new ErrorException('获取天气失败');
    }
}

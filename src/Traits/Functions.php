<?php
/**
 * Created by BvBeJ.
 * User: admin
 * Date: 2018/9/17
 * Time: 17:50
 * Use: 公共功能函数
 */

namespace SquRab\Common\Traits;

use SquRab\Common\Models\User;
use SquRab\Common\Models\Coupon;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Facades\Cache;

trait Functions
{
    public function dateAt($timestamp)
    {
        if (is_integer($timestamp) || strtotime($timestamp))
            $timestamp = strtotime($timestamp);
        return now()->createFromTimestamp($timestamp, 'PRC')->toDateTimeString();
    }

    public function treeData(array $data, int $pid = 0)
    {
        $result = [];
        foreach ($data as $v) {
            if ($v['parent_id'] == $pid) {
                if ($arr = $this->treeData($data, $v['value']))
                    $v['children'] = $arr;
                $result[] = $v;
            }
        }
        return $result;
    }

    public function pageArray(int $listRow, int $page, array $array)
    {
        $start = ($page - 1) * $listRow;
        $pageData = array_slice($array, $start, $listRow);
        return $pageData;
    }

    public function mySort(array $arrays, string $sort_key, $sort_order = SORT_DESC, $sort_type = SORT_NUMERIC)
    {
        if (is_array($arrays)) {
            foreach ($arrays as $array) {
                if (is_array($array)) {
                    $key_arrays[] = $array[$sort_key];
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
        array_multisort($key_arrays, $sort_order, $sort_type, $arrays);
        return $arrays;
    }

    public function uniqueRand($min, $max, $num)
    {
        $count = 0;
        $return = array();
        while ($count < $num) {
            $return[] = mt_rand($min, $max);
            $return = array_flip(array_flip($return));
            $count = count($return);
        }
        shuffle($return);
        return $return;
    }

    public function arrayToStr(array $array)
    {
        $item = [];
        foreach ($array as $k => $v)
            foreach ($v as $key => $val)
                $item[] = $val;
        return implode('|', $item);
    }

    public function getDirFiles($folder)
    {
        $filesArr = [];
        if (is_dir($folder)) {
            $resource = opendir($folder);
            while ($file = readdir($resource)) {
                if ($file === '.' || $file === '..') {
                    continue;
                } elseif (is_file($folder . '/' . $file)) {
                    $filesArr[] = $file;
                } elseif (is_dir($folder . '/' . $file)) {
                    $filesArr[$file] = $this->getDirFiles($folder . '/' . $file);
                }
            }
        }
        return $filesArr;
    }

    public function hidePhone($phone)
    {
        return substr_replace($phone, '****', 3, 4);
    }

    public function splitName(string $fullName)
    {
        $hyphenated = [
            '欧阳', '太史', '端木', '上官', '司马', '东方', '独孤', '南宫', '万俟', '闻人', '夏侯',
            '诸葛', '尉迟', '公羊', '赫连', '澹台', '皇甫', '宗政', '濮阳', '公冶', '太叔', '申屠',
            '公孙', '慕容', '仲孙', '钟离', '长孙', '宇文', '城池', '司徒', '鲜于', '司空', '汝嫣',
            '闾丘', '子车', '亓官', '司寇', '巫马', '公西', '颛孙', '壤驷', '公良', '漆雕', '乐正',
            '宰父', '谷梁', '拓跋', '夹谷', '轩辕', '令狐', '段干', '百里', '呼延', '东郭', '南门',
            '羊舌', '微生', '公户', '公玉', '公仪', '梁丘', '公仲', '公上', '公门', '公山', '公坚',
            '左丘', '公伯', '西门', '公祖', '第五', '公乘', '贯丘', '公皙', '南荣', '东里', '东宫',
            '仲长', '子书', '子桑', '即墨', '达奚', '褚师'
        ];
        $vLength = mb_strlen($fullName, 'utf-8');
        if ($vLength > 2) {
            $preTwoWords = mb_substr($fullName, 0, 2, 'utf-8');
            if (in_array($preTwoWords, $hyphenated)) {
                $last_name = $preTwoWords;
            } else {
                $last_name = mb_substr($fullName, 0, 1, 'utf-8');
            }
        } else if ($vLength == 2) {
            $last_name = mb_substr($fullName, 0, 1, 'utf-8');
        } else {
            $last_name = $fullName;
        }
        return $last_name . '师傅';
    }

    public function base64EncodeImage(string $image_file)
    {
        $client = new HttpClient();
        $arr = explode('/', $image_file);
        $path = storage_path(end($arr));
        $client->get($image_file, ['save_to' => $path]);
        $image_info = getimagesize($path);
        $image_data = fread(fopen($path, 'r'), filesize($path));
        $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
        unlink($path);
        return $base64_image;
    }

    public function diffBetweenTwoDays(string $day1, string $day2)
    {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);
        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }
        return ($second1 - $second2) / 86400;
    }

    public function createCustomId(int $user_type)
    {
        $start = now()->createFromTimeString('2018-12-01 00:00:00');
        $diff = $start->diffInMonths();
        $custom_id = User::query()->where('user_type', $user_type)->pluck('custom_id')->toArray();
        if ($custom_id) {
            $arr = [];
            foreach ($custom_id as $item) {
                $value = substr($item, 0, 2);
                if (($diff + 10) == $value)
                    array_push($arr, substr($item, 2));
            }
            if ($arr) {
                rsort($arr);
                $max = current($arr);
                $ext = $max + mt_rand(1, 99);
                if ($user_type === 1)
                    if (strlen($ext) < 6)
                        $ext = '0' . $ext;
            } else
                if ($user_type === 1)
                    $ext = '010001';
                else
                    $ext = '1001';
            return (int)((10 + $diff) . $ext);
        } else {
            if ($user_type === 1)
                $start_num = '010001';
            else
                $start_num = '1001';
            return (int)((10 + $diff) . $start_num);
        }
    }

    public function creatPayNumber()
    {
        $M = date('m');
        $D = date('d');
        $key = 'pay_' . $M . $D;
        if (($cache = Cache::pull($key)) && is_array($cache)) {
            $payNumber = array_pop($cache);
            Cache::put($key, $cache, now()->tomorrow('PRC'));
        } else {
            $cache = $this->uniqueRand(1000, 9999, 2000);
            $payNumber = array_pop($cache);
            Cache::add($key, $cache, now()->tomorrow('PRC'));
        }
        $start = now()->createFromTimeString('2018-12-01 00:00:00');
        $diff = $start->diffInMonths();
        return (int)(10 + $diff . date('d') . $payNumber);
    }

    public function generateOrderNumber(int $num)
    {
        $M = date('m');
        $D = date('d');
        $key = 'order_' . $M . $D;
        $rand = [];
        if (($cache = Cache::pull($key)) && is_array($cache)) {
            for ($i = 0; $i < $num; $i++)
                $rand[$i] = array_pop($cache);
            Cache::put($key, $cache, now()->tomorrow('PRC'));
        } else {
            $cache = [];
            for ($i = 1000; $i < 100000; $i++) {
                switch ($i) {
                    case $i < 10000:
                        $j = '00' . $i;
                        break;
                    case $i < 100000:
                        $j = '0' . $i;
                        break;
                    default:
                        $j = (string)$i;
                }
                array_push($cache, $j);
            }
            shuffle($cache);
            for ($i = 0; $i < $num; $i++)
                $rand[$i] = array_pop($cache);
            Cache::add($key, $cache, now()->tomorrow('PRC'));
        }
        $arr = [];
        $start = now()->createFromTimeString('2018-12-01 00:00:00');
        $diff = $start->diffInMonths();
        foreach ($rand as $value)
            array_push($arr, (int)(10 + $diff . date('d') . $value . '01'));
        return $arr;
    }

    public function creatCouponNumber()
    {
        $num = date('Ymd');
        $max = Coupon::query()->where('coupon_sn', 'like', "$num%")->max('coupon_sn');
        if ($max) {
            $round = substr($max, 8, 2);
            if ($round > 9)
                $res = $num . ((int)$round + 1);
            else
                $res = $num . '0' . ((int)$round + 1);
        } else
            $res = $num . '01';
        return $res;
    }
}

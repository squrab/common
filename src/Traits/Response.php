<?php
/**
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/6/10
 * Time: 11:01
 */

namespace SquRab\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

define('SUCCESS_CODE', 10000);//正常相应

define('UNKNOWN_ERROR', 20000);//业务处理失败
define('INVALID_TOKEN_CODE', 20001);//无效的访问令牌

define('INVALID_PARAMETER_CODE', 40001);//参数无效
define('ERROR_PARAMETER_CODE', 40002);//服务器处理错误，参数不符合预期

define('SEVER_ERROR_CODE', 50001);//服务器错误
define('THROTTLE_REQUEST_CODE', 50002);//请求超限
define('METHOD_NOT_ALLOWED_CODE', 50003);//请求方法错误
define('NOT_FOUND_HTTP_CODE', 50004);//路由未找到

const HEADERS = [];

const ERROR_PARAMETER_CODE_TYPE = [
    ''
];

trait Response
{
    /**
     * 错误相应
     * @param int $code
     * @param string $msg
     * @param string $error
     * @return \Illuminate\Http\JsonResponse
     */
    public function fail(int $code, string $msg, string $error = '')
    {
        return response()->json([
            'code' => $code,
            'msg' => $msg,
            'error' => $error,
            'data' => null
        ], 200, HEADERS);
    }

    /**
     * 正常相应
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function success(array $data = [])
    {
        return response()->json([
            'code' => SUCCESS_CODE,
            'msg' => '请求成功',
            'error' => '',
            'data' => $data
        ], 200, HEADERS);
    }

    /**
     * 表单验证
     * @param Request $request
     * @param array $rule
     * @param array $messages
     * @return bool|string
     */
    public function verifyParam(Request $request, array $rule, array $messages = [])
    {
        $param = $request->all();
        $validator = Validator::make($param, $rule, $messages)->errors()->toArray();
        if ($validator)
            return strtoupper(current(str_replace(' ', '_', $validator)));
        return false;
    }
}

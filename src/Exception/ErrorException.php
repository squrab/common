<?php
/**
 * Use:
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/7/5
 * Time: 14:53
 */

namespace SquRab\Common\Exception;

use Exception;
use Throwable;

class ErrorException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

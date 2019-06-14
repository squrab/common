<?php
/**
 * Created by LiFangYi.
 * User: admin@bvbej.com
 * Date: 2019/3/8
 * Time: 9:53
 */

namespace SquRab\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model
{
    protected $guarded = [];
    protected $dates = ['updated_at', 'created_at'];

    /**
     * 批量插入
     * @param array $multipleData
     * @param bool $isAddDate
     * @return bool
     */
    public function addBatch(array $multipleData, $isAddDate = true)
    {
        if ($isAddDate) {
            $date = date('Y-m-d H:i:s');
            foreach ($multipleData as &$item) {
                $item['created_at'] = $date;
                $item['updated_at'] = $date;
            }
        }

        return DB::table($this->getTable())
            ->insert($multipleData);
    }

    /**
     * 批量更新
     * @param array $multipleData
     * @return bool|int
     */
    public function updateBatch($multipleData = [])
    {
        try {
            if (empty($multipleData)) {
                throw new \Exception("数据不能为空");
            }
            $tableName = DB::getTablePrefix() . $this->getTable();
            $firstRow = current($multipleData);

            $updateColumn = array_keys($firstRow);
            // 默认以id为条件更新，如果没有ID则以第一个字段为条件
            $referenceColumn = isset($firstRow['id']) ? 'id' : current($updateColumn);
            unset($updateColumn[0]);

            $updateSql = "UPDATE " . $tableName . " SET ";
            $sets = [];
            $bindings = [];
            foreach ($updateColumn as $uColumn) {
                $setSql = "`" . $uColumn . "` = CASE ";
                foreach ($multipleData as $data) {
                    $setSql .= "WHEN `" . $referenceColumn . "` = ? THEN ? ";
                    $bindings[] = $data[$referenceColumn];
                    $bindings[] = $data[$uColumn];
                }
                $setSql .= "ELSE `" . $uColumn . "` END ";
                $sets[] = $setSql;
            }
            $updateSql .= implode(', ', $sets);
            $whereIn = collect($multipleData)->pluck($referenceColumn)->values()->all();
            $bindings = array_merge($bindings, $whereIn);
            $whereIn = rtrim(str_repeat('?,', count($whereIn)), ',');
            $updateSql = rtrim($updateSql, ", ") . " WHERE `" . $referenceColumn . "` IN (" . $whereIn . ")";
            // 传入预处理sql语句和对应绑定数据
            return DB::update($updateSql, $bindings);
        } catch (\Exception $e) {
            return false;
        }
    }
}

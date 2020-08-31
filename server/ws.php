<?php 

/**
 * @param $arr 要排序的数组
 * @return array 排好序的数组
 */
function quickSort($arr)
{
    $count = count($arr);
    if ($count < 2) {
        return $arr;
    }

    $i = 0;
    $j = $count - 1;
    //基准值
    $key = $arr[0];
    while ($i < $j) {
        //首先从后往前比较，比基准值大的放过，比基准值小的做交换
        while ($i < $j && $arr[$j] >= $key) {
            $j--;
        }
        //交换
        $arr[$i] = $arr[$j];
        $arr[$j] = $key;
        //再从前往后比较，比基准值小的放过，比基准值大的做交换
        while ($i < $j && $arr[$i] <= $key) {
            $i++;
        }
        $arr[$j] = $arr[$i];
        $arr[$i] = $key;

    }
    //经过一轮交换，基准值左侧全部比基准值小，基准值右侧全部比基准值大，但左右两侧并不一定是排好序的
    //然后进行递归，将基准值左右两侧进行排序
    if ($i == 0) {
        $l = [];
    } else {
        $l = quickSort(array_slice($arr, 0, $i));
    }

    if ($i == $count - 1) {
        $r = [];
    } else {
        $r = quickSort(array_slice($arr, $i + 1, $count + 1 - $i));
    }
    //将排好序的数组进行合并返回
    return array_merge($l, array($key), $r);
}

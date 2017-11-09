<?php

class ArrayUti
{
    public static function array_merge_add_order(array & $array1, array & $array2, $item_ids, $sort_field = 'order')
    {
        self::array_recursive_add_order($array1, $item_ids, $sort_field);
        $start_order = @max(array_column($array1, $sort_field));
        if ($start_order === false) {$start_order = 0;}
        self::array_recursive_add_order($array2, $item_ids, $sort_field, $start_order);

        return array_merge($array1, $array2);
    }


    // 带排序的递归
    public static function array_recursive_order(array & $r_array, $item_ids, $sort_field = 'order')
    {
        uasort($r_array, function ($a, $b) use($sort_field) {
            if (!isset($a[$sort_field])) $a[$sort_field] = self::MAXSORT;
            if (!isset($b[$sort_field])) $b[$sort_field] = self::MAXSORT - 1;
            return $a[$sort_field] - $b[$sort_field];
        });

        foreach ($r_array as &$item) {
            $all_keys = array_keys($item);
            $item_id = array_intersect($all_keys, $item_ids);
            if (count($item_id) == 1 && is_array($item[current($item_id)])) {
                self::array_recursive_order($item[current($item_id)], $item_ids);
            }
        }
    }


    public static function array_recursive_add_order(array & $r_array, $item_ids, $sort_field = 'order', $start_order = 0)
    {
        if ($start_order == 0) {
            $temp_order = @max(array_column($r_array, $sort_field));
            if ($temp_order === false) {$temp_order = 0;}
        } else
            $temp_order = $start_order;

        foreach ($r_array as &$item) {
            if (!isset($item[$sort_field])) {
                $temp_order += 10;
                $item[$sort_field] = $temp_order;
            }
            $all_keys = array_keys($item);
            $item_id = array_intersect($all_keys, $item_ids);
            if (count($item_id) == 1 && is_array($item[current($item_id)])) {
                self::array_recursive_add_order($item[current($item_id)], $item_ids);
            }
        }
    }

    public static function array_recursive_add_order_t_2(array & $r_array, $item_ids, $start_p = 0, $sort_field = 'order')
    {
        foreach ($r_array as $key => &$item) {
            if ($start_p != 0 ) {  // 若 子集导航中设置 新的 order 则按新设置的 权重。
                $order_v = 10 * ($start_p + 1);
            }
            else {
                $order_v = 10 * (array_search($key, array_keys($r_array)) + 1);
            }

            if (!isset($item[$sort_field])) {
                $item[$sort_field] = $order_v;
            }
            $all_keys = array_keys($item);
            $item_id = array_intersect($all_keys, $item_ids);
            if (count($item_id) == 1 && is_array($item[current($item_id)])) {
                self::array_recursive_add_order_t_2($item[current($item_id)], $item_ids);
            }
        }
    }

    /**
     * 在外层直接合并的情况
     * @param array $array1
     * @param array $array2
     * @param $item_ids
     * @param string $sort_field
     * @return array
     */
    public static function array_merge_add_order_t_c1(array & $array1, array & $array2, $item_ids, $sort_field = 'order')
    {
        $keys1= array_keys($array1);
        $keys2 = array_keys($array2);
        $c_keys = array_intersect($keys1, $keys2);
        if (count($c_keys) == 0) {
            self::array_recursive_add_order_t_2($array1, $item_ids);
            self::array_recursive_add_order_t_2($array2, $item_ids, count($array1));
            return array_merge($array1, $array2);
        } else {
            $merged = $array1;
            foreach ($c_keys as $key) {
                $merged[$key] = self::array_merge_add_order_t_c2($array1[$key], $array2[$key], $item_ids);
            }
            return $merged;
        }
    }

    public static function array_recursive_add_order_t_3(array & $r_array, $item_ids, $start_p = 0, $sort_field = 'order')
    {
        foreach ($r_array as $key => &$item) {
            if ($start_p != 0 ) {  // 若 子集导航中设置 新的 order 则按新设置的 权重。
                $order_v = 10 * ($start_p + 1);
            }
            else {
                $order_v = 10 * (array_search($key, array_keys($r_array)) + 1);
            }

            if (!isset($item[$sort_field])) {
                $item[$sort_field] = $order_v;
            }
            $all_keys = array_keys($item);
            $item_id = array_intersect($all_keys, $item_ids);
            if (count($item_id) == 1 && is_array($item[current($item_id)])) {
                self::array_recursive_add_order_t_3($item[current($item_id)], $item_ids);
            }
        }
    }

    public static function array_merge_recursive_add_order ( array &$array1, array &$array2 )
    {
        $merged = $array1;

        foreach ( $array2 as $key => &$value )
        {
            // 同级中有相同 key 的
            if ( is_array ( $value ) && isset ( $merged [$key] ) && is_array ( $merged [$key] ) )
            {
                if (in_array($key, array('items', 'sub_items'))) {
                    self::array_recursive_add_order_t_3($value, array('items', 'sub_items'), count($merged[$key]));
                }
                $merged [$key] = self::array_merge_recursive_add_order ( $merged [$key], $value );
            }
            else // 同级中无相同 key 的
            {
                $merged [$key] = $value;
            }
        }

        return $merged;
    }

    public static function array_merge_add_order_t(array &$array1, array &$array2)
    {
        $merged = self::array_merge_recursive_add_order($array1, $array2);
        self::array_recursive_add_order_t_3($merged, array('items', 'sub_items'));
        return $merged;
    }

    /**
     * 有相同 key 的情况
     * @param array $array1
     * @param array $array2
     * @param $item_ids
     * @param string $sort_field
     * @return array
     */
    public static function array_merge_add_order_t_c2(array & $array1, array & $array2, $item_ids, $sort_field = 'order')
    {
        $keys1 = array_keys($array1);
        $keys2 = array_keys($array2);
        $item_c = array_intersect($keys1, $keys2);
        $item_id = array_intersect($item_c, $item_ids);
        $b1 = is_array($array1[current($item_id)]);
        $b2 = is_array($array2[current($item_id)]);
        if (count($item_id) == 1 && $b1 && $b2)
        {
            return self::array_merge_add_order_t_c1($array1[current($item_id)], $array2[current($item_id)], $item_ids);
        }
    }
}
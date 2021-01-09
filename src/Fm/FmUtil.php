<?php


namespace Fmmm\LaravelUtil\Fm;

class FmUtil
{
    /**
     * get请求
     * @param string $url
     * @param array $data
     * @param bool $returnJson '是否返回json数据'
     * @param array $param
     * @return bool|mixed|string
     */
    public static function requestGet(string $url, array $data = [], bool $returnJson = true, array $param = [])
    {
        if ($data) {
            $url .= '?' . http_build_query($data);
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        foreach ($param as $item) {
            curl_setopt($curl, $item[0], $item[1]);
        }
        $output = curl_exec($curl);
        curl_close($curl);
        if ($returnJson) {
            return json_decode($output, true);
        }
        return $output;
    }

    /**
     * post请求
     * @param string $url
     * @param array $data
     * @param bool $returnJson '是否返回json数据'
     * @param array $param
     * @return bool|mixed|string
     */
    public static function requestPost(string $url, array $data = [], bool $returnJson = true, array $param = [])
    {
        $curl = curl_init();
        if ($data) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        foreach ($param as $item) {
            curl_setopt($curl, $item[0], $item[1]);
        }
        $output = curl_exec($curl);
        curl_close($curl);
        if ($returnJson) {
            return json_decode($output, true);
        }
        return $output;
    }

    /**
     * 二维数组排序
     * @param array $arr '排序数组'
     * @param string $key '排序依据'
     * @param int $sort SORT_DESC:降序 | SORT_ASC:升序
     */
    public static function arraySort(array &$arr, string $key, int $sort = SORT_DESC)
    {
        $keysValue = array();
        foreach ($arr as $k => $v) {
            $keysValue[$k] = $v[$key];
        }
        array_multisort($keysValue, $sort, $arr);
    }
}

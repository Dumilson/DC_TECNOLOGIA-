<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Helper
{

    public static function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public static function objectJson($data, $assoc = false)
    {
        return json_decode(json_encode($data), $assoc);
    }

    public static function getExtensionFile($file)
    {
        if (is_file($file)) {
            $extension = $file->getClientOriginalExtension();
            return  $extension;
        }
    }
    public static function returnApi($messages, $status, $data = null, $header = null)
    {
        $response = ['status' => '0', 'message' => 'Validation error'];
        $response['status'] = $status;
        $response['message'] = $messages;
        if ($data != null) {
            $response['data'] = $data;
        }
        return response($response, $status)->withHeaders([
            $header
        ]);
    }

    public static function upload($image, string $local)
    {
        if (is_file($image)) {
            $extension = $image->getClientOriginalExtension();
            $picture = time() . '.' . $extension;
            $destinationPath = public_path() . $local;
            $res = $image->move($destinationPath, $picture);
            if ($res) {
                return [
                    'status' => true,
                    'message' => $picture
                ];
            }
            return [
                'status' => false,
                'message' => "Error Upload"
            ];
        }
    }

    public static function formata_telefone($numero)
    {
        if (empty($numero)) {
            return $numero;
        }
        $ret = '';
        switch (strlen($numero)) {
            case '10':
                $ret = "(" . substr($numero, 0, 2) . ") " . substr($numero, 2, 4) . "-" . substr($numero, 6, 4);
            case '11':
                $ret = "(" . substr($numero, 0, 2) . ") " . substr($numero, 2, 1) . "-" . substr($numero, 3, 4) . "-" . substr($numero, 7, 4);
                break;
            case '12':
                $ret = substr($numero, 0, 2) . " (" . substr($numero, 2, 2) . ") " . substr($numero, 4, 4) . "-" . substr($numero, 8, 4);
                break;
            case '13':
                $ret = substr($numero, 0, 2) . " (" . substr($numero, 2, 2) . ") " . substr($numero, 4, 1) . "-" . substr($numero, 5, 4) . "-" . substr($numero, 9, 4);
                break;
            default:
                $ret = $numero;
                break;
        }
        return $ret;
    }

    public static function hashPassWordCode()
    {
        $maiu = [
            '€',
            '$',
            '?',
            '#',
            ')',
            '-',
            'M',
            'a',
            'A',
            'Z',
            'L',
            '/',
            '=',
            '~',
            '%'
        ];
        $rar = rand(0, 7);
        $rarr = rand(0, 7);
        $rar1 = rand(0, 7);
        $rar3 = rand(0, 7);
        $rar5 = rand(0, 7);

        $senha = rand(1, 51) . "" . $maiu[$rar5] . "" . $maiu[$rar3] . "" . $maiu[$rar1] . "" . rand(1, 51) . "" . $maiu[$rar] . rand(1, 69) . "" . $maiu[$rarr] . "" . rand(1, 51);

        return $senha;
    }

    public static function verifyExist($table,$colum,$value,$colum_id = null,$value_colum_id = null){
        $data = DB::table($table)->where($colum,$value)
        ->where($colum_id,"!=",$value_colum_id)
        ->first();
        if(!empty($data)){
            return true;
        }
        return false;
    }

    public static function addYear($year)
    {
        $date_atual = new \DateTime(date('Y-m-d'));
        $day_start = $year;
        $data_expire = $date_atual->modify('+' . $day_start . ' year');
        return $data_expire;
    }
}

<?php

namespace App\Helper;


use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Route;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route as RouteAlias;

class Utility
{
    public static function uploadFile($file, $prefix = 'uploads'): string
    {

        $day = Carbon::now()->day;
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $folder = $prefix . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month . DIRECTORY_SEPARATOR . $day;
        $image1 = uniqid() . "." . $file->getClientOriginalExtension();
        $path1 = $folder . DIRECTORY_SEPARATOR . $image1;
        if (file_exists($folder) == false) {
            $fs = new Filesystem();
            $fs->makeDirectory($folder, 0755, true);
        }
        $file->move($folder, $image1);

        return DIRECTORY_SEPARATOR . $path1;

    }

    public static function pathUploads($prefix = 'uploads'): string
    {

        $day = Carbon::now()->day;
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $folder = $prefix . "/" . $year . "/" . $month . "/" . $day;
        $path1 = $folder;
        if (file_exists($folder) == false) {
            $fs = new Filesystem();
            $fs->makeDirectory($folder, 0755, true);
        }
        return $path1;
    }
    public static function removeImage($path): void
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }

    }
    public static function pathImage(string $path =""): string
    {
        return asset('/storage/'.$path);
    }
    public static function convertToSWithTime($date): string
    {
        if (!$date) {
            return '';
        }
        try {
            $jalali = new JalaliConverter();
            $arr = explode('-', $date);
            $date_array = explode(' ', $arr[2]);
            $arr[2] = $date_array[0];
            $result = $jalali->gregorian_to_jalali($arr[0], $arr[1], $arr[2], '/');
            return $result . " " . $date_array[1];

        } catch (Exception $exception) {
            //var_dump( $exception->getMessage() );

            return '';
        }

    }
    public static function convertToSWithOutTime($date): string
    {
        if (!$date) {
            return '';
        }
        try {
            $jalali = new JalaliConverter();
            $arr = explode('-', $date);
            $date_array = explode(' ', $arr[2]);
            $arr[2] = $date_array[0];
            $result = $jalali->gregorian_to_jalali($arr[0], $arr[1], $arr[2], '/');
            return $result;

        } catch (Exception $exception) {
            //var_dump( $exception->getMessage() );

            return '';
        }

    }
    public static function convertNumbers($str, $mod = 'en')
    {
        $num_a = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
        $key_a = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        return ($mod == 'fa') ? str_replace($num_a, $key_a, $str) : str_replace($key_a, $num_a, $str);
    }
public static function uploadFiles($path)
{
        return'app/'.$path;
}
    public static function convertToAd($date): string
    {
        if (!$date) {
            return '';
        }
        try {
            $jalali = new JalaliConverter();
            $date_array = explode('/', $date);
            $result = $jalali->jalali_to_gregorian($date_array[0], $date_array[1], $date_array[2], '-');
            return $result;

        } catch (Exception $exception) {
            return '';
        }

    }
    public static function convertToS($date): string
    {
        if (!$date) {
            return '';
        }
        try {
            $jalali = new JalaliConverter();
            $date_array = explode('-', $date);
            $result = $jalali->gregorian_to_jalali($date_array[0], $date_array[1], trim($date_array[2]), '/');

            return $result;

        } catch (Exception $exception) {
            //var_dump( $exception->getMessage() );

            return '';
        }

    }
//    public static function tempImageName($prefix = 'tempImage'): string
//    {
//        $folder = $prefix;
//        if (file_exists($folder) == false) {
//            $fs = new Filesystem();
//            $fs->makeDirectory($folder, 0755, true);
//        }
//        return $folder;
//    }
    public static function getTempImageName(string $path)
    {
        $name = explode("livewire-tmp/" , $path);
        return $name[1];
    }
    public static function limitWords($string, $word_limit): string
    {
        if (!empty($string)) {
            $words = explode(" ", $string);
            return implode(" ", array_splice($words, 0, $word_limit)) . "...";
        }
        return '';
    }


}

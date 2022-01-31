<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Level;
use App\Models\Borehole;

class Borehols
{

    public static function get_lists(Request $request)
    {
        $response = [];
        foreach ($request->filter as $v) {
            $method_name = 'get_all_' . $v;
            if (method_exists(__CLASS__, $method_name)) {
                $response[$v] = self::$method_name();
            }
        }
        return $response;
    }

    public static function filter(Request $request)
    {
        if (empty($request->borehole)) return [];
        $query = Borehole::limit(50);
        // if (!empty($request->saved)) $query->where('saved', $request->saved);
        $query->whereIn('id', $request->borehole);
        return $query->get();
    }

    public static function remove(Request $request)
    {

    }

    public static function get_all_deposit()
    {
        return Deposit::get();
    }

    public static function get_all_level()
    {
        return Level::get();
    }

    public static function get_all_borehole_type()
    {
        return DB::table('boreholes')
        ->select('type')
        ->groupBy('type')
        ->get();
    }

    public static function get_all_borehole_condition()
    {
        return DB::table('boreholes')
        ->select('condition')
        ->groupBy('condition')
        ->get();
    }

    public static function get_all_borehole_names()
    {
        return DB::table('boreholes')
        ->select('id', 'title')
        ->get();
    }
}

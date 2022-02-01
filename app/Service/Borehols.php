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
        Borehole::whereIn('id', collect($request->list)->pluck('id'))->update([
            'saved' => false
        ]);
    }

    public static function save (Request $request)
    {
        foreach ($request->list as $key => $value) {
            $item = collect($value)->only(['type','condition','q_liquids','water_cut','oil_density'])->all();
            $item['saved'] = true;
            $item['level_id'] = $value['level']['id'];
            Borehole::where('id', $value['id'])->update($item);
        }
    }

    public static function chars ()
    {

        // К сожалению нет времени делать хорошие и красивые решения
        $Borehols = Borehole::get();
        $all_deposits = Deposit::get()->keyBy('id');
        $all_levels = Level::get()->keyBy('id');
        $all_oil_flow_rate = 0;
        foreach ($Borehols as $key => $value) {
            $d_item = &$all_deposits[$value['deposit_id']];
            $l_item = &$all_levels[$value['level_id']];

            $d_item['q_liquids'] = round((double) $d_item['q_liquids'] + $value['q_liquids'], 2);
            $d_item['water_cut'] = round((double) $d_item['water_cut'] + $value['water_cut'], 2);
            $d_item['oil_density'] = round((double) $d_item['oil_density'] + $value['oil_density'], 2);
            $oil_flow_rate = round((double) $value['q_liquids'] * (1 - (double) $value['water_cut'] / 100) * (double) $value['oil_density'] * $l_item['coefficient'], 2);
            $d_item['oil_flow_rate'] = round((double) $d_item['oil_flow_rate'] + $oil_flow_rate, 2);
            $all_oil_flow_rate = round((double) $all_oil_flow_rate + $oil_flow_rate, 2);
        }

        $labels = self::get_all_deposit()->pluck('title');

        $bar = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Дебит',
                    'backgroundColor' => 'red',
                    'data' => [],
                ],
                [
                    'label' => 'Q жидкости',
                    'backgroundColor' => '#35c9bd',
                    'data' => [],
                ],
                [
                    'label' => 'Плотность нефти',
                    'backgroundColor' => '#333',
                    'data' => [],
                ],
                [
                    'label' => 'Обводненность',
                    'backgroundColor' => '#55c9f4',
                    'data' => [],
                ],
            ]
        ];

        $pie = [
            'labels' => $labels,
            'datasets' => [
                [
                    'backgroundColor' => ["#41B883", "#E46651", "#00D8FF"],
                    'data' => [],
                ],
            ]
        ];
        $percent = $all_oil_flow_rate / 100;
        foreach ($all_deposits as $key => $value) {
            $bar['datasets'][0]['data'][] = $value['oil_flow_rate'];
            $bar['datasets'][1]['data'][] = $value['q_liquids'];
            $bar['datasets'][2]['data'][] = $value['oil_density'];
            $bar['datasets'][3]['data'][] = $value['water_cut'];

            $pie['datasets'][0]['data'][] = round($value['oil_flow_rate'] / $percent, 2);
        }
        
        return [
            'bar' => $bar,
            'pie' => $pie,
        ];
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

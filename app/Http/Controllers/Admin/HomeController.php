<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'        => 'Banks',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_string',
            'model'              => 'App\Models\Bank',
            'group_by_field'     => 'name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_period'      => 'year',
            'column_class'       => 'col-md-4',
            'entries_number'     => '5',
            'translation_key'    => 'bank',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'        => 'Accounts',
            'chart_type'         => 'line',
            'report_type'        => 'group_by_string',
            'model'              => 'App\Models\Account',
            'group_by_field'     => 'name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-4',
            'entries_number'     => '5',
            'translation_key'    => 'account',
        ];

        $chart2 = new LaravelChart($settings2);

        return view('home', compact('chart1', 'chart2'));
    }
}

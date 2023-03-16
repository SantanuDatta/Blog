<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class MonthlyView extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->options([
            'responsive' => true,
            'legend' => [
                'position' => 'bottom',
            ],
            'scales' => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true,
                        ],
                        'gridLines' => [
                            'display' => true,
                            'color' => 'rgba(0, 0, 0, 0.1)',
                        ],
                    ],
                ],
                'xAxes' => [
                    [
                        'gridLines' => [
                            'display' => true,
                        ],
                    ],
                ],
            ],
        ]);
    }
}

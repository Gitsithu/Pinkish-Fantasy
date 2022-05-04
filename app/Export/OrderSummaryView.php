<?php

namespace App\Export;

use App\Sample;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;

class OrderSummaryView implements FromView
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $paramObj = $this->data;
        
        return view('backend_v2.report.excel_html', [
            
            'orders' => $paramObj['orders'],
            'from_date' => $paramObj['from_date'],
            'to_date' => $paramObj['to_date'],
            'type' => $paramObj['type'],
            'users' => $paramObj['users'],
        ]);
    }
}

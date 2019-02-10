<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithHeadings;//奇怪，無效
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

class Tb6viewExport implements FromView, WithStrictNullComparison, ShouldAutoSize, WithTitle, WithEvents
{
    public function view(): View
    {
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
        Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
            $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
        });
        $per_name = session('per_name');
        $dn_no = session('dn_no');
        $dn_name = session('dn_name');
        $p_dn_id = session('p_dn_id');
        $pid = session('pid');
        $year = session('year');
        $person = \App\FinPersonStaff::whoiseditor($p_dn_id, $year)->first();

        $data = \App\FinLimitTable::operLimit($p_dn_id, 'tb6')->first();
        //dd($data->status_pid);
        $label = \App\FinBudgetItem::first()->toArray();
        $label1 = array_keys($label);
        $label2 = array_values($label);
        $dept = \App\FinDept2018::where(['p_dn_id'=> $p_dn_id ])->firstOrFail();
        $item1 = $dept->applybgt->toArray();
        $list1 = array_values($item1);
        $item2 = $dept->prebgt->toArray();
        $list2 = array_values($item2);
        $item3 = $dept->lastbgt->toArray();
        $list3 = array_values($item3);
        //dd($list3);

        $sysvar = \App\SysVar::firstOrFail();
        return view('Budget2018.prebudget.tb6_view', compact('year', 'person', 'dn_no', 'dn_name', 'per_name', 'p_dn_id', 'label1', 'label2', 'list1', 'list2', 'list3', 'sysvar'));
    }
    // public function headings(): array
    // {
    //     return [
    //         '預算編號',
    //         '預算項目',
    //         '2019 年 預算金額',
    //         '(2017/09-2018/08)實支金額',
    //         '2018 年 預算金額',
    //         '預算需求詳細說明'
    //     ];
    // }
    public function title(): string
    {
        $dn_no = session('dn_no');
        $dn_name = session('dn_name');
        // $pid = session('pid');
        $year = session('year');
        return $dn_name.$year.'預算編列';
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:C1'; // headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $cellRange = 'D1:E1'; // 
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10);
                $cellRange = 'A2:E2'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10);
                // $event->sheet->getDelegate()->getStyle($cellRange)->getBorder()->setBorder('thin');
                // $event->sheet->setAllBorders('thin');
                // $event->sheet->setBorder($cellRange, 'thin');
                $event->sheet->styleCells(
                    'A1:E1',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'A2:E42',
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                // 'color' => ['argb' => 'FFFF0000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'C4:D4',
                    [
                        'borders' => [
                            'diagonal' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                // 'color' => ['argb' => 'FFFF0000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'B4:D42',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                        ],
                        'numberFormat' => [
                            // 'formatCode' => '[Black][>0]$#,##0;[Red][<0]$#,##0;#,##0',//\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                            'formatCode' => '[Black][>0]#,##0;[Red][<0]#,##0;#,##0',//\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'A2:E2',
                    [
                        'alignment' => [
                            'wrapText' => true,
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                            'veritcal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ]
                    ]
                );
                $event->sheet->setOrientation('ORIENTATION_LANDSCAPE');
            },
        ];
    }
}
?>
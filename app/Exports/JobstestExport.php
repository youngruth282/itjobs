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

class JobstestExport implements FromView, WithStrictNullComparison, ShouldAutoSize, WithTitle, WithEvents
{
    public function view(): View
    {
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
        Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
            $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
        });
        $status='N';
        $orderSeq='desc';
        $pid = 275;
        $jobs = \App\Job::ViewInfo($status)->where('req_pid', $pid)->orderBy('app_no', $orderSeq)->get();
        return view('jobs.jv02', [
            'jobs' => \App\Job::ViewInfo($status)->where('req_pid', $pid)->orderBy('app_no', $orderSeq)->get()
        ]);
    }

    public function title(): string
    {
        // return $dn_name.$year.'預算編列';
        return "工作進度";
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
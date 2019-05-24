<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\MmAmount;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
// use App\Providers\MacroServiceProvider;
class MmBorderExport implements FromCollection, WithStrictNullComparison, WithHeadings, WithEvents
{
/*    public function __construct(Mission7EloquentRepository $Mmamount)
    {
        $this->mmamount = $Mmamount;
    }

    public function collection()
    {
        return $this->mmamount->all();
    }*/
    public function collection()
    {
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
        Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
            $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
        });
        return MmAmount::selectRaw('area_name, cell_name, sogi, value1, value2, value3, value4, created_at')
        ->orderBy('area_name')
        ->orderBy('cell_name')
        ->orderBy('sogi')
        ->get();
    }
    public function headings(): array
    {
        return [
            '牧區2',
            '小組',
            '電話',
            '7/7人數',
            '7/14人數',
            '7/21人數',
            '7/28人數',
            '輸入時間'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                // $event->sheet->setAllBorders('thin');
                // $event->sheet->setBorder($cellRange, 'thin');
                $event->sheet->styleCells(
                    'B2:G8',
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => 'FFFF0000'],
                            ],
                        ]
                    ]
                );
                // $event->sheet->setOrientation('ORIENTATION_LANDSCAPE');
            },
        ];
    }
}
<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\MmAmount;

class MmamountExport_basic implements FromCollection, WithStrictNullComparison, WithHeadings
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
        return MmAmount::selectRaw('area_name, cell_name, sogi, value1, value2, value3, value4, created_at')
        ->orderBy('area_name')
        ->orderBy('cell_name')
        ->orderBy('sogi')
        ->get();
    }
    public function headings(): array
    {
        return [
            '牧區',
            '小組',
            '電話',
            '7/7人數',
            '7/14人數',
            '7/21人數',
            '7/28人數',
            '輸入時間'
        ];
    }
}
<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Repositories\Mission7\Mission7RepositoryInterface;

class MmamountsExport implements FromCollection, WithStrictNullComparison, WithHeadings
{
    protected $orderby;

    public function __construct(Mission7RepositoryInterface $amounts, string $orderby)
    {
        $this->amounts = $amounts;
        $this->orderby = $orderby;
    }

    public function collection()
    {
        //dd($this->status);
        return $this->amounts->getData($this->orderby);
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
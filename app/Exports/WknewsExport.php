<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Weeknew;

class WknewsExport implements FromCollection,WithHeadings
{
    protected $deptid;
    protected $pid;
    protected $status;

    public function __construct(int $deptid, int $pid, string $status, string $pdate)
    {
        $this->deptid = $deptid;
        $this->pid = $pid;
        $this->status = $status;
        $this->published_at = $pdate;
    }

    public function collection()
    {
        return Weeknew::ExcelInfo($this->deptid, $this->pid, $this->status, $this->published_at);
    }
    public function headings(): array
    {
        return [
            '刊登單位',
            '刊登日',
            '內容',
            '最後修改時間',
        ];
    }
}
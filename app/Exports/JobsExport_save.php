<?php
//參考http://yeyunrong.com/2018/04/04/laravel%E5%AF%BC%E5%87%BAXlsx/
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Job;

class JobsExport implements FromCollection,WithHeadings
{
    protected $deptid;
    protected $pid;
    protected $status;

    public function __construct(int $deptid, int $pid, string $status)
    {
        $this->deptid = $deptid;
        $this->pid = $pid;
        $this->status = $status;
    }

    public function collection()
    {
        return Job::ExcelInfo($this->deptid, $this->pid, $this->status);
    }
    public function headings(): array
    {
        return [
            '編號',
            '',
            '部門',
            '項目',
            '內容',
            '負責同工',
            '執行進度',
            '預計完成日期',
            '備註'
        ];
    }
}
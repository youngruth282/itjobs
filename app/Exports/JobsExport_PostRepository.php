<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Repositories\Post\PostRepositoryInterface;

class JobsExport implements FromCollection,WithHeadings
{
    protected $searchKey;
    protected $status;

    public function __construct(PostRepositoryInterface $posts, string $searchKey, array $status=NULL)
    {
        $this->posts = $posts;
        $this->searchKey = $searchKey;
        $this->status = $status;
    }

    public function collection()
    {
        //dd($this->status);
        return $this->posts->getSearchData($this->searchKey, $this->status);
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
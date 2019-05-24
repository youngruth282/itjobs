<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class JovsviewExport implements FromView
{
    public function view(): View
    {
        return view('jobs.jv02');
    }
}
?>
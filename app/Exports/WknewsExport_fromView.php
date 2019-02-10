<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Weeknew;
use Carbon\Carbon;

class WknewsExport_fromView implements FromView
{
    public function view(): View
    {
        return view('weeknews.post_partial', [
            'wknews' => Weeknew::ViewInfo('')->where('wknews.published_at', new Carbon('this sunday'))->orderBy('wknews.hr_sn')->get()
        ]);
    }
}
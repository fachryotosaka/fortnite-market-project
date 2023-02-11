<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Exports\DownloadExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DownloadController extends Controller
{
    public function download()
    {
        $users = Shop::get();

        $data = [
            'title' => 'Welcome to lexa.com',
            'date' => date('m/d/Y'),
            'users' => $users
        ];
        $pdf = app('dompdf.wrapper');

        $pdf->loadView('myPDF', $data);

        return $pdf->stream();
    }
}

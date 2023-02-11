<?php

namespace App\Exports;

use Dompdf\Dompdf;
use App\Models\Shop;
use App\Models\User;
use Dompdf\Exception;
use Dompdf\Adapter\CPDF;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Barryvdh\DomPDF\Facade as PDF;

class DownloadExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;

    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'Product.pdf';

    /**
    * Optional Writer Type
    */
    private $writerType = Excel::DOMPDF;

    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function collection()
    {
        $shop = User::all();
        return $shop ;
    }
     public function headings(): array
    {
        return [
            'id',
            'name',
            'category_id',
            'price',
            'descs',
            'created_at',
            'updated_at',
        ];
    }
}

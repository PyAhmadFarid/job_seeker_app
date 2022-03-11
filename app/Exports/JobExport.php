<?php

namespace App\Exports;

use App\Models\job;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct( $data)
    {
        $this->applicant = $data;

    }
    public function collection()
    {
        // return applicant::all();
        return $this->applicant;
    }
    public function headings(): array
    {
        return ["id", "created at", "update at","title","desc","salary","end_date","status","create_by"];
    }
}

<?php

namespace App\Exports;

use App\Models\applicant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicantExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $applicant;

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
        return ["id", "created at", "update at","full name","email","phone number","document","job id"];
    }
}

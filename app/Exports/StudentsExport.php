<?php

namespace App\Exports;

use App\Models\Subject;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, Responsable, WithMapping, WithHeadings
{
    use Exportable;

    private $id;
    private $fileName = "StudentsPoin.xlsx";

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Subject::with('students')->whereHas('students', function ($q) {
            $q->where('subject_id', $this->id);
        })->get();
    }

    public function map($subject): array
    {
        $data = [];
        foreach ($subject->students as $student) {
            $data[] = [
                $student->id,
                $student->name,
                $student->pivot->point
            ];
        }
        return $data;
    } 
    
    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Point'
        ];
    }
}

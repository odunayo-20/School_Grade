<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Timetable;
use App\Models\SchoolClass;
use App\Models\StudentClass;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class TimetableExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithCustomStartCell, WithEvents
{
    protected $class_id;
    protected $day;
    protected $export_type;

    public function __construct($class_id = null, $day = null, $export_type = 'list')
    {
        $this->class_id = $class_id;
        $this->day = $day;
        $this->export_type = $export_type;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Timetable::with(['class', 'subject', 'staff'])
            ->when($this->class_id, fn($q) => $q->where('class_id', $this->class_id))
            ->when($this->day, fn($q) => $q->where('day', $this->day));

        if ($this->export_type === 'weekly') {
            return $query->orderBy('day')->orderBy('start_time')->get();
        }

        return $query->orderBy('day')->orderBy('start_time')->get();
    }

    public function headings(): array
    {
        if ($this->export_type === 'weekly') {
            return [
                'Time Slot',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday'
            ];
        }

        return [
            'S/N',
            'Class',
            'Subject',
            'Staff',
            'Day',
            'Start Time',
            'End Time',
            'Duration (mins)',
            'Status'
        ];
    }

    public function map($timetable): array
    {
        static $counter = 0;
        $counter++;

        if ($this->export_type === 'weekly') {
            // This will be handled differently in the weekly export
            return [];
        }

        $startTime = Carbon::parse($timetable->start_time);
        $endTime = Carbon::parse($timetable->end_time);
        $duration = $startTime->diffInMinutes($endTime);

        return [
            $counter,
            $timetable->class->name ?? 'N/A',
            $timetable->subject->name ?? 'N/A',
            $timetable->staff->firstname .' '. $timetable->staff->firstname ?? 'Not Assigned',
            $timetable->day,
            $startTime->format('h:i A'),
            $endTime->format('h:i A'),
            $duration,
            'Active'
        ];
    }

    public function startCell(): string
    {
        return 'A6'; // Start after the header information
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        // Header styles
        $sheet->getStyle('A1:I5')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Table headers
        $sheet->getStyle("A6:{$lastColumn}6")->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => '366092'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Table data
        $sheet->getStyle("A7:{$lastColumn}{$lastRow}")->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // Alternating row colors
        for ($row = 7; $row <= $lastRow; $row++) {
            if ($row % 2 == 0) {
                $sheet->getStyle("A{$row}:{$lastColumn}{$row}")->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'F2F2F2'],
                    ],
                ]);
            }
        }

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Add header information
                $this->addHeaderInfo($sheet);

                // Auto-size columns
                $this->autoSizeColumns($sheet);

                // Add borders to table
                $this->addTableBorders($sheet);

                // Set print settings
                $this->setPrintSettings($sheet);
            },
        ];
    }

    private function addHeaderInfo(Worksheet $sheet)
    {
        $className = $this->class_id ? (StudentClass::find($this->class_id)->name ?? 'All Classes') : 'All Classes';
        $dayFilter = $this->day ? $this->day : 'All Days';

        $sheet->setCellValue('A1', 'SCHOOL TIMETABLE REPORT');
        $sheet->setCellValue('A2', 'Class: ' . $className);
        $sheet->setCellValue('A3', 'Day: ' . $dayFilter);
        $sheet->setCellValue('A4', 'Generated: ' . Carbon::now()->format('d/m/Y H:i:s'));
        $sheet->setCellValue('A5', 'Generated By: ' . (auth()->user()->first_name ?? 'System'));

        // Merge cells for title
        $sheet->mergeCells('A1:I1');
        $sheet->mergeCells('A2:I2');
        $sheet->mergeCells('A3:I3');
        $sheet->mergeCells('A4:I4');
        $sheet->mergeCells('A5:I5');

        // Style the header
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
                'color' => ['argb' => '366092'],
            ],
        ]);
    }

    private function autoSizeColumns(Worksheet $sheet)
    {
        $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
        foreach ($columns as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }

    private function addTableBorders(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        $sheet->getStyle("A6:{$lastColumn}{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
                'outline' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
    }

    private function setPrintSettings(Worksheet $sheet)
    {
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);

        // Set margins
        $sheet->getPageMargins()->setTop(0.75);
        $sheet->getPageMargins()->setRight(0.7);
        $sheet->getPageMargins()->setLeft(0.7);
        $sheet->getPageMargins()->setBottom(0.75);
    }
}

// Additional Weekly Timetable Export Class
class WeeklyTimetableExport implements FromCollection, WithHeadings, WithStyles, WithCustomStartCell, WithEvents
{
    protected $class_id;
    protected $timeSlots;
    protected $days;

    public function __construct($class_id = null)
    {
        $this->class_id = $class_id;
        $this->timeSlots = [
            '08:00', '09:00', '10:00', '11:00', '12:00',
            '13:00', '14:00', '15:00', '16:00', '17:00'
        ];
        $this->days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    }

    public function collection()
    {
        $timetables = Timetable::with(['class', 'subject', 'staff'])
            ->when($this->class_id, fn($q) => $q->where('class_id', $this->class_id))
            ->get()
            ->groupBy('day');

        $weeklyData = [];

        foreach ($this->timeSlots as $timeSlot) {
            $row = [$timeSlot];

            foreach ($this->days as $day) {
                $dayTimetables = $timetables->get($day, collect());
                $entry = $dayTimetables->first(function ($timetable) use ($timeSlot) {
                    $start = Carbon::parse($timetable->start_time)->format('H:i');
                    $end = Carbon::parse($timetable->end_time)->format('H:i');
                    return $start <= $timeSlot && $timeSlot < $end;
                });

                if ($entry) {
                    $row[] = $entry->subject->name . "\n(" . $entry->class->name . ")";
                } else {
                    $row[] = '';
                }
            }

            $weeklyData[] = $row;
        }

        return collect($weeklyData);
    }

    public function headings(): array
    {
        return [
            'Time',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];
    }

    public function startCell(): string
    {
        return 'A6';
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        // Header styles
        $sheet->getStyle('A6:H6')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => '366092'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Time column styling
        $sheet->getStyle("A7:A{$lastRow}")->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'E6E6E6'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Data cells
        $sheet->getStyle("B7:H{$lastRow}")->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Add header
                $className = $this->class_id ? (StudentClass::find($this->class_id)->name ?? 'All Classes') : 'All Classes';
                $sheet->setCellValue('A1', 'WEEKLY TIMETABLE');
                $sheet->setCellValue('A2', 'Class: ' . $className);
                $sheet->setCellValue('A3', 'Generated: ' . Carbon::now()->format('d/m/Y H:i:s'));
                $sheet->setCellValue('A4', 'Academic Year: ' . date('Y') . '/' . (date('Y') + 1));

                $sheet->mergeCells('A1:H1');
                $sheet->mergeCells('A2:H2');
                $sheet->mergeCells('A3:H3');
                $sheet->mergeCells('A4:H4');

                // Style header
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Set row heights
                for ($row = 7; $row <= $sheet->getHighestRow(); $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(40);
                }

                // Set column widths
                $sheet->getColumnDimension('A')->setWidth(10);
                for ($col = 'B'; $col <= 'H'; $col++) {
                    $sheet->getColumnDimension($col)->setWidth(15);
                }
            },
        ];
    }
}

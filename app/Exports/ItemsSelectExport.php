<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;

class ItemsSelectExport implements FromQuery, WithHeadings, WithStyles, WithEvents, WithMapping
{
    protected $itemIds;
    public function __construct(array $itemIds)
    {
        $this->itemIds = $itemIds;
    }
    public function query()
    {
        return Item::query()->whereIn('id', $this->itemIds);
    }

    public function map($item): array
    {
        return [
            $item->id,
            optional($item->itemData)->id,
            optional($item->itemData->category)->name_category,
            optional($item->itemData)->name_item,
            $item->unique_code,
            optional($item->itemData)->model,
            $item->status,
            $item->check_date,
            optional($item->custody)->profile ? optional($item->custody->profile)->getValidIdentification() : null,
            optional($item->custody)->full_name,
            optional($item->itemData)->manufacturer->name,
            optional($item->itemData)->unity_cost,
            optional($item->itemData)->version,
            optional($item->itemData)->dimension,
            optional($item->itemData)->weight,
            optional($item->itemData)->color,
            optional($item->itemData)->description,
            optional($item)->inventory_id,
            optional($item->inventory->responsible)->full_name,
            optional($item->inventory)->repository,
            $item->comment,

        ];
    }
    public function headings(): array
    {
        return [
            'ID',
            'Item Data Code',
            'Category',
            'Name Item',
            'Unique Code',
            'Model',
            'Status',
            'Check Date',
            'DNI / Passport',
            'Custody Full Name',
            'Manufacturer',
            'Unity Cost',
            'Version',
            'Dimension',
            'Weight',
            'Color',
            'Description',
            'Inventory ID',
            'Inventory Responsible',
            'Repository ID',
            'Comment',

        ];
    }
    public function registerEvents(): array
    {


        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:AZ1';
                $sheet = $event->sheet->getDelegate();
                $styleArray = [
                    'font' => [
                        'bold' => true,
                        'color' => [
                            'argb' => Color::COLOR_WHITE,
                        ],
                    ],

                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],

                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'E6B436',
                        ],
                    ],
                ];

                foreach (range('A', 'Z') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
                $sheet->getStyle($cellRange)->applyFromArray($styleArray);

            },
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1   => ['font' => ['bold' => true, 'size' => 11]],
            'A' => ['font' => ['bold' => true]],

        ];
    }

}

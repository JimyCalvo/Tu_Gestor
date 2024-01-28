<?php

namespace App\Exports;

use App\Models\Item;

use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;




class ItemsExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{


    public function collection()
    {
        $transformedItems =Item::with('itemData','custody')->get()->map(function ($item) {

            return [
                'id' => $item->id,
                'item_data_id'=> $item->item_data_id,
                'name_category'=> $item->itemData->category->name_category,
                'name_item'=> $item->itemData->name_item,
                'unique_code'=> $item->unique_code,
                'model'=> $item->itemData->model,
                'status'=> $item->status,
                'check_date'=> $item->check_date,
                'custody_dni'=> $item->custody->profile ? $item->custody->profile->getValidIdentification() : null,
                'full_name'=> $item->custody->full_name,
                'name'=> $item->itemData->manufacturer->name,
                'unity_cost'=> $item->itemData->unity_cost,
                'version'=> $item->itemData->version,
                'dimension'=> $item->itemData->dimension,
                'weight'=> $item->itemData->weight,
                'color'=> $item->itemData->color,
                'description' => $item->itemData->description,
                'inventory_id'=> $item->inventory_id,
                'responsible_id'=> $item->inventory->responsible->full_name,
                'repository_id'=> $item->inventory->repository,
                'comment'=> $item->comment,

            ];
        });
        return new Collection($transformedItems);
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

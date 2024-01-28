<?php

namespace App\Exports;

use App\Models\Item;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
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

class ItemsSearchExport implements FromQuery, WithHeadings, WithStyles, WithEvents,WithMapping
{
    protected $queryParams;

    public function __construct(array $queryParams)
    {
        $this->queryParams = $queryParams;
    }

    public function query()
    {
        $query = Item::with([
            'custody.profile',
            'other',
            'inventory.repository.guardian.profile',
            'inventory.repository.area',
            'inventory.responsible.profile',
            'itemData.manufacturer',
            'itemData.category',
        ]);


        if (isset($this->queryParams['category_name'])) {
            $query->whereHas('itemData.category', function ($q) {
                $q->where('category_name', $this->queryParams['category_name']);
            });
        }


        if (isset($this->queryParams['category'])) {
            $query->whereHas('itemData', function ($q) {
                $q->where('category_id', $this->queryParams['category_id']);
            });
        }
        if (isset($this->queryParams['manufacturer'])) {
            $query->whereHas('itemData.manufacturer', function ($q) {
                $q->where('id', $this->queryParams['manufacturer']);
            });
        }
        if (isset($this->queryParams['name_item'])) {
            $query->whereHas('itemData', function ($q) {
                $q->where('name_item', $this->queryParams['name_item']);
            });
        }

        if (isset($this->queryParams['suppliers_id'])) {
            $query->whereHas('suppliers', function ($q) {
                $q->where('id', $this->queryParams['suppliers_id']);
            });
        }

        if (isset($this->queryParams['supplier_name'])) {
            $query->whereHas('itemData.suppliers', function ($q) {
                $q->where('name_supplier', 'like', '%' . $this->queryParams['supplier_name'] . '%');
            });
        }


        if (isset($this->queryParams['unique_code'])) {
            $query->where('unique_code', 'like', '%' . $this->queryParams['unique_code'] . '%');
        }

        if (isset($this->queryParams['inventory_id'])) {
            $query->whereHas('inventory', function ($q) {
                $q->where('id', $this->queryParams['inventory_id']);
            });
        }
        if (isset($this->queryParams['inv_responsible'])) {
            $query->whereHas('inventory.responsible', function ($q) {
                $q->where('full_name', $this->queryParams['inv_responsible']);
            });
        }
        if (isset($this->queryParams['inv_dni_resp'])) {
            $query->whereHas('inventory.responsible.profile', function ($q) {
                $q->where('dni', $this->queryParams['inv_dni_resp']);
            });
        }

        if (isset($this->queryParams['custody_id'])) {
            $query->whereHas('custody', function ($q) {
                $q->where('id', $this->queryParams['custody_id']);
            });
        }

        if (isset($this->queryParams['custody_dni'])) {
            $query->whereHas('custody.profile', function ($q) {
                $q->where('dni', $this->queryParams['custody_dni']);
            })->with('itemData.suppliers');
        }

        if (isset($this->queryParams['full_name'])) {
            $query->whereHas('custody', function ($q) {
                $q->where('full_name', $this->queryParams['full_name']);
            });
        }
        if (isset($this->queryParams['repository_id'])) {
            $query->whereHas('inventory.repository', function ($q) {
                $q->where('id', $this->queryParams['repository_id']);
            });
        }

        if (isset($this->queryParams['repository_name'])) {
            $query->whereHas('inventory.repository', function ($q) {
                $q->where('repository_name', $this->queryParams['repository_name']);
            });
        }
        if (isset($this->queryParams['area_id'])) {
            $query->whereHas('inventory.repository.area', function ($q) {
                $q->where('id', $this->queryParams['area_id']);
            });
        }
        if (isset($this->queryParams['area_name'])) {
            $query->whereHas('inventory.repository.area', function ($q) {
                $q->where('name_area', $this->queryParams['area_name']);
            });
        }
        return $query;
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
            AfterSheet::class => function (AfterSheet $event) {
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
            1 => ['font' => ['bold' => true, 'size' => 11]],
            'A' => ['font' => ['bold' => true]],

        ];
    }

}

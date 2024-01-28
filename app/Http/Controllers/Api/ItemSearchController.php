<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Exports\ItemsSearchExport;
use App\Exports\ItemsSelectExport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ItemSearchController extends Controller
{

    public function search(Request $request)
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

        if ($request->has('category_id')) {
            $query->whereHas('itemData', function ($q) use ($request) {
                $q->where('category_id', $request->input('category_id'));
            });
        }
        if ($request->has('category_name')) {
            $query->whereHas('itemData.category', function ($q) use ($request) {
                $q->where('category_name', $request->input('category_name'));
            });
        }
        if ($request->has('manufacturer')) {
            $query->whereHas('itemData.manufacturer', function ($q) use ($request) {
                $q->where('id', $request->input('manufacturer'));
            });
        }
        if ($request->has('name_item')) {
            $query->whereHas('itemData', function ($q) use ($request) {
                $q->where('name_item', $request->input('name_item'));
            });
        }

        if ($request->has('suppliers_id')) {
            $query->whereHas('suppliers', function ($q) use ($request) {
                $q->where('id', $request->input('suppliers_id'));
            });
        }

        if ($request->has('supplier_name')) {
            $query->whereHas('itemData.suppliers', function ($q) use ($request) {
                $q->where('name_supplier','like', '%' . $request->input('supplier_name').'%');
            });
        }


        if ($request->has('unique_code')) {
            $query->where('unique_code', 'like', '%' . $request->input('unique_code') . '%');
        }

        if ($request->has('inventory_id')) {
            $query->whereHas('inventory', function ($q) use ($request) {
                $q->where('id', $request->input('inventory_id'));
            });
        }
        if ($request->has('inv_responsible')) {
            $query->whereHas('inventory.responsible', function ($q) use ($request) {
                $q->where('full_name', $request->input('inv_responsible'));
            });
        }
        if ($request->has('inv_dni_resp')) {
            $query->whereHas('inventory.responsible.profile', function ($q) use ($request) {
                $q->where('dni', $request->input('inv_dni_resp'));
            });
        }

        if ($request->has('custody_id')) {
            $query->whereHas('custody', function ($q) use ($request) {
                $q->where('id', $request->input('custody_id'));
            });
        }

        if ($request->has('custody_dni')) {
            $query->whereHas('custody.profile', function ($q) use ($request) {
                $q->where('dni', $request->input('custody_dni'));
            })->with('itemData.suppliers');
        }

        if ($request->has('full_name')) {
            $query->whereHas('custody', function ($q) use ($request) {
                $q->where('full_name', $request->input('full_name'));
            });
        }
        if ($request->has('repository_id')) {
            $query->whereHas('inventory.repository', function ($q) use ($request) {
                $q->where('id', $request->input('repository_id'));
            });
        }

        if ($request->has('repository_name')) {
            $query->whereHas('inventory.repository', function ($q) use ($request) {
                $q->where('repository_name', $request->input('repository_name'));
            });
        }
        if ($request->has('area_id')) {
            $query->whereHas('inventory.repository.area', function ($q) use ($request) {
                $q->where('id', $request->input('area_id'));
            });
        }
        if ($request->has('area_name')) {
            $query->whereHas('inventory.repository.area', function ($q) use ($request) {
                $q->where('name_area', $request->input('area_name'));
            });
        }


        $items = $query->get();
        $downloadUrl = route('download.excel', $request->all());
        return response()->json([
            'download_link' => $downloadUrl,
            'items' => $items,

        ]);


    }

    public function downloadItemsExcel(Request $request)
    {
        return Excel::download(new ItemsSearchExport($request->all()),'items_search.xlsx');
    }

    public function downloadSelectedItems(Request $request)
    {

        $itemIds = $request->input('item_ids', []);

        return Excel::download(new ItemsSelectExport($itemIds), 'selected_items.xlsx');
    }

}

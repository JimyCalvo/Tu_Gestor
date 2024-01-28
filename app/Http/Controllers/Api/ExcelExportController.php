<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ItemsExport;
use Maatwebsite\Excel\Facades\Excel;


class ExcelExportController extends Controller
{
    public function exportItems()
    {
         return  Excel::download(new ItemsExport, 'items.xlsx');
    }
}

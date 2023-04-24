<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $dataTable = new CategoryDataTable();
        if (request()->ajax()){
            $db = Category::with([]);
            return $dataTable->dataTable($db)->toJson();
        }

        return $dataTable->render('admin.category.index');
    }

}

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

    public function edit($id = 0)
    {
        $category = Category::findOrNew($id);
        if (request()->isMethod('POST')) {
            $post = request()->get('form');

            $validator = validator($post, Category::rules());
            if ($validator->fails()) {
                return redirect()->route('admin.category.edit', ['id' => $category->id_category])
                    ->with('danger', $validator->errors()->all())->withInput();
            }

            DB::beginTransaction();
            try {
                $category->fill($post);
                $category->save();

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();

                return redirect()->route('admin.category.edit', ['id' => $category->id_category])
                    ->with('danger', [__('admin.alert.error.edit')]);
            }

            return redirect()->route('admin.category.edit', ['id' => $category->id_category])
                ->with('success', [__('admin.alert.success.edit')]);
        }

        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $dataTable = new ProductDataTable();
        if (request()->ajax()){
            $db = Product::with([]);
            return $dataTable->dataTable($db)->toJson();
        }

        return $dataTable->render('admin.product.index');
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

    public function delete($id = 0)
    {
        $category = Category::findOrFail($id);
        DB::beginTransaction();
        try {
            $category->delete();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->route('admin.category.index')
                ->with('danger', [__('admin.alert.error.delete')]);
        }

        return redirect()->route('admin.category.index')
            ->with('success', [__('admin.alert.success.delete')]);

    }
}

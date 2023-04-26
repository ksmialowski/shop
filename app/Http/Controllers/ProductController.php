<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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
        $product = Product::findOrNew($id);
        $categories = Category::pluck('category_name', 'id_category')->toArray();

        if (request()->isMethod('POST')) {
            $post = request()->get('form');

            $validator = validator($post, Product::rules());
            if ($validator->fails()) {
                return redirect()->route('admin.product.edit', ['id' => $product->id_category])
                    ->withErrors($validator->errors())->withInput();
            }

            DB::beginTransaction();
            try {
                $product->fill($post);
                $product->save();

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();

                return redirect()->route('admin.product.edit', ['id' => $product->id_product])
                    ->with('danger', [__('admin.alert.error.edit')]);
            }

            return redirect()->route('admin.product.edit', ['id' => $product->id_product])
                ->with('success', [__('admin.alert.success.edit')]);
        }

        return view('admin.product.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function delete($id = 0)
    {
        $product = Product::findOrFail($id);
        DB::beginTransaction();
        try {
            $product->delete();

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

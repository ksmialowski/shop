<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use App\Services\Photo\PhotoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $dataTable = new ProductDataTable();
        if (request()->ajax()){
            $db = Product::with(['category', 'photo']);
            return $dataTable->dataTable($db)->toJson();
        }

        return $dataTable->render('admin.product.index');
    }

    public function edit($id = 0)
    {
        $product = $id > 0 ? Product::with(['photo'])->find($id) : new Product();
        $images = $product->photo->where('photo_type', 'large');
        $thumbnail = $product->photo->where('photo_type', 'thumbnail');
        $categories = Category::pluck('category_name', 'id_category')->toArray();
        $product_type = config('admin.product_type', []);

        if (request()->isMethod('POST')) {
            $post = request()->get('form');
            $images = request()->file('form.product_photo') ?? [];
            $thumbnail = request()->file('form.product_thumbnail') ?? [];

            $validator = validator($post, Product::rules());
            if ($validator->fails()) {
                return redirect()->route('admin.product.edit', ['id' => $product->id_product])
                    ->withErrors($validator->errors())->withInput();
            }

            DB::beginTransaction();
            try {
                $product->fill($post);
                $product->product_slug = Str::slug($post['product_name']);
                $product->save();

                if(!empty($images)) {
                    $images = (new PhotoService($images))->upload();
                }

                if(!empty($thumbnail)) {
                    if ($product->photo->where('photo_type', 'thumbnail')->count() > 0) {
                        $p = $product->photo->where('photo_type', 'thumbnail')->first();
                        $product->photo()->detach($p->id_photo);

                        if(Storage::exists('public/' . $p->photo_filepath)) {
                            Storage::delete('public/' . $p->photo_filepath);
                        }

                        $p->delete();
                    }
                    $thumbnail = (new PhotoService($thumbnail, 'products', 'thumbnail'))->upload();
                }

                $id_photos = array_merge($images, $thumbnail);
                $product->photo()->attach($id_photos);

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
            'images' => $images,
            'thumbnail' => $thumbnail,
            'categories' => $categories,
            'product_type' => $product_type,
        ]);
    }

    public function delete($id = 0)
    {
        $product = Product::with(['photo'])->findOrFail($id);
        DB::beginTransaction();
        try {
            if($product->photo->count() > 0) {
                foreach ($product->photo as $photo) {
                    $product->photo()->detach($photo->id_photo);

                    if(Storage::exists('public/' . $photo->photo_filepath)) {
                        Storage::delete('public/' . $photo->photo_filepath);
                    }

                    $photo->delete();
                }
            }
            $product->delete();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->route('admin.product.index')
                ->with('danger', [__('admin.alert.error.delete')]);
        }

        return redirect()->route('admin.product.index')
            ->with('success', [__('admin.alert.success.delete')]);

    }

    public function deletePhoto()
    {
        $id = request()->get('id_photo');
        $photo = Photo::with(['products'])->findOrFail($id);
        $filepath = $photo->photo_filepath;
        DB::beginTransaction();
        try {
            $photo->delete();
            $photo->products()->detach();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Photo deleted unsuccessfully',
            ]);
        }

        if(Storage::exists('public/' . $filepath)){
            Storage::delete('public/' . $filepath);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Photo deleted successfully'
        ]);
    }

    public function editSpecification(int $id = 0) {
        $product = Product::findOrFail($id);
        if (request()->isMethod('POST')) {
            $post = request()->all();
            $product_specification = $post['form'] ?? [];
            $newSpecifications = $post['new_specifications'] ?? [];

            $specifications = [];
            foreach ($newSpecifications as $specification) {
                $specifications[$specification['key']] = $specification['value'];
            }

            DB::beginTransaction();
            try {
                $product->product_specification = $product_specification;

                if(!empty($newSpecifications)) {
                    $product->product_specification = array_merge($product_specification, $specifications);
                }

                $product->save();
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();

                return redirect()->route('admin.product.edit-specification', ['id' => $product->id_product])
                    ->with('danger', [__('admin.alert.error.edit')]);
            }

            return redirect()->route('admin.product.edit-specification', ['id' => $product->id_product])
                ->with('success', [__('admin.alert.success.edit')]);
        }

        return view('admin.product.edit-specification', [
            'product' => $product,
        ]);
    }
}

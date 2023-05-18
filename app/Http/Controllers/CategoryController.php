<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use App\Models\Photo;
use App\Services\Photo\PhotoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $category = $id > 0 ? Category::with(['photo'])->findOrFail($id) : new Category();
        $thumbnail = $category->photo->where('photo_type', 'thumbnail');
        if (request()->isMethod('POST')) {
            $post = request()->get('form');
            $thumbnail = request()->file('form.category_thumbnail') ?? [];

            $validator = validator($post, Category::rules());
            if ($validator->fails()) {
                return redirect()->route('admin.category.edit', ['id' => $category->id_category])
                    ->with('danger', $validator->errors()->all())->withInput();
            }

            DB::beginTransaction();
            try {
                $category->fill($post);
                $category->save();

                if(!empty($thumbnail)) {
                    if ($category->photo->where('photo_type', 'thumbnail')->count() > 0) {
                        $c = $category->photo->where('photo_type', 'thumbnail')->first();
                        $category->photo()->detach($c->id_photo);

                        if(Storage::exists('public/' . $c->photo_filepath)) {
                            Storage::delete('public/' . $c->photo_filepath);
                        }

                        $c->delete();
                    }
                    $thumbnail = (new PhotoService($thumbnail, 'categories', 'thumbnail'))->upload();
                }

                $category->photo()->attach($thumbnail);

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
            'thumbnail' => $thumbnail,
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

    public function deletePhoto()
    {
        $id = request()->get('id_photo');
        $photo = Photo::with(['categories'])->findOrFail($id);
        $filepath = $photo->photo_filepath;
        DB::beginTransaction();
        try {
            $photo->delete();
            $photo->categories()->detach();

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
}

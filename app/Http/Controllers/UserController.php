<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $dataTable = new UserDataTable();
        if (request()->ajax()){
            $db = User::with([]);
            return $dataTable->dataTable($db)->toJson();
        }

        return $dataTable->render('admin.user.index');
    }

    public function edit($id = 0)
    {
        $user = User::findOrNew($id);
        if (request()->isMethod('POST')) {
            $post = request()->get('form');

            $validator = validator($post, $this->rules());
            if ($validator->fails()) {
                return redirect()->route('admin.user.edit', ['id' => $user->id])->withErrors($validator);
            }

            DB::beginTransaction();
            try{
                $user->fill($post);
                $user->save();

                DB::commit();
            }
            catch (\Exception $exception){
                DB::rollBack();

                return redirect()->route('admin.user.edit', ['id' => $user->id])->with('error', [__('admin.alert.error.edit')]);
            }

            return redirect()->route('admin.user.edit', ['id' => $user->id])->with('success', [__('admin.alert.success.edit')]);

        }

        return view('admin.user.edit', [
            'user' => $user,
        ]);
    }

    public function delete($id = 0)
    {
        dd(5);
    }

    private function rules(): array
    {
        return [
//            'name' => 'required',
            'email' => 'required|email',
        ];
    }
}

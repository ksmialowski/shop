<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $dataTable = new UserDataTable();
        if (request()->ajax()) {
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

            $validator = validator($post, User::rules($id));
            if ($validator->fails()) {
                return redirect()->route('admin.user.edit', ['id' => $user->id])
                    ->with('danger', $validator->errors()->all())->withInput();
            }

            if (empty($post['password'])) {
                unset($post['password']);
            }

            DB::beginTransaction();
            try {
                $user->fill($post);
                if (isset($post['password'])) {
                    $user->password = Hash::make($post['password']);
                }
                $user->save();

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();

                return redirect()->route('admin.user.edit', ['id' => $user->id])
                    ->with('danger', [__('admin.alert.error.edit')]);
            }

            return redirect()->route('admin.user.edit', ['id' => $user->id])
                ->with('success', [__('admin.alert.success.edit')]);
        }

        return view('admin.user.edit', [
            'user' => $user,
        ]);
    }

    public function delete($id = 0)
    {
        $user = User::findOrFail($id);
        DB::beginTransaction();
        try {
            if ($user->id === auth()->user()->id) {
                throw new \Exception('You can not delete yourself');
            }

            $user->delete();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->route('admin.user.index')
                ->with('danger', [__('admin.alert.error.delete')]);
        }

        return redirect()->route('admin.user.index')
            ->with('success', [__('admin.alert.success.delete')]);

    }
}

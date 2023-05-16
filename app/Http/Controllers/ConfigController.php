<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Product;

class ConfigController extends Controller
{
    public function edit()
    {
        $configs = Config::pluck('config_value', 'config_name');

        if (request()->isMethod('post')) {
            $post = request()->get('form', []);

            foreach ($post as $key => $value) {
                $config = Config::where('config_name', $key)->first();
                $config->config_value = $value;
                $config->save();
            }

            return redirect()->back()->with('success', [__('admin.alert.success.edit')]);
        }

        return view('admin.config.edit', [
            'configs' => $configs,
        ]);
    }
}

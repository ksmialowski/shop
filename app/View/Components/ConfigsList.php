<?php

namespace App\View\Components;

use App\Models\Config;
use Illuminate\View\Component;

class ConfigsList extends Component
{
    public $address;
    public $phone;
    public $email;

    public function __construct()
    {
        $config = Config::all();
        $this->address = $config->where('config_name', 'address')->first()->config_value;
        $this->phone = $config->where('config_name', 'phone')->first()->config_value;
        $this->email = $config->where('config_name', 'email')->first()->config_value;
    }

    public function render()
    {
        return view('components.configs-list');
    }
}

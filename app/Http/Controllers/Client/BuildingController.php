<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Masteroption;
use App\Models\Secondoption;
use Illuminate\Http\Request;

class BuildingController extends BaseController
{
    public $on_page = 20;

    public function index(Request $request)
    {
        $data = [];

        if ($request->isMethod('post')) {
            $params = $request->all();
        } else {
            $params = [];
        }

        $data['buildings'] = $this->service->getFilterData($params, $this->on_page);
        $data['filter'] = $params;
        $data['master_options'] = Masteroption::get();
        $data['second_options'] = Secondoption::get();


        return view('client.building.index', $data);
    }

}

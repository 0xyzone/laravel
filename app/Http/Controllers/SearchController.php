<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, $query)
    {
        if ($query == 'orders') {
            $search = Order::where('id', 'Like', '%' . $request->search . '%')->paginate(5);

            $output = "";
            foreach ($search as $val) {
                $output .=
                    '
                    <a href="'. route('orders').'/'.$val->id .'" class="group hover:bg-gray-400 hover:text-white cursor-pointer p-4 w-full font-bold text-lime-600">Order ADB# '. $val->id .' <br><span class="text-xs !font-normal text-black group-hover:text-white">'. $val->fullName .' | '. $val->phone .' </span></a>
            ';
            }

            return $output;
        }

        if ($query == 'phone') {
            $search = Order::where('phone', 'Like', '%' . $request->search . '%')->paginate(5);

            $output = "";
            foreach ($search as $val) {
                $output .=
                    '
                    <a href="'. route('orders').'/'.$val->id .'" class="group hover:bg-gray-400 hover:text-white cursor-pointer p-4 w-full font-bold text-lime-600">'. $val->fullName .' | '. $val->phone .' <br><span class="text-xs !font-normal text-black group-hover:text-white">Order ADB# '. $val->id .' </span></a>
            ';
            }

            return $output;
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    //View Result
    public function index(){
        $titlename = 'Result';
        return view('result', compact('titlename'));
    }

    //View Result
    public function index2(){
        $titlename = 'Result';
        return view('result2', compact('titlename'));
    }

    // Calculate Result
    public function calculate(Request $request){
        $formFields = $request->validate([
            'gender' => 'required',
            'age' => 'required',
            'height' => 'required',
            'weight' => 'required'
        ]);
        $centi = 30.48;
        $hincenti = $centi * $formFields['height'];
        $calc = ($formFields['weight'] / $hincenti / $hincenti) * 10000;
        $bmi = round($calc, 1);
        
        if($bmi < 18.5){
            $result = 'Under Weight';
        } elseif($bmi >=18.5 && $bmi < 25){
            $result = 'Normal';
        } elseif($bmi >=25 && $bmi < 30){
            $result = 'Over Weight';
        } elseif($bmi >=30){
            $result = 'Obese';
        }
        return redirect('/result')->with(['bmi' => $bmi, 'result' => $result, 'success' => 'Result generated successfully.']);
    }
}

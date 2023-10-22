<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SliderController extends Controller
{
private $sliderImages = [
    ['id'=>1, 'img'=> 'slider1.jpg', 'active'=> true],
    ['id'=>2, 'img'=> 'slider2.jpg', 'active'=> false],
    ['id'=>3, 'img'=> 'slider3.jpg', 'active'=> false],
];
public function getAll(){
    return view('Landing.home', ['images' => $this->sliderImages]);
}
}

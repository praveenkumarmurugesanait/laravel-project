<?php
namespace App\Http\Controllers;

use App\Services\Smartphone;

class HomeController 
{
    public function index()
    {
        $phone = new Smartphone();

        $photo = $phone->takePhoto();
        $music = $phone->playMusic();

        return view('trait', compact('photo', 'music'));
    }
}
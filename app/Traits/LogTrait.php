<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Camera
{
    public function takePhoto()
    {
        return "Photo captured 📸";
    }
}

trait MusicPlayer
{
    public function playMusic()
    {
        return "Playing music 🎵";
    }
}
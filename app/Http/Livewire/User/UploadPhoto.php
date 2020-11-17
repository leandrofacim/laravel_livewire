<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadPhoto extends Component
{
    use WithFileUploads;

    public $photo;

    public function storagePhoto() 
    {
        $this->validate([
            'photo' => 'required|image|max:1024'
        ]);

        $user = Auth::user();
        
        $nameFile = Str::slug($user->name) . '.' . $this->photo->getClientOriginalExtension();
       
        if ($path = $this->photo->storeAs('photos', $nameFile)) {
            $user->update([
                'profile_photo_path' => $path
            ]);
        }

        return redirect()->route('tweets.index');
    }

    public function render()
    {
        return view('livewire.user.upload-photo');
    }
}

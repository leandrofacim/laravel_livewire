<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{
    use WithPagination;

    public $content = 'apenas um teste';

    protected $rules = [
        'content' => 'required|min:6'
    ];

    protected $messages = [
        'content.required' => 'Campo obrigatorio!',
        'content.min' => 'Digite no minimo 6 caracteres!'
    ];

    public function render()
    {
        $tweets = Tweet::with('user')->latest()->paginate(10);

        return view('livewire.show-tweets', ['tweets' => $tweets]);
    }

    public function create()
    {
        $this->validate();

        Auth::user()->tweets()->create([
            'content' => $this->content,
        ]);

        session()->flash('message', 'Tweet criado com sucesso :)');

        $this->content = '';
    }
}

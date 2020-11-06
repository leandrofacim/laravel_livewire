<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
    </div>
    <form method="post" wire:submit.prevent="create">
        <input type="text" name="content" id="content" wire:model="content">
            @error('content') <span class="">{{$message}}</span> @enderror
        <button type="submit">Criar Tweet</button>
    </form>
    <hr>
    
    @foreach ($tweets as $tweet)
        {{$tweet->user->name}} - {{$tweet->content}} <br/>
    @endforeach

    <div>
        {{$tweets->links()}}
    </div>
</div>

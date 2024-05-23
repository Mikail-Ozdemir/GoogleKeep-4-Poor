<?php

use App\Models\Note;

use function Livewire\Volt\{state};

state([
    'title' => '',
    'content' => '',
    'notes' =>  Note::orderByDesc('created_at')->get(),
]);

$onSubmit = function () {
    Note::create([
        'title' => $this->title,
        'content' => $this->content,
    ]);

    // Réinitialisation des propriétés
    $this->title = '';
    $this->content = '';

    // Mise à jour des notes
    $this->notes = Note::orderByDesc('created_at')->get();
};

$onDelete = function (Note $note) {
    $note->delete();
    $this->notes = Note::orderByDesc('created_at')->get();
}; 

?>

<div>
    <form wire:submit="onSubmit" class="box">
        <div class="field">
            <div class="control">
                <input type="text" wire:model='title' class="input" placeholder="Title">
            </div>
        </div>
        <div class="field">
            <div class="control">
                <textarea wire:model='content' class="textarea" placeholder="Content"></textarea>
            </div>
        </div>
        <div class="field">
           <button type="submit" class="button is-rounded is-primary ">
                Ass
           </button>
        </div>
    </form>
   <div class="columns is-multiline">
   @foreach ($notes as $note)
        <div class="column is-4">
            <div class="box">
                <h2 class="title">
                    {{ $note->title }}

                    <button wire:click="onDelete({{$note->id}})" type="button" class="button  is-small  is-danger is-inverted">
                        supp
                    </button>
                </h2>
                <p class="content">
                    {{ $note->content }}
                </p>
            </div>
        </div>
   @endforeach     
   </div>
    
</div>

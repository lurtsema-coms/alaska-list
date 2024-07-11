<?php


use App\Models\User;
use App\Models\Category;
use Livewire\Volt\Component;

new class extends Component {
    public $model;

    public function delete()
    {
        $this->model->delete();
        
        $this->dispatch('alert-success');
    }
}; ?>

<div>
    <button class="bg-red-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-500"
        wire:click="delete">
        Delete
    </button>
</div>
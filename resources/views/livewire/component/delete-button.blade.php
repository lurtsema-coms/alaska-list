<?php

use Livewire\Volt\Component;

new class extends Component {
    public $model;

    public function delete()
    {
        $this->authorize('delete', $this->model); 

        $this->model->delete();
        
        $this->dispatch('alert-success');
    }
}; ?>

<div>
    <button class="bg-red-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-500"
        type="button"
        wire:click="delete"
        wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"
        >
        DELETE
    </button>
</div>
<?php


use App\Models\User;
use App\Models\Category;
use Livewire\Volt\Component;

new class extends Component {
    public $model;

    public function softDeletePost()
    {
        $this->model->update([
            'status' => 'INACTIVE',
            'updated_by' => auth()->user()->id,
        ]);
        $this->model->delete();

        $this->dispatch('alert-success');
    }

    public function restorePost()
    {
        $this->model->update([
            'status' => 'ACTIVE',
            'updated_by' => auth()->user()->id,
        ]);
        $this->model->restore();
        
        $this->dispatch('alert-success');
    }
}; ?>

<div>
    @if($model->deleted_at)
    <button class="bg-green-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-500"
        wire:click="restorePost">
        ACTIVE
    </button>
    @else
    <button class="bg-red-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-500"
        wire:click="softDeletePost">
        INACTIVE
    </button>
    @endif
</div>
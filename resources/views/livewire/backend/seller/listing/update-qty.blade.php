<?php

use App\Models\Product;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Livewire\Volt\Component;

new class extends Component {
    public $update_qty_modal = false;
    public $product_id;
    public $sub_category = '';
    public $title_name = '';
    public $price = '';
    public $qty = '';
    public $description = '';
    public $additional_information = '';
    public $status;

    public function mount($id)
    {
        $product = Product::with('subCategory')->find($id);

        $this->product_id = $product->id;
        $this->sub_category = $product->subCategory->id;
        $this->title_name = $product->name;
        $this->price = $product->price;
        $this->qty = $product->qty;
        $this->description = $product->description;
        $this->additional_information = $product->additional_information;
        $this->status = $product->status;
    }

    public function saveQty(){
        Product::find($this->product_id)->update([
            'qty' => $this->qty
        ]);

        $this->update_qty_modal = false;
        $this->dispatch('alert-success');    
    }
}; ?>

<div 
    x-data="{ update_qty_modal: $wire.entangle('update_qty_modal') }" x-init="$watch('update_qty_modal', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })">
    <button class="bg-blue-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-500"
    @click="update_qty_modal=true">
        UPDATE QTY
    </button>
    
    <div class="position fixed h-full w-full top-0 left-0 bg-black bg-opacity-30 z-10 overflow-auto"
        x-show="update_qty_modal"
        x-transition
        x-cloak>
        <div class="h-full flex p-5">
            <div class="bg-white w-full max-w-xl m-auto rounded-2xl shadow-lg overflow-hidden"
            @click.outside="update_qty_modal=false;">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="saveCategory">
                        <p class="font-bold text-lg text-slate-700 tracking-wide mb-6 pointer-events-none">Update QTY</p>
                        <div class="space-y-4">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1 space-y-2">
                                    <p class="font-medium text-slate-700">Qty</p>
                                    <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="qty">
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-8">
                            <button 
                                class="text-slate-600 shadow py-2 px-4 rounded-lg hover:opacity-70" 
                                type="button" 
                                @click="update_qty_modal = false"
                            >
                                Cancel
                            </button>
                            <button class="text-white bg-[#1F4B55] shadow py-2 px-4 rounded-lg hover:opacity-70" type="button" wire:click="saveQty">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


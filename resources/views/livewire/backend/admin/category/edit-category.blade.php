<?php

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Reactive;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    #[Validate('required', message: 'At least one sub-category is required.')]
    public $sub_categories = [];
    public $category_name = '';
    public $sc_title = '';
    public $category;
    public $category_id;
    public $initial_sc = [];
    public $initial_cn = '';
    public $edit_category_modal = false;

    function mount($category){
        $this->initial_cn = $category->name;
        $this->category_name = $this->initial_cn;
        $this->category_id = $category->id;
        $this->initial_sc = $category->subCategories->toArray();
        $this->sub_categories = $this->initial_sc;
    }

    function saveCategory()
    {
        $this->validate();

        // Extract unique sub_category names from current sub_categories
        $subCategoryNames = array_column($this->sub_categories, 'name');

        // Delete subCategories that are not in $subCategoryNames for this category_id
        SubCategory::where('category_id', $this->category_id)
            ->whereNotIn('name', $subCategoryNames)
            ->delete();
        
        Category::find($this->category_id)->update([
            'name' => $this->category_name,
            'updated_by' => auth()->user()->id
        ]);
        
        $new_sc = [];
        foreach ($this->sub_categories as $subCategory) {
            $sub_category = SubCategory::updateOrCreate(
                [
                    'category_id' => $this->category_id,
                    'name' => $subCategory['name'],
                ],
                [
                    'category_id' => $this->category_id,
                    'name' => $subCategory['name'],
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            $new_sc[] = $sub_category;
        }

        $this->initial_sc = $new_sc;


        $this->edit_category_modal = false;

        $this->dispatch('alert-success');
    }

    function addSubCategory()
    {
        if(!$this->sc_title) return;

        if(!$this->uniqueSubCategoryName($this->sc_title)) return;

        $this->resetEditValidation();

        // Generate a unique id based on the count of existing sub-categories
        $new_sub_category = [
            'id' => SubCategory::count(),
            'category_id' => $this->category_id,
            'name' => trim($this->sc_title),
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->sub_categories[] = $new_sub_category; 
        $this->resetData(['sc_title']);
    }

    function deleteSubCategory($index)
    {
        unset($this->sub_categories[$index]);
        $this->sub_categories = array_values($this->sub_categories);
    }

    function resetSubCategory()
    {
        $this->resetData(['sc_title']);
        $this->category_name = $this->initial_cn;
        $this->sub_categories = $this->initial_sc;
    }

    function resetEditValidation()
    {
        $this->resetValidation(['sub_categories', 'sc_title']);
    }

    function uniqueSubCategoryName($sc_title)
    {
        foreach ($this->sub_categories as $sub_category) {
            if ($sub_category['name'] === $sc_title) {
                $this->addError('sc_title', 'Sub-category name must be unique.');
                return false;
            }
        }
        return true;
    }

    function resetData($data)
    {
        $this->reset($data);
    }

    public function rules()
    {
        return [
            'category_name' => [
                'required',
                Rule::unique('categories', 'name')->ignore($this->category_id), 
            ],
        ];
    }

}; ?>

<div style="font-size: 16px;" 
    x-data="{ edit_category_modal: $wire.entangle('edit_category_modal') }" x-init="$watch('edit_category_modal', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })">
    <button class="bg-blue-400 text-sm text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-500"
    @click="edit_category_modal=true">
        EDIT
    </button>
    
    <div class="position fixed h-full w-full top-0 left-0 bg-black bg-opacity-30 z-10 overflow-auto"
        x-show="edit_category_modal"
        x-transition
        x-cloak>
        <div class="h-full flex p-5">
            <div class="bg-white w-full max-w-xl m-auto rounded-2xl shadow-lg overflow-hidden"
            @click.outside="edit_category_modal=false; $wire.resetSubCategory(); $wire.resetEditValidation()">
                <div class="p-10 max-h-[35rem] overflow-auto">
                    <form wire:submit="saveCategory">
                        <p class="font-bold text-lg text-slate-700 tracking-wide mb-6 pointer-events-none">Edit Category</p>
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Name</p>
                                <input class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]" type="text" required wire:model="category_name">
                                <div class="text-sm text-red-500">@error('category_name') {{ $message }} @enderror</div>
                            </div>
                            <div class="space-y-2">
                                <p class="font-medium text-slate-700">Add Sub Category</p>
                                <input
                                    class="text-md w-full px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-0 focus:border-[#1F4B55]"
                                    type="text"
                                    wire:model="sc_title"
                                    wire:keydown.enter.prevent="addSubCategory"
                                >
                                <div class="text-sm text-red-500">@error('sub_categories') {{ $message }} @enderror</div>
                                <div class="text-sm text-red-500">@error('sc_title') {{ $message }} @enderror</div>
                            </div>
                            <button type="button" wire:click="addSubCategory">
                                <div class="inline-block rounded-full p-2 border border-orange-400 hover:bg-orange-400 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </div>
                            </button>
                            <div>
                                <p class="text-gray-600 mb-2">Sub Categories Added</p>
                                <ol class="grid grid-cols-1 sm:grid-cols-2 gap-2 list-disc list-inside">
                                    @foreach ($sub_categories as $index => $sub_category)
                                        <li class="text-gray-800 break-words">
                                            <span>{{ $sub_category['name'] }}</span>
                                            <button type="button" wire:key="{{ $sub_category['id'] }}" wire:click="deleteSubCategory({{ $index }})">
                                                <div class="relative left-1 top-0.5 inline-block rounded-full p-0.5 border border-red-400 hover:bg-red-400 cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                            {{-- Loading Animation --}}
                            <div class="w-full text-center" wire:loading>
                                <div class="flex justify-center items-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-[#1F4B55]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 2.042.777 3.908 2.05 5.334l1.95-2.043z"></path>
                                    </svg>
                                    <span class="text-md font-medium text-slate-600">Saving post...</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-8">
                            <button class="text-slate-600 shadow py-2 px-4 rounded-lg hover:opacity-70" type="button"
                                @click="edit_category_modal=false; $wire.resetSubCategory(); $wire.resetEditValidation()">
                                Cancel
                            </button>
                            <button class="text-white bg-[#1F4B55] shadow py-2 px-4 rounded-lg hover:opacity-70" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
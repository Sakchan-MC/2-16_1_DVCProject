<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category as CategoryModel;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;
use LaravelIdea\Helper\App\Models\_IH_Product_C;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    public string $title = "";
    public CategoryModel $category;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.admin.category');
    }

    public function mount(): void
    {
        $this->init();
    }

    public function init(): void
    {
        $this->resetExcept("category");
        $this->title = 'Add Category';
        $this->category = new CategoryModel;
    }


    public function submit(): void
    {
        $this->validate();
        $id = $this->category->id;
        try {
            DB::beginTransaction();
            $this->category->save();
            DB::commit();
            $this->dispatchBrowserEvent("close_modal");
            toastr()->addSuccess($id ? "Category has been updated" : "Category has been created");
        } catch (Exception $ex) {
            DB::rollBack();
            toastr()->timeOut(10000)->addError($ex->getMessage());
        }
    }

    public function remove($id, $name): void
    {
        try {
            DB::beginTransaction();
            CategoryModel::where("id", $id)->delete();
            toastr()->addSuccess("$name has been deleted");
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            toastr()->timeOut(10000)->addError($ex->getMessage());
        }
    }

    public function setCurrent($id): void
    {
        $this->init();
        $this->category = CategoryModel::query()->where("id", $id)->first();
        $this->title = 'Edit Category';
    }


    public function getCategoriesProperty(): _IH_Product_C|LengthAwarePaginator
    {
        return CategoryModel::paginate(10);
    }

    protected function rules(): array
    {
        return [
            "category.id" => "nullable",
            "category.name" => ['required', "max:255", Rule::unique('categories','name')->ignore($this->category->id)],
            "category.desc" => "max:255",
        ];
    }
}

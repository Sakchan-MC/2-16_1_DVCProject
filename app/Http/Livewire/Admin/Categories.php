<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
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

    public string $name = "";
    public string $desc = "";
    public Category $cCategory;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.admin.category');
    }

    public function mount(): void
    {
        $this->cCategory = new Category();
    }

    public function submit(): void
    {
        $this->validate();
        if ($this->cCategory?->id) {
            $this->update();
        } else {
            $this->create();
        }

    }

    public function update(): void
    {
        try {
            DB::beginTransaction();
            $this->cCategory->name = $this->name;
            $this->cCategory->desc = $this->desc;
            $this->cCategory->save();
            $this->dispatchBrowserEvent("close_modal");
            toastr()->addSuccess("Product has been updated");
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            toastr()->timeOut(10000)->addError($ex->getMessage());
        }
    }

    public function create(): void
    {
        try {
            DB::beginTransaction();
            Category::create([
                "name" => $this->name,
                "desc" => $this->desc,
            ]);
            DB::commit();
            $this->dispatchBrowserEvent("close_modal");
            toastr()->addSuccess("Product has been created");
        } catch (Exception $ex) {
            DB::rollBack();
            toastr()->timeOut(10000)->addError($ex->getMessage());
        }
    }

    public function clear(): void
    {
        $this->resetExcept("cCategory");
    }


    public function remove($id, $name): void
    {
        try {
            DB::beginTransaction();
            Category::where("id", $id)->delete();
            toastr()->addSuccess("$name has been deleted");
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            toastr()->timeOut(10000)->addError($ex->getMessage());
        }

    }

    public function setCurrent($id): void
    {
        $this->cCategory = Category::query()->where("id", $id)->first();
        $this->name = $this->cCategory->name;
        $this->desc = $this->cCategory->desc;
    }


    public function getCategoryProperty(): _IH_Product_C|LengthAwarePaginator
    {
        return Category::paginate(10);
    }

    protected function rules(): array
    {
        return [
            "name" => ['required', "max:255", Rule::unique('categories')->ignore($this->cCategory?->id)],
            "desc" => "max:255",
        ];
    }
}

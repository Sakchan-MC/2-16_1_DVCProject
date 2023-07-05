<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;
use LaravelIdea\Helper\App\Models\_IH_Product_C;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public string $name = "";
    public string $desc = "";
    public string $idCategory = "";
    public Product $currentProduct;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.admin.products');
    }

    public function submit(): void
    {
        $this->validate();
        if ($this->currentProduct?->id) {
            $this->update();
        } else {
            $this->create();
        }

    }

    public function update(): void
    {
        try {
            DB::beginTransaction();
            $this->currentProduct->name = $this->name;
            $this->currentProduct->desc = $this->desc;
            $this->currentProduct->id_category = $this->idCategory;
            $this->currentProduct->save();
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
            Product::create([
                "name" => $this->name,
                "desc" => $this->desc,
                "id_category" => $this->idCategory
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
        $this->resetExcept("currentProduct");
    }

    public function remove($id, $name): void
    {
        try {
            DB::beginTransaction();
            Product::where("id", $id)->delete();
            toastr()->addSuccess("$name has been deleted");
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            toastr()->timeOut(10000)->addError($ex->getMessage());
        }

    }

    public function setCurrentProduct($id): void
    {
        $this->currentProduct = Product::where("id", $id)->first();
        $this->name = $this->currentProduct->name;
        $this->desc = $this->currentProduct->desc;
        $this->idCategory = $this->currentProduct->id_category;
    }

    public function getCategoryProperty(): Collection
    {
        return Category::all();
    }

    public function getProductProperty(): _IH_Product_C|LengthAwarePaginator
    {
        return Product::with("category")->paginate(10);
    }

    protected function rules(): array
    {
        return [
            "name" => ['required', "max:255", Rule::unique('products')->ignore($this->currentProduct?->id)],
            "form.desc" => "max:255",
            "form.id_category" => "required|not_in:0"
        ];
    }
}

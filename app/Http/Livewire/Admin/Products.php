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
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Str;

class Products extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $file;
    public Product $currentProduct;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.admin.products');
    }

    public function submit(): void
    {
        $this->validate();
        try {
            DB::beginTransaction();
            if ($this->file) {
                $this->currentProduct->img = Str::replace("public", "storage", $this->file->store("public/products"));
            } elseif (!$this->currentProduct->img) {
                $this->currentProduct->img = "storage/placeholder.jpg";
            }
            $this->currentProduct->save();
            $this->dispatchBrowserEvent("close_modal");
            toastr()->addSuccess("Product has been updated");
            DB::commit();
            $this->cleanupOldUploads();
        } catch (Exception $ex) {
            DB::rollBack();
            toastr()->timeOut(10000)->addError($ex->getMessage());
        }

    }

    public function clear(): void
    {
        $this->init();
    }

    public function init()
    {
        $this->currentProduct = new Product();
        $this->currentProduct->id_category = $this->category->first()?->id;
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
            "currentProduct.id_category" => "nullable",
            "currentProduct.desc" => "nullable",
            "currentProduct.name" => ['required', "max:255", Rule::unique('products', "name")->ignore($this->currentProduct->id)],
            "file" => "image"
        ];
    }
}

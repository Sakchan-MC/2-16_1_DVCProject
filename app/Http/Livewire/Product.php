<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Product extends Component
{
    public \App\Models\Product $product;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.product')->layout("layouts.welcome");
    }

    public function getProductProperty(): Collection|null
    {
        return Category::with("products")->get();
    }

}

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

    public function render()
    {
        $categories = Category::with("products")->get();
        return view('livewire.product', ["categories" => $categories])->layout("layouts.welcome");
    }
}

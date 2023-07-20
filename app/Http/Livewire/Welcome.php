<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        return view('livewire.welcome')->layout("layouts.welcome");
    }

    public function getProductsProperty(): Collection
    {
        return \App\Models\Product::query()->limit(3)->orderBy("id", "desc")->get();
    }

    public function getProductProperty(): \App\Models\Product
    {
        return \App\Models\Product::query()->inRandomOrder()->first();
    }
}

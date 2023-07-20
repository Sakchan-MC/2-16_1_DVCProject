<div class="flex flex-wrap gap-4">
    @foreach($this->product as $category)
        <div class="card w-full bg-gray-100 shadow-xl flex-auto">
            <div class="card-body">
                <h2 class="card-title">{{$category->name}}</h2>
                <div class="flex flex-wrap gap-4">
                    @foreach($category->products as $product)
                        <div class="card card-compact w-auto bg-base-100 shadow-xl flex-auto">
                            @if($product->img)
                                <td>
                                    <div class="flex flex-wrap justify-center">
                                        <img src="{{asset($product->img)}}" class="max-h-48 rounded mt-4 mx-4"
                                             alt="{{$product->name}}"/>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div class="flex flex-wrap justify-center ">
                                        <img src="{{asset("storage/placeholder.jpg")}}"
                                             class="max-h-48 rounded mt-4 mx-4"
                                             alt="placeholder"/>
                                    </div>
                                </td>
                            @endif
                            <div class="card-body">
                                <h2 class="card-title self-center">{{$product->name}}</h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>

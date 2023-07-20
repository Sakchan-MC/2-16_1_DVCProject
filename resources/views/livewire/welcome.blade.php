<div class="flex-none justify-center">
    <div class="grid grid-cols-2 m-10">
        <div class="flex flex-wrap text-3xl  justify-center self-center">
            <p class="indent-4">Enjoy your
                &nbsp;
            <p class="text-orange-300">Cofee</p>
            &nbsp;
            before your activity
            </p>
        </div>
        <div class="flex flex-wrap text-3xl justify-center">
            <figure><img src="{{$this->product->img}}" alt="{{$this->product->name}}"
                         class="max-h-80 max-w-xs rounded-full m-4"/>
            </figure>
        </div>
    </div>
    <div class="flex flex-wrap justify-center p-4 "><h3 class="text-3xl font-bold">New Product!</h3></div>
    <div class="flex flex-wrap gap-4 justify-center">
        @foreach($this->products as $product)
            <div class="card card-compact w-96 bg-base-100 shadow-xl">
                <figure><img src="{{$product->img}}" alt="{{$product->name}}"
                             class="max-h-80 max-w-xs rounded-3xl m-4"/>
                </figure>
                <div class="card-body">
                    <h2 class="card-title ">{{$product->name}}</h2>
                    <p>
                    <div class="badge badge-accent">{{$product->category->name}}</div>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>

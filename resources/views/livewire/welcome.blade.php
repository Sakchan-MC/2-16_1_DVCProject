<div class="card bg-base-200 flex-none justify-center pb-4 shadow-xl">
   <div class="bold m-10 self-center text-5xl">Rimma Coffee</div>
   <div class="m-10 grid grid-cols-2">
      <div class="flex flex-wrap justify-center self-center text-3xl">

         <p class="indent-4">Enjoy your
            &nbsp;
         <p class="text-orange-300">Coffee</p>
         &nbsp;
         before your activity
         </p>
      </div>
      <div class="flex flex-wrap justify-center text-3xl">
         @if ($this->product->img)
            <figure><img src="{{ $this->product->img }}" alt="{{ $this->product->name }}"
                  class="m-4 max-h-80 max-w-xs rounded-full" />
            </figure>
         @else
            <figure><img src="{{ asset('storage/placeholder.jpg') }}" alt="{{ $this->product->name  }}"
                  class="m-4 max-h-80 max-w-xs rounded-full" />
            </figure>
         @endif
      </div>
   </div>
   <div class="flex flex-wrap justify-center p-4">
      <h3 class="text-3xl font-bold">New Product!</h3>
   </div>
   <div class="flex flex-wrap justify-center gap-4">
      @foreach ($this->products as $product)
         <div class="card-compact card bg-base-100 w-96 shadow-xl">
            @if ($product->img)
               <figure><img src="{{ asset($product->img) }}" alt="{{ $product->name }}"
                     class="m-4 max-h-80 max-w-xs rounded-3xl" />
               </figure>
            @else
               <figure><img src="{{ asset('storage/placeholder.jpg') }}" alt="{{ $product->name }}"
                     class="m-4 max-h-80 max-w-xs rounded-3xl" />
               </figure>
            @endif

            <div class="card-body">
               <h2 class="card-title">{{ $product->name }}</h2>
               <p>
               <div class="badge badge-accent">{{ $product->category->name }}</div>
               </p>
            </div>
         </div>
      @endforeach
   </div>
</div>

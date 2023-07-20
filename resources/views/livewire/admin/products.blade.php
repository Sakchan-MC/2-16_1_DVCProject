<div>
    <div class="card w-full bg-base-100 shadow-xl my-5">
        <div class="card-body">
            <div class="overflow-x-auto">
                <div class="flex justify-between">
                    <div class="text-2xl self-center font-bold">
                        Products
                    </div>
                    <div>
                        <button class="btn btn-primary" onclick="modal.showModal()" wire:click="clear">Add</button>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Desc</td>
                        <td>Category</td>
                        <td>Image</td>

                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($this->product as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->desc}}</td>
                            <td>{{$product->category->name}}</td>
                            @if($product->img)
                                <td>
                                    <div class="flex flex-wrap justify-center">
                                        <img src="{{asset($product->img)}}" class="max-h-48 rounded"
                                             alt="{{$product->name}}"/>
                                    </div>

                                </td>
                            @else
                                <td>
                                    <div class="flex flex-wrap justify-center">
                                        <img src="{{asset("storage/placeholder.jpg")}}" class="max-h-48 rounded"
                                             alt="placeholder"/>
                                    </div>
                                </td>
                            @endif


                            <td>
                                <div class="overflow-x-auto">
                                    <div class="flex gap-3 justify-center">
                                        <div>
                                            <button type="button" class="btn btn-warning"
                                                    wire:click="setCurrentProduct({{$product->id}})"
                                                    onclick="modal.showModal()">Edit
                                            </button>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-error"
                                                    onclick="confirmDelete({{$product->id}},'{{$product->name}}')">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center font-bold text-xl">ไม่พบข้อมูล</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $this->product->links()}}
            </div>
        </div>
    </div>
    <dialog id="modal" class="modal modal-bottom sm:modal-middle" wire:ignore.self>

        <form method="dialog" class="modal-box" wire:submit.prevent="submit">
            <div class="w-full">
                <h3 class="font-bold text-lg mb-5">{{$currentProduct?"Edit":"Add"." Product"}}</h3>
                <div wire:loading class="text-center w-full">
                    <progress class="progress"></progress>
                </div>
                <div wire:loading.remove>

                    <label class="label" for="name">
                        <span class="label-text">Product name</span>
                    </label>
                    <input id="name" type="text" maxlength="255" placeholder="Product name"
                           class="input input-bordered w-full  @error("currentProduct.name")input-error @enderror"
                           wire:model.defer="currentProduct.name"/>
                    @error("currentProduct.name")
                    <label class="label" for="name">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                    <label class="label" for="desc">
                        <span class="label-text">Product desc</span>
                    </label>
                    <input id="desc" type="text" maxlength="255" placeholder="Product desc"
                           class="input input-bordered w-full  @error("currentProduct.desc")input-error @enderror"
                           wire:model.defer="currentProduct.desc"/>
                    @error("currentProduct.desc")
                    <label class="label" for="desc">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror

                    <label class="label" for="category">
                        <span class="label-text-alt">Product Category</span>
                    </label>
                    <select id="category"
                            class="select select-bordered w-full  @error("currentProduct.id_category")select-error @enderror"
                            wire:model.defer="currentProduct.id_category">
                        @forelse($this->category as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @empty
                            <option disabled>Create Category first!</option>
                        @endforelse

                    </select>
                    @error("currentProduct.id_category")
                    <label class="label" for="category">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                    <label class="label" for="file">
                        <span class="label-text-alt">Product Category</span>
                    </label>
                    <input type="file" class="file-input file-input-bordered w-full max-w-xs" id="file"
                           wire:model="file"/>
                    @error("file")
                    <label class="label" for="category">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
 
                <div class="modal-action">
                    <button class="btn btn-success" type="submit" wire:loading.remove>Submit</button>
                    <button class="btn btn-warning" type="button" onclick="modal.close()">
                        Close
                    </button>
                </div>
            </div>

        </form>
    </dialog>

</div>
@push("script")
    <script type="text/javascript">


        window.addEventListener('close_modal', () => {
            modal.close();
        })

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Are you sure?',
                text: `Delete ${name}? `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.
                    remove(id, name);
                }
            })
        }
    </script>
@endpush

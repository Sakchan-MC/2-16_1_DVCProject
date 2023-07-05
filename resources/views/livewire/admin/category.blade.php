<div>

    <div class="card w-full bg-base-100 shadow-xl my-5">
        <div class="card-body">
            <div class="overflow-x-auto">
                <div class="flex justify-between">
                    <div class="text-2xl self-center font-bold">
                        Category
                    </div>
                    <div>
                        <button class="btn btn-primary" onclick="modal.showModal()" wire:click="clear">Add</button>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Desc</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($this->category as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->desc}}</td>
                            <td>
                                <div class="overflow-x-auto">
                                    <div class="flex gap-3">
                                        <div>
                                            <button type="button" class="btn btn-warning"
                                                    wire:click="setCurrent({{$category->id}})"
                                                    onclick="modal.showModal()">Edit
                                            </button>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-error"
                                                    onclick="confirmDelete({{$category->id}},'{{$category->name}}')">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center font-bold text-xl">ไม่พบข้อมูล</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $this->category->links()}}
            </div>
        </div>
    </div>
    <dialog id="modal" class="modal modal-bottom sm:modal-middle" wire:ignore.self>

        <form method="dialog" class="modal-box" wire:submit.prevent="submit">
            <div class="w-full">
                <h3 class="font-bold text-lg mb-5">{{$cCategory?"Edit":"Add"." Categories"}}</h3>
                <div wire:loading class="text-center w-full">
                    <progress class="progress"></progress>
                </div>
                <div wire:loading.remove>

                    <label class="label" for="name">
                        <span class="label-text">Category name</span>
                    </label>
                    <input id="name" type="text" maxlength="255" placeholder="Category name"
                           class="input input-bordered w-full  @error("name")input-error @enderror"
                           wire:model.defer="name"/>
                    @error("name")
                    <label class="label" for="name">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                    <label class="label" for="desc">
                        <span class="label-text">Category desc</span>
                    </label>
                    <input id="desc" type="text" maxlength="255" placeholder="Category desc"
                           class="input input-bordered w-full  @error("desc")input-error @enderror"
                           wire:model.defer="desc"/>
                    @error("desc")
                    <label class="label" for="desc">
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

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUser" >
    Add User
</button>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="createUserLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createUserLabel">Create User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" wire:model="name">
                        @error('name')
                            <span class="text-sm text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" wire:model="email">
                        @error('email')
                        <span class="text-sm text-danger">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" wire:model="password">
                        @error('password')
                        <span class="text-sm text-danger">{{$message}}</span>
                    @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" wire:click.prevent="store()">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>




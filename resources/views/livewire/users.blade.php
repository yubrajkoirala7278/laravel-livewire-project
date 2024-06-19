<div class="p-4 bg-white">
    @include('livewire.create')
    @include('livewire.edit')


    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($users) > 0)
            @foreach ($users as $user)
            <tr>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser"
                        wire:click="editUser({{$user->id}})" class="btn btn-primary btn-sm">Edit</button>
                    <button wire:click="deleteUser({{$user->id}})" class="btn btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="3" align="center">
                    No Posts Found.
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

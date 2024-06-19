<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Users extends Component
{
    public $name, $email, $password, $addUser = false, $users, $user_id, $updateMode = false;

    protected $rules = [
        'name' => 'required',
        'email' => ['required'],
        'password' => 'required'
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->user_id = '';
    }

    public function render()
    {
        $this->users = User::latest()->get();
        return view('livewire.users');
    }

    public function store()
    {
        $this->validate();
        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
            $user->syncRoles(['user']);
            $this->resetFields();
            $this->addUser = false;
            $this->dispatch('userStore');
            session()->flash('success', 'Post Created Successfully!!');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function editUser($id)
    {
        try {
            $this->updateMode = true;
            $user = User::findOrFail($id);
            if (!$user) {
                session()->flash('error', 'User not found');
            } else {
                $this->name = $user->name;
                $this->email = $user->email;
                $this->user_id = $user->id;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetFields();
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        try {
            if ($this->user_id) {
                $user = User::find($this->user_id);
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                ]);
                $this->updateMode = false;
                session()->flash('success', 'User updated successfully!');
                $this->resetFields();
                $this->dispatch('userUpdate');
            }
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }

    public function deleteUser($id)
    {
        try {
            User::find($id)->delete();
            session()->flash('success', "User Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}

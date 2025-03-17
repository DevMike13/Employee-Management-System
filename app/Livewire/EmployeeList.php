<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Attributes\Title;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

#[Title("Employee List")]
class EmployeeList extends Component
{
    use WithFileUploads, WithPagination, Actions;

    #[Url]
    public $perPage = 10;

    #[Url]
    public $searchTerm = '';

    public $sortColumn = 'id';
    public $sortDirection = 'asc';
    public $firstName, $lastName, $email, $phone, $post, $avatar;
    public $editEmployeeId, $editFirstName, $editLastName, $editEmail, $editPhone, $editPost, $editAvatar, $newEditAvatar;

    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function addEmployee()
    {
        $this->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string',
            'post' => 'required|string',
            'avatar' => 'nullable|image|max:2048', // Max 2MB image
        ]);

        $avatarPath = $this->avatar ? $this->avatar->store('avatars', 'public') : null;

        Employee::create([
            'firstname' => $this->firstName,
            'lastname' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'post' => $this->post,
            'avatar' => $avatarPath,
        ]);

        $this->resetAddFields();
        $this->dispatch('reload');

        $this->notification()->success(
            $title = 'Employee Profile saved',
            $description = 'Your employee was successfully saved'
        );
    }

    public function getSelectedEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $this->editEmployeeId = $employee->id;
        $this->editFirstName = $employee->firstname;
        $this->editLastName = $employee->lastname;
        $this->editEmail = $employee->email;
        $this->editPhone = $employee->phone;
        $this->editPost = $employee->post;
        $this->editAvatar = $employee->avatar;
    }

    public function editEmployee()
    {
        $this->validate([
            'editFirstName' => 'required|string|max:255',
            'editLastName' => 'required|string|max:255',
            'editEmail' => 'required|email|unique:employees,email,' . $this->editEmployeeId,
            'editPhone' => 'required|string',
            'editPost' => 'required|string',
            'newEditAvatar' => 'nullable|image|max:2048',
        ]);

        $employee = Employee::findOrFail($this->editEmployeeId);

        if ($this->newEditAvatar) {
            if ($employee->avatar) {
                \Storage::disk('public')->delete($employee->avatar);
            }
            $avatarPath = $this->newEditAvatar->store('avatars', 'public');
        } else {
            $avatarPath = $employee->avatar;
        }

        $employee->update([
            'firstname' => $this->editFirstName,
            'lastname' => $this->editLastName,
            'email' => $this->editEmail,
            'phone' => $this->editPhone,
            'post' => $this->editPost,
            'avatar' => $avatarPath,
        ]);
        
        $this->resetEditFields();
        $this->dispatch('reload');
       
        $this->notification()->success(
            $title = 'Employee Profile Updated',
            $description = 'The employee details were successfully updated.'
        );
    }

    public function deleteConfirmation($id, $employeeName){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this employee " . html_entity_decode('<span class="text-red-600 underline">' . $employeeName . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteEmployee',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }

    public function deleteEmployee($id){
        $employee = Employee::findOrFail($id);
        if ($employee->avatar) {
            \Storage::disk('public')->delete($employee->avatar);
        }

        $employee->delete();

        $this->notification()->success(
            'Employee Deleted',
            'The employee record has been successfully deleted.'
        );

        return redirect()->back();
    }

    public function resetAddFields()
    {
        $this->reset([
            'firstName', 'lastName', 'email', 'phone', 'post', 'avatar'
        ]);
    }

    public function resetEditFields()
    {
        $this->reset([
            'editEmployeeId', 'editFirstName', 'editLastName', 'editEmail', 
            'editPhone', 'editPost', 'editAvatar', 'newEditAvatar'
        ]);
    }

    public function render()
    {
        
        if ($this->searchTerm) {
           $searchItems = Employee::where('lastname', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
            ->latest()
            ->paginate($this->perPage);            

            $employees = $searchItems;
        } else {
            $employees = Employee::orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);
        }
        
        return view('livewire.employee-list', [
            'employees' => $employees
        ]);
    }
}

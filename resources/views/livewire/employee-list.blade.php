<div class="w-full h-auto flex justify-center px-5 pt-10 lg:px-40">
    <div class="w-full flex flex-col bg-white border border-gray-200 shadow-lg rounded-sm dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
        <div class="flex flex-col gap-2 md:flex-row justify-between items-center bg-red-500 border-b border-gray-200 rounded-t-sm py-2 px-2 md:py-2 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
            <p class="lg:text-xl text-md text-white font-semibold dark:text-neutral-500">
                Manage Employees
            </p>
            <button type="button" onclick="$openModal('newEmployeeModal')" class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-xs md:text-sm md:px-5 md:py-1.5 px-4 py-1 text-center inline-flex items-center dark:focus:ring-gray-500 me-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 md:size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>                      
                Add New Employee
            </button>                
        </div>            
        
        <div class="p-4 md:p-5">
            @if ($employees)
                <div class="w-full h-auto lg:h-10 flex flex-col-reverse lg:flex-row justify-between items-center mb-3">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex justify-center items-center gap-2">
                            <label for="perPage" class="text-sm font-medium text-gray-700 dark:text-gray-400">Show</label>
                            <x-native-select
                                :options="[5, 10, 20, 50]"
                                wire:model.live="perPage"
                            />
                            <span class="text-sm text-gray-700 dark:text-gray-400">entries</span>
                        </div>
                    </div>
                    
                    <form class="w-full md:w-[220px] h-10">   
                        <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" wire:model.live="searchTerm" class="block w-full md:w-[220px] p-1.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required />
                        </div>
                    </form>
                </div>
                    
                <div class="relative overflow-x-auto shadow-sm sm:rounded-sm">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">
                                    <div class="flex items-center">
                                        ID 
                                        <div class="flex">
                                            <a wire:click="sortBy('id', 'asc')" 
                                            class="rounded w-fit -mr-2 cursor-pointer {{ $sortColumn === 'id' && $sortDirection === 'asc' ? 'text-blue-500' : 'text-gray-500' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                                                </svg>
                                            </a>
                                            <a wire:click="sortBy('id', 'desc')" 
                                                class="rounded cursor-pointer {{ $sortColumn === 'id' && $sortDirection === 'desc' ? 'text-blue-500' : 'text-gray-500' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 rotate-180">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Avatar
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    E-mail
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Post
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Phone
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$employees->isEmpty())
                                @foreach ($employees as $employee)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $employee->id }}
                                        </th>
                                        <td class="px-6 py-4">
                                            @if ($employee->avatar)
                                                <img src="{{ asset('storage/' . $employee->avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $employee->firstname }} {{ $employee->lastname }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $employee->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $employee->post }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $employee->phone }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-4">
                                                <a href="#" onclick="$openModal('editEmployeeModal')" wire:click="getSelectedEmployee({{ $employee->id }})" class="text-blue-600 dark:text-blue-500 hover:underline">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                </a>
                                                <a href="#" wire:click="deleteConfirmation({{ $employee->id }}, '{{ $employee->firstname }} {{ $employee->lastname }}')" class="text-red-600 dark:text-red-500 hover:underline">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>                                          
                                                </a>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-gray-500 italic">
                                        No records found.
                                    </td>
                                </tr>
                            @endif
                           
                        </tbody>
                    </table>
                   
                </div>
                <div class="w-full justify-center items-center py-5 px-2">
                    {{ $employees->links() }}
                </div>
            @else
                <div class="w-full h-52 flex justify-center items-center">
                    <p class="italic font-medium text-gray-500">No Employee Record</p>
                </div>
            @endif
           
        </div>
    </div>

    {{-- ADD MODAL --}}
    <x-modal.card title="Add New Employee" name="newEmployeeModal"  wire:model.defer="newEmployeeModal" blur align="center" max-width="lg" persistent>
            <form wire:submit.prevent="addEmployee">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
                    <div class="col-span-1 sm:col-span-1">
                        <div class="grid grid-cols-2 gap-3">
                            <x-input label="First name" placeholder="Ex: Juan" class="py-3 -mt-1" wire:model="firstName" />
                            <x-input label="Last name" placeholder="Ex: Cruz" class="py-3 -mt-1" wire:model="lastName" />
                        </div>
                    </div>
                    
                    <x-input label="Email" placeholder="Ex: juanreyes@gmai.com" class="py-3 -mt-1 col-span-1 sm:col-span-1" wire:model="email" />
                    
                    <x-inputs.phone label="Mobile No." placeholder="Ex: +63 912 345 6789" mask="['+63 ### ### ####']" class="py-3 -mt-1 col-span-1 sm:col-span-1" wire:model="phone" />

                    <x-input label="Post" placeholder="Ex: Web Developer" class="py-3 -mt-1 col-span-1 sm:col-span-1" wire:model="post" />
                    <div class="col-span-1 sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-neutral-400 mb-2">Avatar</label>
                        <div class="flex items-center">
                            <input type="file" class="p-1 w-full text-slate-500 text-sm rounded-md leading-6 file:bg-violet-200 file:text-violet-700 file:font-semibold file:border-none file:px-4 file:py-1 file:mr-6 file:rounded-md hover:file:bg-violet-100 border border-gray-300" wire:model="avatar">
                        </div>
                    </div>
                    
                </div>
                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <div class="flex">
                            <x-button flat label="Cancel" x-on:click="close" wire:click="resetAddFields"/>
                            <x-button primary label="Add Employee" wire:click="addEmployee"/>
                        </div>
                    </div>
                </x-slot>
            </form>
    </x-modal.card>

    {{-- EDIT MODAL --}}
    <x-modal.card title="Edit Employee" name="editEmployeeModal"  wire:model.defer="editEmployeeModal"  blur align="center" max-width="lg" persistent>
        <form wire:submit.prevent="editEmployee">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
                <div class="col-span-1 sm:col-span-1">
                    <div class="grid grid-cols-2 gap-3">
                        <x-input label="First name" placeholder="Ex: Juan" class="py-3 -mt-1" wire:model="editFirstName" />
                        <x-input label="Last name" placeholder="Ex: Cruz" class="py-3 -mt-1" wire:model="editLastName" />
                    </div>
                </div>
                
                <x-input label="Email" placeholder="Ex: juanreyes@gmai.com" class="py-3 -mt-1 col-span-1 sm:col-span-1" wire:model="editEmail" />
                
                <x-inputs.phone label="Mobile No." placeholder="Ex: +63 912 345 6789" mask="['+63 ### ### ####']" class="py-3 -mt-1 col-span-1 sm:col-span-1" wire:model="editPhone" />

                <x-input label="Post" placeholder="Ex: Web Developer" class="py-3 -mt-1 col-span-1 sm:col-span-1" wire:model="editPost" />
                <div class="col-span-1 sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-neutral-400 mb-2">Avatar</label>
                    <div class="flex items-center">
                        @if ($newEditAvatar instanceof \Livewire\TemporaryUploadedFile)
                            <img src="{{ $newEditAvatar->temporaryUrl() }}" class="w-16 h-16 rounded-full">
                        @elseif ($editAvatar)
                            <img src="{{ asset('storage/' . $editAvatar) }}" class="w-16 h-16 rounded-full">
                        @else
                            <img src="https://placehold.co/100" class="w-16 h-16 rounded-full">
                        @endif
                        <input type="file" class="ml-4 p-1 w-full text-slate-500 text-sm rounded-md leading-6 
                        file:bg-violet-200 file:text-violet-700 file:font-semibold file:border-none 
                        file:px-4 file:py-1 file:mr-6 file:rounded-md hover:file:bg-violet-100 border border-gray-300" 
                        wire:model="newEditAvatar">
                    </div>
                </div>
                
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" wire:click="resetEditFields" />
                    
                        <x-button primary label="Update Employee" wire:click="editEmployee" x-on:click="close"/>
                    </div>
                </div>
            </x-slot>
        </form>
    </x-modal.card>
</div>

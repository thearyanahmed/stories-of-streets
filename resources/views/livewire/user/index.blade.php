@section('title','Users')

<div>
    <h1 class="text-2xl font-semibold text-gray-900">Users</h1>

    <div class="py-4 space-y-4">
        <!-- Top Bar -->
        <div class="md:flex justify-end">
            <div class="w-full md:w-3/6">
                <div class="flex space-x-2" >
                    <x-input.text wire:model="filters.search" fullsizeinput placeholder="Search User..." />
                </div>
            </div>

            <div class="flex justify-end w-full align-middle md:w-3/6">
                <div class="w-auto md:flex md:justify-end">
                    <x-input.group borderless paddingless for="perPage">
                        <x-input.select wire:model="perPage" id="perPage">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </x-input.select>
                    </x-input.group>
                </div>

                <div class="w-auto md:flex md:justify-end ml-2 pt-1 md:pt-0">
                    <x-input.group borderless paddingless for="selectedRole">
                        <x-input.select wire:model="selectedRole" id="selectedRole" class="capitalize">
                            @foreach($availableRoles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>
                </div>
                <div class="w-auto md:flex md:justify-end ml-2 pt-1 md:pt-0">
                    <x-dropdown label="Actions">
                        <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                            <x-icon.download class="text-cool-gray-400"/> <span>Export</span>
                        </x-dropdown.item>

                        <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')" class="flex items-center space-x-2">
                            <x-icon.trash class="text-cool-gray-400"/> <span>Delete</span>
                        </x-dropdown.item>
                    </x-dropdown>
                </div>

            </div>
        </div>

        <!-- users Table -->
        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pr-0 w-8">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null" class="w-full">Name</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('email')" :direction="$sorts['email'] ?? null">Contact</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('role')" :direction="$sorts['role'] ?? null">Role</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('status')" :direction="$sorts['status'] ?? null">Status</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                        <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                            <x-table.cell colspan="6">
                                @unless ($selectAll)
                                    <div>
                                        <span>You have selected <strong>{{ $users->count() }}</strong> users, do you want to select all <strong>{{ $users->total() }}</strong>?</span>
                                        <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select All</x-button.link>
                                    </div>
                                @else
                                    <span>You are currently selecting all <strong>{{ $users->total() }}</strong> users.</span>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @endif

                    @forelse ($users as $user)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $user->id }}">
                            <x-table.cell class="pr-0">
                                <x-input.checkbox wire:model="selected" value="{{ $user->id }}" />
                            </x-table.cell>

                            <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-md">
                                <p class="text-cool-gray-600 truncate self-center">
                                    {{ $user->name }}
                                </p>
                            </span>
                            </x-table.cell>

                            <x-table.cell>
                            <span class="flex flex-col text-cool-gray-900">
                                <span>
                                    {{ $user->email }}
                                </span>
                                <small>{{ $user->phone }}</small>
                            </span>
                            </x-table.cell>

                            <x-table.cell>
                            <span class="text-left px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-{{ $roleColorMap[$user->role] }}-100 text-{{ $roleColorMap[$user->role] }}-800 capitalize">
                                {{ $user->role }}
                            </span>
                            </x-table.cell>

                            <x-table.cell>
                            <span class="text-left px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-{{ $statusColorMap[$user->status] }}-100 text-{{ $statusColorMap[$user->status] }}-800 capitalize">
                                {{ $user->status }}
                            </span>
                            </x-table.cell>
                            <x-table.cell>
                                <x-button.link wire:click="edit({{ $user->id }})">Edit</x-button.link>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="6">
                                <div class="flex justify-center items-center space-x-2">
                                    <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                    <span class="font-medium py-8 text-cool-gray-400 text-xl">No users found...</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Delete users Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete Transaction</x-slot>

            <x-slot name="content">
                <div class="py-8 text-cool-gray-700">Are you sure you? This action is irreversible.</div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.primary>

                    <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>
        </x-modal.confirmation>
    </form>

    <!-- Save Transaction Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Edit User</x-slot>

            <x-slot name="content">
                <x-input.group for="name" label="Name" :error="$errors->first('editing.name')">
                    <x-input.text wire:model.lazy="editing.name" id="name" placeholder="Name" />
                </x-input.group>

                <x-input.group for="email" label="Email" :error="$errors->first('editing.email')">
                    <x-input.email type="email" wire:model.lazy="editing.email" id="email" placeholder="User's email" />
                </x-input.group>

                <x-input.group for="phone" label="Phone" :error="$errors->first('editing.phone')">
                    <x-input.text type="text" wire:model.lazy="editing.phone" id="phone" placeholder="User's phone" />
                </x-input.group>

                <x-input.group for="password" label="Password">
                    <x-input.password disabled id="password" placeholder="You can't see it." />
                </x-input.group>

                <x-input.group for="role" label="Role" :error="$errors->first('editing.role')">
                    <x-input.select wire:model.lazy="editing.role" id="role" class="capitalize">
                        @foreach ($newUserRoles as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>

            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.primary>

                    <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>

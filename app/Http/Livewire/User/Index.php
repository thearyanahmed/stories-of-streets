<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class Index extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

    public bool $showFilters     = false;
    public bool $showEditModal   = false;
    public bool $showDeleteModal = false;

    public array $filters = [
        'search' => null,
        'email'  => null,
        'name'   => null,
        'role'   => null,
        'status' => null,
    ];

    public $statusColorMap = [
        'active'   => 'green',
        'inactive' => 'gray',
        'banned'   => 'red',
    ];

    public $roleColorMap = [
        '1'    => 'red',
        '2' => 'indigo',
        '3' => 'green',
    ];

    public User $editing;

    protected $queryString = ['sorts'];

    public $availableRoles = [];
    public $newUserRoles = [];

    public $selectedRole = null;

    public $newUser = false;

    protected $listeners = ['refreshUsers' => '$refresh'];

    public $rules = [
        'editing.name'  => 'required|max:50|min:2',
        'editing.email' => 'nullable|email|max:50|unique:users,email',
        'editing.phone' => 'required_without:email|max:30|min:6|unique:users,phone' , //regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/
        'editing.role'  => 'required|in:' . User::CONTRIBUTOR . ',' . User::EDITOR,
    ];

    public function mount() {
        $this->editing = $this->makeBlankUser();

        $this->editing['device_id'] = unique_device_id();

        $this->availableRoles = ['all',User::CONTRIBUTOR,User::EDITOR,User::ADMIN];
        $this->selectedRole = 'all';

        $this->newUserRoles = [User::CONTRIBUTOR,User::EDITOR];
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'users.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->notify('You\'ve deleted '.$deleteCount.' users');
    }

    public function makeBlankUser()
    {
        return User::make();
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = ! $this->showFilters;
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankUser();

        $this->showEditModal = true;
        $this->newUser = true;
    }

    public function edit(User $user)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($user)) $this->editing = $user;

        $this->rules['editing.phone'] = 'required_without:email|max:30|min:6|unique:users,phone,' . $user->id;
        $this->rules['editing.email'] = 'nullable|email|max:50|unique:users,email,' . $user->id;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();
        $this->notify($this->editing->name . "'s information updated.");
        $this->editing = $this->makeBlankUser();

        $this->showEditModal = false;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        $query = User::query()
            ->when($this->filters['name'], fn($query, $name) => $query->where('name', '=',$name))
            ->when($this->filters['status'], fn($query, $status) => $query->where('status', $status))
            ->when($this->filters['role'], fn($query, $role) => $query->where('role', '=', $role))
            ->when($this->filters['email'], fn($query, $email) => $query->where('email', '=', $email))
            ->when($this->filters['search'], fn($query, $search) => $query->where('name', 'like', '%'.$search.'%')->orWhere('email','like','%' . $search .'%'));

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function updatedSelectedRole($value)
    {
        if($value == 'all') {
            $this->filters['role'] = null;
            return;
        }

        $this->filters['role'] = $value;
    }

    public function render()
    {
        return view('livewire.user.index', [
            'users' => $this->rows,
        ]);
    }
}

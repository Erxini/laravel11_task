<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskComponent extends Component
{
    public $tasks = [];
    public $title;
    public $description;
    public $modal = false;

    public function mount()
    {
        $this->tasks = $this->getTask();
    }
    public function getTask()
    {
        return Task::where('user_id', Auth::user()->id)->get();
    }


    public function render()
    {
        return view('livewire.task-component');
    }

    private function clearFields()
    {
        $this->title = '';
        $this->description = '';
    }

    public function openCreateModal()
    {
        $this->clearFields();
        $this->modal = true;
    }

    public function closeCreateModal()
    {
        $this->modal = false;
    }

    public function createTask()
    {

        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $task = new Task();
        $task->title = $this->title;
        $task->description = $this->description;
        $task->user_id = Auth::user()->id;
        $task->save();
        $this->clearFields();
        $this->closeCreateModal();
        $this->tasks = $this->getTask();
    }
}

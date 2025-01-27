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
    public $task_id;
    public $task;
    public $user_id;
    public $user;
    public $id;
    public $miTarea;
    public $isUpdating = false;

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
        $this->isUpdating = false;
    }

    // public function openCreateModal()
    // {
    //     $this->clearFields();
    //     $this->modal = true;
    // }
    public function openCreateModal($taskId = null)
    {
        $this->clearFields();
        // Si se pasa un ID, cargar los datos de la tarea para edición
        if ($taskId) {
            $task = Task::find($taskId);
            if ($task) {
                $this->isUpdating = $taskId ? true : false;
                $this->task_id = $task->id;
                $this->title = $task->title;
                $this->description = $task->description;
            }
        }
        $this->modal = true;
    }
    public function closeCreateModal()
    {
        $this->modal = false;
    }

    // public function createTask()
    // {
    //     $this->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string|max:1000',
    //     ]);

    //     $task = new Task();
    //     $task->title = $this->title;
    //     $task->description = $this->description;
    //     $task->user_id = Auth::user()->id;
    //     $task->save();
    //     $this->clearFields();
    //     $this->closeCreateModal();
    //     $this->tasks = $this->getTask();
    // }

    // public function updateTask(Task $task)
    // {
    //     $this->title = $task->title;
    //     $this->description = $task->description;
    //     $this->modal = true;
    // }
    public function createorUpdateTask()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);
        // Verificamos si ya existe una tarea seleccionada (editar)
        if ($this->task_id) {
            $task = Task::find($this->task_id);
            if ($task) {
                $task->update([
                    'title' => $this->title,
                    'description' => $this->description,
                ]);
            }
        } else {
            Task::create([
                'title' => $this->title,
                'description' => $this->description,
                'user_id' => Auth::user()->id,
            ]);
        }
        $this->clearFields();
        $this->closeCreateModal();
        // Actualizar la lista de tareas
        $this->tasks = $this->getTask();
    }
    public function deleteTask(Task $task)
    {
        $task->delete();
        $this->tasks = $this->getTask()->sortByDesc('id');
    }
}

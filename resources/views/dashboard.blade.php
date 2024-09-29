@extends('layouts.app')

@section('title', 'To-Do List')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Заголовок To-Do List -->
            <div class="text-center mb-4">
                <h2 class="font-weight-bold">To-Do List</h2>
                <p class="text-muted">Manage your tasks efficiently</p>
            </div>

            <!-- Список задач -->
            <div id="task-list" class="mb-4">
                <!-- Tasks will be dynamically loaded here -->
            </div>

            <!-- Добавление новой задачи -->
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white text-center">
                    <h3 class="mb-0">Add New Task</h3>
                </div>
                <div class="card-body">
                    <form id="task-form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Task Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter task title" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Task Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Enter task description (optional)"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success btn-block font-weight-bold" style="border-radius: 50px;">
                            <i class="fas fa-plus"></i> Add Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="task-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Task</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="task-edit-form">
                        <input type="hidden" id="edit-task-id" name="task_id" value="">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="edit-description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="is_completed">Is Completed</label>
                            <select class="form-control" id="edit-is_completed" name="is_completed">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>typeof loadTasks === 'function' ? loadTasks() : null</script>
@endsection

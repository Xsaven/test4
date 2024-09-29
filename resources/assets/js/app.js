require('./bootstrap');

window.loadTasks = () => {
    $.get(window.routes['tasks.index'], function (tasks) {
        $('#task-list').empty();
        tasks.forEach(function (task) {
            let createdAt = new Date(task.created_at).toLocaleDateString('en-GB', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });

            let taskCard = `
                <div class="card task-card mt-3 shadow-sm ${task.is_completed ? 'bg-success text-white' : ''}" style="border-radius: 12px;">
                    <div class="card-body d-flex justify-content-between align-items-center" data-id="${task.id}" data-completed="${task.is_completed}">
                        <div class="task-info">
                            <h5 class="card-title font-weight-bold ${task.is_completed ? 'text-white' : 'text-dark'}">${task.title}</h5>
                            <p class="card-text ${task.is_completed ? 'text-light' : 'text-muted'}">${task.description || 'No description provided'}</p>
                            <small class="text-muted ${task.is_completed ? 'text-white-50' : ''}">Created on: ${createdAt}</small>
                        </div>
                        <div class="task-actions">
                            <button class="btn btn-sm btn-outline-danger delete-task mr-2" style="border-radius: 50%;">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-primary edit-task" style="border-radius: 50%;">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            $('#task-list').append(taskCard);
        });
    });
}


$(document).on('click', '.edit-task', function() {
    const row = $(this).closest('.card-body');
    const taskId = row.data('id');
    const completed = row.data('completed');
    const title = row.find('h5').text();
    const description = row.find('p').text();

    $('#task-modal').modal('show');
    $('#edit-task-id').val(taskId);
    $('#edit-title').val(title);
    if (description !== 'No description provided') {
        $('#edit-description').val(description);
    }
    $('#edit-is_completed').val(completed ? 1 : 0);
});

$(document).on('click', '.delete-task', function() {
    const row = $(this).closest('.card-body');
    const taskId = row.data('id');

    if (confirm('Are you sure you want to delete this task?')) {
        $.ajax({
            url: `/tasks/${taskId}`,
            method: 'DELETE',
            data: {
                _token: $('input[name="_token"]').val(),
            },
            success: function(response) {
                window.loadTasks();
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    }
});

$(document).on('submit', '#register-form', function (event) {
    event.preventDefault();

    $.ajax({
        url: window.routes.register,
        method: 'POST',
        data: {
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val()
        },
        success: function () {
            window.location = window.routes.dashboard;
        },
        error: function () {
            alert('Registration failed');
        }
    });
});
$(document).on('submit', '#task-form', function (event) {
    event.preventDefault();

    $.ajax({
        url: window.routes['tasks.store'],
        method: 'POST',
        data: {
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            title: $('#title').val(),
            description: $('#description').val(),
        },
        success: function () {
            loadTasks();
            $('#title').val('');
            $('#description').val('');
        },
        error: function () {
            alert('Failed to add task');
        }
    });
});
$(document).on('submit', '#login-form', function (event) {
    event.preventDefault();

    $.ajax({
        url: window.routes.login,
        method: 'POST',
        data: {
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            email: $('#email').val(),
            password: $('#password').val(),
        },
        success: function () {
            window.location.href = window.routes.dashboard;
        },
        error: function () {
            alert('Invalid credentials');
        }
    });
});

$(document).on('submit', '#task-edit-form', function (event) {
    event.preventDefault();
    const taskId = $('#edit-task-id').val();
    $('#task-modal').modal('hide');
    $.ajax({
        url: window.routes['tasks.update'].replace(':task', taskId),
        method: 'PUT',
        data: {
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            title: $('#edit-title').val(),
            description: $('#edit-description').val(),
            is_completed: $('#edit-is_completed').val(),
        },
        success: function(response) {
            loadTasks();
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseJSON.message);
        }
    });
});

loadTasks();

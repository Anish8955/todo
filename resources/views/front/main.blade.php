<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TO DO - Main</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: black;
      color: white;
      padding: 10px 20px;
    }

    .navbar .brand {
      font-size: 24px;
      font-weight: bold;
    }

    .navbar .buttons button {
      margin-left: 30px;
      padding: 8px 15px;
      font-size: 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      color: white;
    }

    .navbar .buttons .add-category {
      background-color: #28a745;
    }

    .navbar .buttons .add-task {
      background-color: #ffc107;
    }

    .navbar .buttons .logout {
      background-color: #dc3545;
    }

    .navbar .user-info {
      color: white;
      font-size: 16px;
      font-weight: bold;
      margin-right: 20px;
    }

    .navbar .buttons button:hover {
      opacity: 0.5;
    }

    .modal-body form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .modal-body input[type="text"],
    .modal-body input[type="date"],
    .modal-body select {
      width: 100%;
      padding: 10px;
      margin: 5px 0;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 1rem;
    }

    .modal-body input[type="checkbox"] {
      margin-right: 10px;
    }

    .modal-body label {
      margin-left: 5px;
      font-weight: 500;
      font-size: 0.9rem;
    }

    .modal-footer button {
      padding: 10px 20px;
      font-size: 1rem;
      border: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .modal-footer .btn-secondary {
      background-color: #6c757d;
      color: white;
    }

    .modal-footer .btn-secondary:hover {
      background-color: #5a6268;
    }

    .modal-footer .btn-primary {
      background-color: #007bff;
      color: white;
    }

    .modal-footer .btn-primary:hover {
      background-color: #0056b3;
    }

    .card-header {
      background-color: #007bff;
      color: white;
      font-weight: bold;
    }

    .category-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      padding: 20px;
    }

    .category-card {
      background-color: #f8f9fa;
      border: 1px solid #ddd;
      border-radius: 5px;
      width: calc(33.333% - 20px);
      padding: 10px;
    }

    .task-card {
      background-color: #e9ecef;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      margin-top: 10px;
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar">
    <div class="brand">TO DO</div>
    <div class="buttons">
      <span class="user-info">Welcome {{ Auth::user()->name }}</span>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcategory"
        class="add-category" href="#">Add Category</button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addtask" class="add-task"
        href="#">Add Task</button>
      @auth
      <form action="{{ route('logout') }}" method="POST" style="display: inline;">
      @csrf
      <button type="submit" class="btn btn-danger logout">Logout</button>
      </form>
    @endauth
    </div>
  </nav>

  <div class="category-container">

    @foreach($categories as $category)

    <div class="category-card">
      <h5 class="card-header">{{ $category->name }}</h5>
      <div class="card-body">
      @foreach($category->tasks as $task)
      <div class="task-card">
      <p><strong>Title:</strong> {{ $task->title }}</p>
      <p><strong>Description:</strong> {{ $task->description }}</p>
      <p><strong>Due Date:</strong> {{ $task->due_date }}</p>
      <p><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p>
      <button type="button" class="btn btn-primary edit-task" data-bs-toggle="modal" data-bs-target="#edittask"
      data-task='@json($task)'>Edit Task</button>
      <form action="{{ route('deletetask', $task->id) }}" method="POST" style="display:inline-block;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete Task</button>
      </form>
      </div>
    @endforeach
    <form action="{{ route('deletecategory', $category->id) }}" method="POST" style="display:inline-block;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete categories</button>
      </form>
      </div>
    </div>
  @endforeach
  </div>

  <div class="modal fade" id="addcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('addcategory')}}" method="post">
            @csrf
            <input type="text" name="name" placeholder="Enter Category Here.." required>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addtask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('addtask')}}" method="post">
            @csrf
            <input type="text" name="title" placeholder="Enter title Here.." required>
            <input type="text" name="description" placeholder="Enter description Here.." required>
            <select name="categoryid" required>
              <option value="" disabled selected>Select Category</option>
              @foreach($totalCategory as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
            </select>
            <select name="priority" required>
              <option value="" disabled selected>Select Priority</option>
              <option value="low">Low</option>
              <option value="medium">Medium</option>
              <option value="high">High</option>
            </select>
            <div>
              <input type="date" name="duedate" required>
              <label for="due_date"> Due Date</label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="edittask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('updatetask', '') }}" method="post" id="editTaskForm">
            @csrf
            <input type="text" name="title" id="editTitle" placeholder="Enter title Here.." required>
            <input type="text" name="description" id="editDescription" placeholder="Enter description Here.." required>
            <select name="categoryid" id="editCategory" required>
              <option value="" disabled selected>Select Category</option>
              @foreach($totalCategory as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
            </select>
            <select name="priority" id="editPriority" required>
              <option value="" disabled selected>Select Priority</option>
              <option value="low">Low</option>
              <option value="medium">Medium</option>
              <option value="high">High</option>
            </select>
            <div>
              <input type="date" name="due_date" id="editDueDate" required>
              <label for="due_date"> Due Date</label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.querySelectorAll('.edit-task').forEach(button => {
      button.addEventListener('click', function () {
        const task = JSON.parse(this.getAttribute('data-task'));
        const form = document.getElementById('editTaskForm');
        form.action = `/tasks/${task.id}/update`; // Set the form action dynamically
        document.getElementById('editTitle').value = task.title;
        document.getElementById('editDescription').value = task.description;
        document.getElementById('editCategory').value = task.category_id;
        document.getElementById('editPriority').value = task.priority;
        const formattedDate = task.due_date.split('T')[0];
        document.getElementById('editDueDate').value = formattedDate;
      });
    });

  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
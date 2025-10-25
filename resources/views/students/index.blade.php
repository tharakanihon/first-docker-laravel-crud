
<!DOCTYPE html>
<html>
<head>

    <title>Students List</title>



<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>

    body {
        font-family: 'Poppins', sans-serif;
        background: #f4f6f8;
        color: #333;
        margin: 0;
        padding: 20px;
    }
    h1 {
        color: #2c3e50;
        text-align: center;
        margin-bottom: 20px;
    }
    a {
        text-decoration: none;
        color: #3498db;
        font-weight: 600;
    }
    a:hover {
        color: #1a5276;
    }
    table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 12px 15px;
        text-align: center;
    }
    th {
        background-color: #3498db;
        color: white;
        text-transform: uppercase;
    }
    tr:nth-child(even) {
        background-color: #ecf0f1;
    }
    tr:hover {
        background-color: #d6eaf8;
    }
    .add-btn {
        display: inline-block;
        background: #2ecc71;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        font-weight: 600;
        margin-bottom: 15px;
        margin-left: 148px;
        transition: 0.3s;
    }
    .add-btn:hover {
        background: #27ae60;
    }
    .action-btn {
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        color: white;
    }
    .edit-btn {
        background: #f1c40f;
    }
    .edit-btn:hover {
        background: #d4ac0d;
    }
    .delete-btn {
        background: #e74c3c;
    }
    .delete-btn:hover {
        background: #c0392b;
    }


</style>


</head>
<body>




    <h1>Students</h1>
    <button onclick="openCreateForm()" class="add-btn">
    <i class="fas fa-user-plus"></i> Add Student
</button>



    @if (session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            toast: true,
            position: 'center',
            background: '#f0fff0',
            color: '#27ae60'
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        Swal.fire({
            title: 'Error!',
            text: "{{ session('error') }}",
            icon: 'error',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            toast: true,
            position: 'center',
            background: '#fff0f0',
            color: '#c0392b'
        });
    </script>
    @endif





    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th>
        </tr>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            <td>
            <!-- inside table actions -->
            <a href="{{ route('students.edit', $student->id) }}" class="action-btn edit-btn"
            
            
                data-id="{{ $student->id }}" 
                data-name="{{ $student->name }}" 
                data-email="{{ $student->email }}" 
                data-phone="{{ $student->phone }}">
            
                <i class="fa fa-pen"></i> Edit 
            </a>&nbsp; &nbsp;




            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure?')">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>





    <script>
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();

        let id = this.dataset.id;
        let name = this.dataset.name;
        let email = this.dataset.email;
        let phone = this.dataset.phone;

        Swal.fire({
            title: 'Edit Student',
            html: `
                <form id="updateForm" action="/students/${id}" method="POST">
                    @csrf
                    @method('PUT')
                    <label>Name</label>
                    <input type="text" id="name" name="name" value="${name}" class="swal2-input">
                    <label>Email</label>
                    <input type="email" id="email" name="email" value="${email}" class="swal2-input">
                    <label>Phone</label>
                    <input type="text" id="phone" name="phone" value="${phone}" class="swal2-input">
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel',
            focusConfirm: false,
            preConfirm: () => {
                return {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit via fetch
                fetch(`/students/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: 'PUT',
                        name: result.value.name,
                        email: result.value.email,
                        phone: result.value.phone
                    })
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire('Updated!', 'Student updated successfully.', 'success')
                        .then(() => location.reload());
                })
                .catch(error => {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                });
            }
        });
    });
});
</script>



<script>
function openCreateForm() {
    Swal.fire({
        title: 'Add New Student',
        html: `
            <form id="createStudentForm" method="POST" action="{{ route('students.store') }}">
                @csrf
                <label>Name:</label>
                <input type="text" name="name" class="swal2-input" placeholder="Enter name">
                <label>Email:</label>
                <input type="email" name="email" class="swal2-input" placeholder="Enter email">
                <label>Phone:</label>
                <input type="text" name="phone" class="swal2-input" placeholder="Enter phone">
            </form>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Save',
        confirmButtonColor: '#27ae60',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
            document.getElementById('createStudentForm').submit();
        }
    });
}
</script>


</body>
</html>

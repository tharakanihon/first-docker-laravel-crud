<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Modern CSS -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .form-container {
        background: #fff;
        padding: 40px 50px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        width: 400px;
    }
    h1 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 25px;
    }
    label {
        font-weight: 600;
        color: #34495e;
        display: block;
        margin-bottom: 5px;
    }
    input {
        width: 100%;
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 6px;
        margin-bottom: 15px;
        transition: 0.3s;
    }
    input:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 5px rgba(52,152,219,0.5);
    }
    .update-btn {
        width: 100%;
        background: #27ae60;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }
    .update-btn:hover {
        background: #1e8449;
    }
</style>

<div class="form-container">
    <h1><i class="fa fa-user-pen"></i> Edit Student</h1>
    <form id="editForm" action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $student->name }}" required>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $student->email }}" required>

        <label>Phone:</label>
        <input type="text" name="phone" value="{{ $student->phone }}" required>

        <button type="submit" class="update-btn"><i class="fa fa-save"></i> Update</button>
    </form>
</div>

<script>
    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Confirm Update?',
            text: "Do you want to save these changes?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#27ae60',
            cancelButtonColor: '#e74c3c',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>


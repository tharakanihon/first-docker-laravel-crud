<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>
    <h1>Add Student</h1>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name"><br><br>
        <label>Email:</label>
        <input type="email" name="email"><br><br>
        <label>Phone:</label>
        <input type="text" name="phone"><br><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>

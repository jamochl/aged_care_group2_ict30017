<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Staff Info</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Create Employee Information</h1>
    <form action="process-employee.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="password">Password:</label><br>
        <input type="text" id="password" name="password"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="role">Role:</label><br>
        <input type="text" id="role" name="role"><br>
        <label for="phone">Phone Number:</label><br>
        <input type="text" id="phone" name="phone"><br>
        <label for="nationality">Nationality:</label><br>
        <input type="text" id="nationality" name="nationality"><br>
        <label for="birthDate">Birth Date:</label><br>
        <input type="date" id="birthDate" name="birthDate"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>


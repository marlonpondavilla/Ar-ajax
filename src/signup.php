<?php
  include_once "./database/dbh.php";
  $dbh = new Dbh();

  $error = $_GET['error'] ?? '';
  $fullName = $_GET['fullname'] ?? '';
  $email = $_GET['email'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen bg-[url(./images/map.png)] bg-cover">

  <div class="bg-orange-100 p-8 rounded-lg shadow-md w-full max-w-md border-2 border-orange-500">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Sign Up</h2>
    
    <form action="./server/signup.server.php" method="post" class="space-y-5">
      <div>
        <label for="fullName" class="block mb-1 text-sm font-medium text-gray-700">Full Name</label>
        <input 
          type="text" id="fullName" name="fullName" 
          required
          value="<?php echo $fullName; ?>"
          class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      
      <div>
        <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
        <input 
          type="email" id="email" name="email" 
          required
          value="<?php echo $email; ?>"
          class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo $error === 'emailalreadyexist' ? 'border border-red-500 bg-red-100' : '' ?>" />
        <p class="text-sm text-red-500 mt-2 <?php echo $error === 'emailalreadyexist' ? 'block' : 'hidden' ?>">this email already exist.</p>
      </div>
      
      <div>
        <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
        <input 
          type="password" id="password" name="password" required
          class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo $error === 'passwordnotmatch' ? 'border border-red-500 bg-red-100' : '' ?>" />
      </div>

      <div>
        <label for="confirm-password" class="block mb-1 text-sm font-medium text-gray-700">Confirm Password</label>
        <input 
          type="password" id="confirmPassword" name="confirmPassword" required
          class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo $error === 'passwordnotmatch' ? 'border border-red-500 bg-red-100' : '' ?>" />
          <p class="text-sm mt-2 text-red-500 <?php echo $error === 'passwordnotmatch' ? 'block' : 'hidden' ?>">passwords do not match</p>
      </div>
      
      <button 
        type="submit"
        name="signup"
        class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition duration-300"
      >
        Sign Up
      </button>
    </form>

    <p class="mt-4 text-sm text-center text-gray-600">
      Already have an account? <a href="../index.php" class="text-blue-600 hover:underline">Login</a>
    </p>
  </div>

</body>
</html>

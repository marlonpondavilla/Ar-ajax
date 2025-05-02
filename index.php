<?php
  $error = $_GET['error'] ?? '';
  $email = $_GET['email'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JornHub</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-[url(./src/images/flight.png)] bg-cover">

  <div class="p-16 rounded-lg shadow-md w-full max-w-md border-2 border-orange-500">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">
      Login to <span class="text-orange-500">Jorn</span>Hub
    </h2>
    
    <p class="text-center my-2 text-red-500 font-semibold <?php echo $error === 'wrongcredentials' ? 'block' : 'hidden' ?>">Username or password is incorrect</p>
    
    <form action="./src//server/login.server.php" method="POST" class="space-y-5">
      <div>
        <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
        <input 
          type="email" id="email" name="email" 
          required
          value="<?php echo $email; ?>"
          class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo $error === 'wrongcredentials' ? 'border border-red-500 bg-red-100' : '' ?>" />
      </div>
      
      <div>
        <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
        <input 
          type="password" id="password" name="password" required
          class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo $error === 'wrongcredentials' ? 'border border-red-500 bg-red-100' : '' ?>" />
      </div>
      
      <button 
        type="submit"
        name="login"
        class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-300">
        Login
      </button>
      <button 
        type="button"
        onclick="window.location.href='./src/signup.php'"
        class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition duration-300">
        Sign Up
      </button>
    </form>
  </div>

</body>
</html>

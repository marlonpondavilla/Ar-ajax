<?php include_once "../database/dbh.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Home</title>
</head>
<body>

  <!-- Include Header -->
  <?php include_once "./header.ui.php"; ?>

  <h1 class="text-center text-3xl mt-6 font-bold">CRUD Table</h1>

  <!-- CRUD Table and Form -->
  <div class="max-w-2xl mx-auto mt-10">
    <div class="mb-4">
      <input id="name" type="text" placeholder="Enter name" class="border p-2 w-2/3 rounded">
      <button onclick="addRecord()" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Add</button>
    </div>

    <table class="w-full table-auto border-collapse">
      <thead>
        <tr class="bg-gray-200">
          <th class="border px-4 py-2">ID</th>
          <th class="border px-4 py-2">Name</th>
          <th class="border px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody id="crudTable" class="text-center">
        <!-- Data will be loaded here via AJAX -->
      </tbody>
    </table>
  </div>

  <!-- jQuery + Script -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script>
    $(document).ready(function() {
      fetchRecords();
    });

    function fetchRecords() {
      $.get("../crud/fetch.php", function(data) {
          $("#crudTable").html(data);
      });
    }

    function addRecord() {
      const name = $("#name").val().trim();
      if (!name) return alert("Name is required");

      $.post("../crud/insert.php", { name: name }, function() {
          fetchRecords();
          $("#name").val("");  // Clear input after insert
      }).fail(function(xhr, status, error) {
          console.log("Error:", status, error);
      });
    }

    function deleteRecord(id) {
      if (confirm("Are you sure you want to delete this record?")) {
          $.post("../crud/delete.php", { id: id }, function() {
              fetchRecords();
          }).fail(function(xhr, status, error) {
              console.log("Error:", status, error);
          });
      }
    }

    function updateRecord(id, currentName) {
      const newName = prompt("Enter new name:", currentName);
      if (newName && newName !== currentName) {
          $.post("../crud/update.php", { id: id, name: newName }, function() {
              fetchRecords();
          }).fail(function(xhr, status, error) {
              console.log("Error:", status, error);
          });
      }
    }
  </script>
</body>
</html>

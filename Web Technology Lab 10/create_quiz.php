<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', 'root', 'addtocart');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Process quiz creation form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $description = $_POST['description'];

  // Insert quiz into Quizzes table with auto-generated id
  $sql = "INSERT INTO quizzes (title, description, created_at) VALUES ('$title', '$description', NOW())";
  if (mysqli_query($conn, $sql)) {
    $quizId = mysqli_insert_id($conn);

    // Insert questions and choices into Questions and Choices tables
    foreach ($_POST['question'] as $index => $question) {
      $choices = $_POST['choice'][$index];
      $correctChoice = $_POST['correct_choice'][$index];

      // Insert question into Questions table with auto-generated id
      $sql = "INSERT INTO questions (quiz_id, question, created_at) VALUES ('$quizId', '$question', NOW())";
      if (mysqli_query($conn, $sql)) {
        $questionId = mysqli_insert_id($conn);

        // Insert choices into Choices table with auto-generated id
        foreach ($choices as $choiceIndex => $choice) {
          $isCorrect = ($choiceIndex + 1) == $correctChoice ? 1 : 0;
          $sql = "INSERT INTO choices (question_id, choice, is_correct, created_at) VALUES ('$questionId', '$choice', '$isCorrect', NOW())";
          mysqli_query($conn, $sql);
        }
      }
    }

    echo "Quiz created successfully!";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>

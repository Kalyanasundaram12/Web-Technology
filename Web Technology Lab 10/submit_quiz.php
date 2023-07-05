<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', 'root', 'addtocart');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Process quiz submission form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get current user ID (assuming it's stored in a session variable)
  $userId = $_SESSION['user_id'];

  // Validate quiz submission
  $responses = $_POST['response'];
  $valid = true;
  foreach ($responses as $questionId => $choiceId) {
    if (empty($choiceId)) {
      $valid = false;
      break;
    }
  }

  if ($valid) {
    // Calculate the score and store user responses
    $score = 0;

    foreach ($responses as $questionId => $choiceId) {
      $sql = "SELECT is_correct FROM choices WHERE id = '$choiceId' LIMIT 1";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      $isCorrect = $row['is_correct'];
      $score += $isCorrect;

      // Insert user responses with auto-generated id
      $insertSql = "INSERT INTO user_responses (user_id, question_id, choice_id, created_at) VALUES ('$userId', '$questionId', '$choiceId', NOW())";
      mysqli_query($conn, $insertSql);
      $responseId = mysqli_insert_id($conn); // Get the auto-generated id
    }

    echo "Quiz submitted successfully! Your score: $score";
  } else {
    echo "Please answer all questions before submitting.";
  }
}

mysqli_close($conn);
?>

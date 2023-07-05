<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', 'root', 'addtocart');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Process quiz selection form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $quizId = $_POST['quiz'];

  // Retrieve questions for the selected quiz
  $sql = "SELECT * FROM Questions WHERE quiz_id = '$quizId'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // Display questions and choices
    $questionIndex = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      $questionId = $row['id'];
      $question = $row['question'];

      // Retrieve choices for the current question
      $choicesSql = "SELECT * FROM choices WHERE question_id = '$questionId'";
      $choicesResult = mysqli_query($conn, $choicesSql);

      echo "<h3>$question</h3>";

      // Display choices
      while ($choicesRow = mysqli_fetch_assoc($choicesResult)) {
        $choiceId = $choicesRow['id'];
        $choice = $choicesRow['choice'];

        echo "<label><input type='radio' name='response[$questionId]' value='$choiceId'> $choice</label><br>";
      }

      $questionIndex++;
    }

    echo "<input type='submit' value='Submit Quiz'>";
  } else {
    echo "No questions found for the selected quiz.";
  }
}

mysqli_close($conn);
?>

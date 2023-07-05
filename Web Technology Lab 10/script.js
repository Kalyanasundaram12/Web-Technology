
        function addQuestion() {
            var questionsContainer = document.getElementById("questions");

            var questionDiv = document.createElement("div");
            questionDiv.className = "question";

            var questionLabel = document.createElement("label");
            questionLabel.textContent = "Question:";
            var questionInput = document.createElement("input");
            questionInput.type = "text";
            questionInput.name = "question[]";
            questionInput.required = true;

            var choiceLabels = [];
            var choiceInputs = [];

            for (var i = 1; i <= 4; i++) {
                var choiceLabel = document.createElement("label");
                choiceLabel.textContent = "Choice " + i + ":";
                var choiceInput = document.createElement("input");
                choiceInput.type = "text";
                choiceInput.name = "choice[][ " + i + "]";
                choiceInput.required = true;

                choiceLabels.push(choiceLabel);
                choiceInputs.push(choiceInput);
            }

            var correctChoiceLabel = document.createElement("label");
            correctChoiceLabel.textContent = "Correct Choice:";
            var correctChoiceSelect = document.createElement("select");
            correctChoiceSelect.name = "correct_choice[]";

            for (var j = 1; j <= 4; j++) {
                var option = document.createElement("option");
                option.value = j;
                option.textContent = "Choice " + j;
                correctChoiceSelect.appendChild(option);
            }

            questionDiv.appendChild(questionLabel);
            questionDiv.appendChild(questionInput);

            for (var k = 0; k < choiceLabels.length; k++) {
                questionDiv.appendChild(choiceLabels[k]);
                questionDiv.appendChild(choiceInputs[k]);
            }

            questionDiv.appendChild(correctChoiceLabel);
            questionDiv.appendChild(correctChoiceSelect);

            questionsContainer.appendChild(questionDiv);
        }

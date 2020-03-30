function validateSubject(subject) {
    var regex = /^(?=.{2,50}$)[a-zA-Z]+(?:[-' ][a-zA-Z]+)*$/;
    return regex.test(String(subject).toLowerCase());
}
function validateQuestion(question) {
    var regex = /^(?=.{2,2000}$)[a-zA-Z]+(?:[-' ][a-zA-Z]+)*$/;
    return regex.test(String(question).toLowerCase())
}
function validateDateTime() {
    Date.prototype.addDays = function(days) {
        var date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
    }

    var fistPossibleDate = new Date().addDays(5).toISOString().split('T')[0];
    document.getElementById("meetingTime").setAttribute('min',fistPossibleDate)
    document.getElementById("meetingTime").setAttribute('value',fistPossibleDate)
}

function subjectValidation() {
    var subject = document.getElementById("subject")
    subject.addEventListener('input', subjectValidation);
    if (subject.value == '') {
        console.log("empty");
        subject.classList.remove("valid");
        subject.classList.remove("invalid");
        subject.classList.add("empty");
        subject.style.border = "0.1rem solid #d1d1d1";
        subject.style.border = "0.1rem solid #d1d1d1";
    }
    // Valid First Name
    else if (validateSubject(subject.value))
    {
        console.log("valid");
        subject.classList.remove("invalid");
        subject.classList.remove("empty");
        subject.classList.add("valid");
        subject.style.border = "0.1rem solid #038A1E;"
        subject.style.color = "#038A1E;"
    }
    // Invalid First name
    else
    {
        console.log("invalid");
        subject.classList.remove("valid");
        subject.classList.remove("empty");
        subject.classList.add("invalid");
        subject.style.border = "0.1rem solid #8A031E !important"
        subject.style.color = "#8A031E; !important"
    }
}
function questionValidation() {
    var question = document.getElementById("question")
    question.addEventListener('input',questionValidation)
    if (question.value == '') {
        console.log("empty");
        question.classList.remove("valid");
        question.classList.remove("invalid");
        question.classList.add("empty");
        question.style.border = "0.1rem solid #d1d1d1";
        question.style.border = "0.1rem solid #d1d1d1";
    }
    // Valid last Name
    else if (validateQuestion(question.value))
    {
        console.log("valid");
        question.classList.remove("invalid");
        question.classList.remove("empty");
        question.classList.add("valid");
        question.style.border = "0.1rem solid #038A1E;"
        question.style.color = "#038A1E;"
    }
    // Invalid Last name
    else
    {
        console.log("invalid");
        question.classList.remove("valid");
        question.classList.remove("empty");
        question.classList.add("invalid");
        question.style.border = "0.1rem solid #8A031E !important"
        question.style.color = "#8A031E; !important"
    }

}
function dateTimeValidation() {
    var datetime = document.getElementById("meetingTime")
    datetime.addEventListener("input", validateDateTime(datetime))
}
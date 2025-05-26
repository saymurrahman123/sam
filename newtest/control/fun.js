function validateForm() {
    document.querySelectorAll(".error-msg").forEach(span => span.innerHTML = "");
  
    const username = document.getElementById("username").value.trim();
    const email = document.getElementById("email").value.trim();
    const dob = document.getElementById("dob").value;
    const genderMale = document.getElementById("male").checked;
    const genderFemale = document.getElementById("female").checked;
    const password = document.getElementById("password").value;
    const repassword = document.getElementById("repassword").value;
  
    if (username === "") {
        document.getElementById("username-error").innerHTML = "Required";
        return false;
    }
  
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!emailPattern.test(email)) {
        document.getElementById("email-error").innerHTML = "Invalid Email";
        return false;
    }
  
    if (dob === "") {
        document.getElementById("dob-error").innerHTML = "Required";
        return false;
    }
  
    if (!genderMale && !genderFemale) {
        document.getElementById("gender-error").innerHTML = "Select gender";
        return false;
    }
  
    if (password === "" || repassword === "") {
        document.getElementById("password-error").innerHTML = "Required";
        document.getElementById("repassword-error").innerHTML = "Required";
        return false;
    }
  
    if (password !== repassword) {
        document.getElementById("repassword-error").innerHTML = "Passwords do not match";
        return false;
    }
  
    window.location.href = "submitted.html";
    return false;
  }
  
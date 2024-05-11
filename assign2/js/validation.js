// File name: validation.js
// Author: Peiwen Liu
// The validation form for the signup page 

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("signupForm");
    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the form from submitting
        
        // Clear previous error messages
        clearErrors();

        // Validate fields
        const nameValid = validateName();
        const emailValid = validateEmail();
        const employeeIdValid = validateEmployeeId();
        const passwordValid = validatePassword();
        const password2Valid = validatePassword2();

        // Submit form if all validations pass
        if (nameValid && emailValid && employeeIdValid && passwordValid && password2Valid) {
            form.submit();
        }
    });

    // Adding event listeners to clear error messages
    document.getElementById("name").addEventListener("input", validateName);
    document.getElementById("email").addEventListener("input", validateEmail);
    document.getElementById("employeeId").addEventListener("input", validateEmployeeId);
    document.getElementById("password").addEventListener("input", validatePassword);
    document.getElementById("password2").addEventListener("input", validatePassword2);
});

// Function to validate the name input field
function validateName() {
    const name = document.getElementById("name");
    const errorDiv = createErrorDiv("nameError");
    name.parentNode.insertBefore(errorDiv, name.nextSibling);
    
    if (name.value.trim() === "") {
        displayError("nameError", "Please enter your name.");
        return false;
    } else {
        clearError("nameError");
        return true;
    }
}

// Function to validate the email input field
function validateEmail() {
    const email = document.getElementById("email");
    const errorDiv = createErrorDiv("emailError");
    email.parentNode.insertBefore(errorDiv, email.nextSibling);
    
    const emailRegex = /\S+@\S+\.\S+/;
    if (!emailRegex.test(email.value)) {
        displayError("emailError", "Please enter a valid email address. e.g xyz@xyz.xyz");
        return false;
    } else {
        clearError("emailError");
        return true;
    }
}

// Function to validate the employee ID input field
function validateEmployeeId() {
    const employeeId = document.getElementById("employeeId");
    const errorDiv = createErrorDiv("employeeIdError");
    employeeId.parentNode.insertBefore(errorDiv, employeeId.nextSibling);
    
    if (employeeId.value.trim() === "") {
        displayError("employeeIdError", "Please enter your employee ID.");
        return false;
    } else {
        clearError("employeeIdError");
        return true;
    }
}

// Function to validate the password input field
function validatePassword() {
    const password = document.getElementById("password");
    const errorDiv = createErrorDiv("passwordError");
    password.parentNode.insertBefore(errorDiv, password.nextSibling);
    
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    if (!passwordRegex.test(password.value)) {
        displayError("passwordError", "Password must be at least 8 characters, include an uppercase letter and a number.");
        return false;
    } else {
        clearError("passwordError");
        return true;
    }
}

// Function to validate the confirm password input field
function validatePassword2() {
    const password = document.getElementById("password");
    const password2 = document.getElementById("password2");
    const errorDiv = createErrorDiv("password2Error");
    password2.parentNode.insertBefore(errorDiv, password2.nextSibling);
    
    if (password.value !== password2.value) {
        displayError("password2Error", "Passwords do not match.");
        return false;
    } else {
        clearError("password2Error");
        return true;
    }
}

// Function to create error div if it doesn't exist
function createErrorDiv(id) {
    let errorDiv = document.getElementById(id);
    if (!errorDiv) {
        errorDiv = document.createElement("div");
        errorDiv.id = id;
        errorDiv.className = "error";
        return errorDiv;
    }
    errorDiv.textContent = ""; // Clear existing text
    return errorDiv;
}

// Function to display error message
function displayError(id, message) {
    const errorDiv = document.getElementById(id);
    if (errorDiv) {
        errorDiv.textContent = message;
    }
}

function clearError(id) {
    const errorDiv = document.getElementById(id);
    if (errorDiv) {
        errorDiv.textContent = "";
    }
}

function clearErrors() {
    const errors = document.querySelectorAll(".error");
    errors.forEach(function(error) {
        error.textContent = ""; // Clear error text
    });
}
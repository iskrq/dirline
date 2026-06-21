/* ===============================
   ELEMENTI
================================ */
const loginTab = document.querySelector('[data-target="login"]');
const signUpTab = document.querySelector('[data-target="signup"]');

const loginBox = document.querySelector('[data-form="login"]');
const signupBox = document.querySelector('[data-form="signup"]');

const loginForm = document.getElementById("loginForm");
const registerForm = document.getElementById("registerForm");

/* ===============================
   HELPERS ZA ERROR STATE
================================ */
function setError(inputEl, errorEl, message) {
  if (errorEl) errorEl.textContent = message;
  if (inputEl) {
    inputEl.classList.add("border-red-500", "focus:border-red-500", "focus:ring-red-200");
    inputEl.classList.remove("border-gray-300");
  }
}

function clearError(inputEl, errorEl) {
  if (errorEl) errorEl.textContent = "";
  if (inputEl) {
    inputEl.classList.remove("border-red-500");
    inputEl.classList.add("border-gray-300");
  }
}

function clearFormErrors(form) {
  const errorFields = form.querySelectorAll("small");
  errorFields.forEach(el => el.textContent = "");

  const inputs = form.querySelectorAll("input");
  inputs.forEach(input => {
    input.classList.remove("border-red-500");
    input.classList.add("border-gray-300");
  });
}

/* ===============================
   TAB SWITCH
================================ */
function showForm(formToShow) {
  const showLogin = formToShow === "login";

  loginBox.classList.toggle("active", showLogin);
  signupBox.classList.toggle("active", !showLogin);

  loginTab.classList.toggle("active", showLogin);
  signUpTab.classList.toggle("active", !showLogin);

  // obriši samo poruke o greškama, ne i unete vrednosti
  clearFormErrors(loginForm);
  clearFormErrors(registerForm);
}

loginTab.addEventListener("click", (e) => {
  e.preventDefault();
  showForm("login");
});

signUpTab.addEventListener("click", (e) => {
  e.preventDefault();
  showForm("signup");
});

/* ===============================
   LOGIN VALIDATION
================================ */
function validateLogin() {
  const usernameInput = document.getElementById("loguser");
  const passwordInput = document.getElementById("pass1");

  const userErr = document.getElementById("user1Err");
  const passErr = document.getElementById("pass1Err");

  const username = usernameInput.value.trim();
  const password = passwordInput.value.trim();

  clearError(usernameInput, userErr);
  clearError(passwordInput, passErr);

  let valid = true;

  if (username === "") {
    setError(usernameInput, userErr, "Obavezno polje");
    valid = false;
  }

  if (password === "") {
    setError(passwordInput, passErr, "Obavezno polje");
    valid = false;
  }

  return valid;
}

/* ===============================
   REGISTER VALIDATION
================================ */
function validateRegister() {
  const usernameInput = document.getElementById("singuser");
  const emailInput = document.getElementById("mejl");
  const passInput = document.getElementById("pass2");
  const confirmInput = document.getElementById("cpass");
  const checkboxInput = document.getElementById("checkbox");

  const usernameErr = document.getElementById("singuserErr");
  const emailErr = document.getElementById("mejlErr");
  const passErr = document.getElementById("pass2Err");
  const confirmErr = document.getElementById("cpassErr");
  const checkboxErr = document.getElementById("checkboxErr");

  const username = usernameInput.value.trim();
  const email = emailInput.value.trim();
  const password = passInput.value.trim();
  const confirmPassword = confirmInput.value.trim();
  const checkbox = checkboxInput.checked;

  // reset
  clearError(usernameInput, usernameErr);
  clearError(emailInput, emailErr);
  clearError(passInput, passErr);
  clearError(confirmInput, confirmErr);
  checkboxErr.textContent = "";

  let valid = true;

  const userRegex = /^[a-zA-Z0-9._]{3,12}$/;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const passRegex = /^(?=.*[A-Za-z])(?=.*\d).{8,}$/;

  if (username === "") {
    setError(usernameInput, usernameErr, "Obavezno polje");
    valid = false;
  } else if (!userRegex.test(username)) {
    setError(usernameInput, usernameErr, "3–12 karaktera, slova, brojevi, . ili _");
    valid = false;
  }

  if (email === "") {
    setError(emailInput, emailErr, "Obavezno polje");
    valid = false;
  } else if (!emailRegex.test(email)) {
    setError(emailInput, emailErr, "Neispravan email format");
    valid = false;
  }

  if (password === "") {
    setError(passInput, passErr, "Obavezno polje");
    valid = false;
  } else if (!passRegex.test(password)) {
    setError(passInput, passErr, "Minimum 8 znakova, bar jedno slovo i jedan broj");
    valid = false;
  }

  if (confirmPassword === "") {
    setError(confirmInput, confirmErr, "Obavezno polje");
    valid = false;
  } else if (password !== confirmPassword) {
    setError(confirmInput, confirmErr, "Lozinke se ne poklapaju");
    valid = false;
  }

  if (!checkbox) {
    checkboxErr.textContent = "Morate prihvatiti uslove korišćenja";
    valid = false;
  }

  return valid;
}

/* ===============================
   SUBMIT VALIDATION
================================ */
loginForm.addEventListener("submit", function (e) {
  if (!validateLogin()) e.preventDefault();
});

registerForm.addEventListener("submit", function (e) {
  if (!validateRegister()) e.preventDefault();
});

/* ===============================
   LIVE CLEAR ERROR - LOGIN
================================ */
document.getElementById("loguser").addEventListener("input", function () {
  clearError(this, document.getElementById("user1Err"));
});

document.getElementById("pass1").addEventListener("input", function () {
  clearError(this, document.getElementById("pass1Err"));
});

/* ===============================
   LIVE CLEAR ERROR - REGISTER
================================ */
document.getElementById("singuser").addEventListener("input", function () {
  clearError(this, document.getElementById("singuserErr"));
});

document.getElementById("mejl").addEventListener("input", function () {
  clearError(this, document.getElementById("mejlErr"));
});

document.getElementById("pass2").addEventListener("input", function () {
  clearError(this, document.getElementById("pass2Err"));
});

document.getElementById("cpass").addEventListener("input", function () {
  clearError(this, document.getElementById("cpassErr"));
});

document.getElementById("checkbox").addEventListener("change", function () {
  document.getElementById("checkboxErr").textContent = "";
});
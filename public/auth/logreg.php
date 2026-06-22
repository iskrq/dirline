<?php
session_start();
require_once "../config/db.php";

$loginError    = "";
$registerError = "";
$activeTab = isset($_POST["register"]) ? "register" : "login";

/* sticky vrednosti */
$old_username = $_POST["username"] ?? "";
$old_email    = $_POST["email"]    ?? "";

if (isset($_POST["register"])) {
    /* prazna forma – odbij odmah */
    if (empty(trim($_POST["username"])) &&
        empty(trim($_POST["email"])) &&
        empty(trim($_POST["password"]))) {
        $registerError = "Sva polja su obavezna";
    } else {
        /* normalna validacija */
        $username = trim($_POST["username"]);
        $email    = trim($_POST["email"]);
        $password = $_POST["password"];
        $confirm  = $_POST["confirm_password"];
        $agree    = isset($_POST["terms"]);

        if (!$agree) {
            $registerError = "Morate prihvatiti uslove korišćenja";
        } elseif ($password !== $confirm) {
            $registerError = "Lozinke se ne poklapaju";
        } elseif (empty($username) || empty($email) || empty($password)) {
            $registerError = "Sva polja su obavezna";
        } elseif (strlen($username) < 3 || strlen($username) > 12) {
    		$registerError = "Username mora imati između 3 i 12 karaktera";
			} else {
            $chk = $conn->prepare("SELECT id FROM admins WHERE email = ? OR username = ?");
            $chk->bind_param("ss", $email, $username);
            $chk->execute();
            if ($chk->get_result()->num_rows) {
                $registerError = "Korisnik ili email već postoje";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO admins (username, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $email, $hash);
                if ($stmt->execute()) {
                    $_SESSION["user_id"]   = $conn->insert_id;
                    $_SESSION["username"]  = $username;
                    header("Location: /dirline/index.php");
                    exit;
                } else {
                    $registerError = "Greška pri registraciji";
                }
            }
        }
    }
}

/* ========== LOGIN ========== */
if (isset($_POST["login"])) {
    $activeTab = "login";

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"]   = $user["id"];
        $_SESSION["username"]  = $user["username"];
        header("Location: /dirline/index.php");
        exit;
    } else {
        $loginError = "Pogrešan username ili lozinka";
    }
}

?>
<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dirline</title>
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
  <link href="../../src/output.css" rel="stylesheet">
  <style>
      /* AUTH TABS */
  .auth-tab.active {
    background: #fff;
    color: #dc2626;
  }

  .auth-tab:not(.active):hover {
    background: rgba(255, 255, 255, 0.15);
  }

  /* AUTH FORMS */
  .form-box {
    display: none;
    opacity: 0;
    transform: translateY(10px);
    transition: opacity 0.3s ease, transform 0.3s ease;
    width: 100%;
  }

  .form-box.active {
    display: flex;
    flex-direction: column;
    justify-content: center;
    opacity: 1;
    transform: translateY(0);
  }

  .form-box small {
    display: block;
    min-height: 18px;
    font-size: 0.85rem;
  }
  </style>
</head>
<body class="bg-gray-200 min-h-screen">


  <!-- AUTH SECTION -->
  <section class="py-10 md:py-14">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-center">
        <div class="w-full max-w-5xl">
          <div class="bg-white rounded-xl shadow-sm overflow-hidden p-2">
            <div class="grid md:grid-cols-12">

              <!-- LEVI PANEL -->
              <div class="md:col-span-4 bg-red-600 flex md:flex-col flex-row md:justify-center justify-center gap-3 py-6 md:py-10 rounded-t-lg md:rounded-t-none md:rounded-l-lg">
                <a
                  href="#"
                  class="auth-tab <?= $activeTab==='login' ? 'active' : '' ?> 
                  text-white font-semibold px-6 py-3 rounded-full md:rounded-r-none md:rounded-l-full md:self-end transition"
                  data-target="login"
                >
                  Login
                </a>

                <a
                  href="#"
                  class="auth-tab <?= $activeTab==='register' ? 'active' : '' ?> 
                  text-white font-semibold px-6 py-3 rounded-full md:rounded-r-none md:rounded-l-full md:self-end transition"
                  data-target="signup"
                >
                  Sign up
                </a>
              </div>

              <!-- DESNI DEO -->
              <div class="md:col-span-8 flex items-center justify-center">
                <div class="w-full flex justify-center items-center px-4 sm:px-6 md:px-10 py-8">

                  <!-- LOGIN -->
                  <div
                    class="form-box <?= $activeTab==='login' ? 'active' : '' ?> w-full max-w-md min-h-[600px]"
                    data-form="login"
                  >
                    <h1 class="text-3xl font-bold text-center mb-6">Login</h1>

                    <?php if($loginError): ?>
                      <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                        <?= $loginError ?>
                      </div>
                    <?php endif; ?>

                    <form method="POST" id="loginForm" novalidate class="space-y-4">
                      <div>
                        <input
                          type="text"
                          name="username"
                          id="loguser"
                          maxlength="12"
                          value="<?= htmlspecialchars($old_username) ?>"
                          placeholder="Username"
                          class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-200"
                        >
                        <small id="user1Err" class="text-sm text-red-600 mt-1"></small>
                      </div>

                      <div>
                        <input
                          type="password"
                          name="password"
                          id="pass1"
                          placeholder="Password"
                          class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-200"
                        >
                        <small id="pass1Err" class="text-sm text-red-600 mt-1"></small>
                      </div>

                      <button
                        type="submit"
                        name="login"
                        class="w-full rounded-lg bg-red-600 text-white font-semibold py-3 hover:bg-red-700 transition"
                      >
                        Login
                      </button>
                    </form>
                  </div>

                  <!-- REGISTER -->
                  <div
                    class="form-box <?= $activeTab==='register' ? 'active' : '' ?> w-full max-w-md min-h-[600px]"
                    data-form="signup"
                  >
                    <h1 class="text-3xl font-bold text-center mb-6">Sign up</h1>

                    <?php if($registerError): ?>
                      <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                        <?= $registerError ?>
                      </div>
                    <?php endif; ?>

                    <form method="POST" id="registerForm" novalidate class="space-y-3">
                      <div>
                        <input
                          type="text"
                          name="username"
                          id="singuser"
                          maxlength="12"
                          value="<?= htmlspecialchars($old_username) ?>"
                          placeholder="Username"
                          class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-200"
                        >
                        <small id="singuserErr" class="text-sm text-red-600 mt-1"></small>
                      </div>

                      <div>
                        <input
                          type="email"
                          name="email"
                          id="mejl"
                          value="<?= htmlspecialchars($old_email) ?>"
                          placeholder="Email"
                          class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-200"
                        >
                        <small id="mejlErr" class="text-sm text-red-600 mt-1"></small>
                      </div>

                      <div>
                        <input
                          type="password"
                          name="password"
                          id="pass2"
                          placeholder="Password"
                          class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-200"
                        >
                        <small id="pass2Err" class="text-sm text-red-600 mt-1"></small>
                      </div>

                      <div>
                        <input
                          type="password"
                          name="confirm_password"
                          id="cpass"
                          placeholder="Confirm password"
                          class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-200"
                        >
                        <small id="cpassErr" class="text-sm text-red-600 mt-1"></small>
                      </div>

                      <div>
                        <label class="flex items-start gap-3 cursor-pointer">
                          <input
                            class="mt-1 h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500"
                            type="checkbox"
                            id="checkbox"
                            name="terms"
                          >
                          <span class="text-sm text-gray-700">
                            I agree to the terms and conditions
                          </span>
                        </label>
                        <small id="checkboxErr" class="text-sm text-red-600 mt-1"></small>
                      </div>

                      <button
                        type="submit"
                        name="register"
                        class="w-full rounded-lg bg-red-600 text-white font-semibold py-3 hover:bg-red-700 transition"
                      >
                        Sign up
                      </button>
                    </form>
                  </div>

                </div>
              </div>
              <!-- /desni deo -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="../js/logreg.js"></script>


</body>
</html>
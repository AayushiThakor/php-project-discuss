<?php
session_start();
include("../common/db.php");

/* ================= SIGNUP ================= */
if (isset($_POST['signup'])) {

    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $address  = $_POST['address'];

    $user = $conn->prepare(
        "INSERT INTO users (username, email, password, address)
         VALUES (?, ?, ?, ?)"
    );
    $user->bind_param("ssss", $username, $email, $password, $address);
    $result = $user->execute();

    if ($result) {
        // ✅ FIX: insert_id MUST come from $conn
        $_SESSION["user"] = [
            "username" => $username,
            "email"    => $email,
            "user_id"  => $conn->insert_id
        ];
        header("Location: /queans");
        exit;
    } else {
        echo "New user not registered";
    }
}

/* ================= LOGIN ================= */
elseif (isset($_POST['login'])) {

    $email    = $_POST['email'];
    $password = $_POST['password'];

    $query = $conn->prepare(
        "SELECT id, username, email FROM users
         WHERE email = ? AND password = ?"
    );
    $query->bind_param("ss", $email, $password);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        $_SESSION["user"] = [
            "username" => $row['username'],
            "email"    => $row['email'],
            "user_id"  => $row['id']
        ];

        header("Location: /queans");
        exit;
    } else {
        echo "Invalid login";
    }
}

/* ================= LOGOUT ================= */
elseif (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: /queans");
    exit;
}

/* ================= ASK QUESTION ================= */
else if (isset($_POST["ask"])) {

    if (!isset($_SESSION['user']['user_id'])) {
        die("User not logged in");
    }

    $title       = $_POST['title'];
    $description = $_POST['description'];
    $category_id = (int)$_POST['category'];
    $user_id     = (int)$_SESSION['user']['user_id']; // ✅ IMPORTANT

    $query = $conn->prepare(
        "INSERT INTO questions (title, description, category_id, user_id)
         VALUES (?, ?, ?, ?)"
    );
    $query->bind_param("ssii", $title, $description, $category_id, $user_id);

    $query->execute();
    header("Location: /queans");
    exit;
}



/* ================= ANSWER ================= */
elseif (isset($_POST['answer'])) {

    if (!isset($_SESSION['user']['user_id'])) {
        die("User not logged in");
    }

    $answer      = $_POST['answer'];
    $question_id = (int)$_POST['question_id'];
    $user_id     = $_SESSION['user']['user_id'];

    $query = $conn->prepare(
        "INSERT INTO answers (answers, question_id, user_id)
         VALUES (?, ?, ?)"
    );
    $query->bind_param("sii", $answer, $question_id, $user_id);

    if ($query->execute()) {
        header("Location: /queans?q-id=$question_id");
        exit;
    } else {
        echo "Answer not submitted";
    }
} elseif(isset($_GET["delete"])){
    echo $qid = $_GET["delete"];
    $query = $conn->prepare("delete from questions where id = $qid");
    $result = $query->execute();
    if($result){
        header("Location: /queans");
    } else {
        echo "Question not deleted";
    }
}
?>

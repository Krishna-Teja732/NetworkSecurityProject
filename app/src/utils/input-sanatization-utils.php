<?php
function sanitize_input_string(string $input): string {
    // Trim whitespace, remove HTML tags, and convert special characters to HTML entities
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

function validate_username(string $input): bool {
    return preg_match('/^[a-zA-Z0-9@._-]+$/', $input);
}


function validate_signup_inputs(string $username, string $password, string $email): array {
    $errors = [];

    // Sanitize inputs
    $username = sanitize_input_string($username);
    $password = sanitize_input_string($password);
    $email = sanitize_input_string($email);

    // Validate Username (Alphanumeric + @, ., -, _ and length 3-20)
    if (!validate_username($username)) {
        $errors[] = "Username must be alphanumeric and can contain @, ., -, _ (3-20 characters).";
    }

    // Validate Password (Minimum 8 characters)
    if (strlen($password) < 2) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Validate Email (Using filter_var)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    return $errors; // Return an array of errors (empty if no errors)
}


function validate_signin_inputs(string $username, string $password): array {
    $errors = [];

    // Sanitize inputs
    $username = sanitize_input_string($username);
    $password = sanitize_input_string($password);

    // Validate Username (Alphanumeric + @, ., -, _ and length 3-20)
    if (!validate_username($username)) {
        $errors[] = "Username must be alphanumeric and can contain @, ., -, _ (3-20 characters).";
    }

    // Validate Password (Minimum 8 characters)
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Return an array of errors (empty if no errors)
    return $errors;
}


function validate_transactions_inputs(string $username1, string $username2, int $amount): array {
    $errors = [];

    // Sanitize inputs
    $username1 = sanitize_input_string($username1);
    $username2 = sanitize_input_string($username2);

    // Check if both usernames are the same
    if ($username1 === $username2) {
        $errors[] = "Sender and recipient usernames cannot be the same.";
        return $errors;
    }

    // Validate Username (Alphanumeric + @, ., -, _ and length 3-20)
    if (!validate_username($username1) and !validate_username($username2)) {
        $errors[] = "Username must be alphanumeric and can contain @, ., -, _ (3-20 characters).";
    }

    // Validate transaction amount (must be an integer greater than 0)
    if (!filter_var($amount, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $errors[] = "Transaction amount must be a valid integer and greater than 0.";
    }

    // Return an array of errors
    return $errors;
}

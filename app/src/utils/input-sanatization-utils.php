<?php
function sanitize_input_string(string $input): string
{
    // Trim whitespace, remove HTML tags, and convert special characters to HTML entities
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

function validate_username(string $input): bool
{
    //Username must be Alphanumeric and can contain some special characters like @, ., -, _
    return preg_match('/^[a-zA-Z0-9@._-]+$/', $input);
}


function validate_signup_inputs(string $username, string $password, string $email): bool
{

    // Sanitize inputs
    $username = sanitize_input_string($username);
    $email = sanitize_input_string($email);

    // Validate inputs
    // Password size should be greater than 2    
    // Email format validation
    if (
        validate_username($username) &&
        strlen($password) > 2 &&
        filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        return true;
    }
    return false;
}


function validate_signin_inputs(string $username, string $password): bool
{
    // Sanitize inputs
    $username = sanitize_input_string($username);

    // Validate inputs
    // Password size should be greater than 2
    if (
        validate_username($username) &&
        strlen($password) > 2
    ) {
        return true;
    }
    return false;
}


function validate_transactions_inputs(string $username1, string $username2, int $amount): bool
{

    // Sanitize inputs
    $username1 = sanitize_input_string($username1);
    $username2 = sanitize_input_string($username2);

    // Validate inputs
    if (($username1 === $username2) &&
        validate_username($username1) &&
        validate_username($username2) &&
        // Trasaction amount must be greater than 0
        filter_var($amount, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])
    ) {
        return true;
    } else {
        return false;
    }
}

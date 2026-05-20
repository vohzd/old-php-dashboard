<?php
// router.php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve static files as is
if (file_exists(__DIR__ . $uri) && $uri !== '/') {
    return false;
}

// Handle API routes
// Mock Login/Register to bypass Database requirement
if (preg_match('#^/user/register$#', $uri)) {
    // Mock successful registration
    $tokenData = json_encode([
        "username" => "NewUser",
        "userId" => 1
    ]);
    echo json_encode([
        "messageType" => "token",
        "messageBody" => $tokenData
    ]);
    exit;
}

if (preg_match('#^/login/([^/]+)/([^/]+)$#', $uri, $matches)) {
    // Mock successful login
    $username = urldecode($matches[1]);
    $tokenData = json_encode([
        "username" => $username,
        "userId" => 1
    ]);
    echo json_encode([
        "messageType" => "token",
        "messageBody" => $tokenData
    ]);
    exit;
}

// Mock Core/Dashboard API routes
if (preg_match('#^/rest-backend/api/user/.*$#', $uri)) {
    // Mock user profile with some default widgets
    
    // Wait, let's keep it simple. If "nowidgets" is returned, it triggers introduction.
    // Let's return "nowidgets" first to see the intro modal, which is safer.
    // echo '"nowidgets"';
    // Actually, let's try to show *something*.
    // But I don't know the exact structure of "widgetPath" for the existing widgets.
    // I see widgets/Calendar, widgets/Gmail, etc.
    echo json_encode([
        "calendar" => [
            "widgetCodeName" => "Calendar",
            "widgetName" => "Calendar",
            "widgetPath" => "/Calendar/index.html",
            "widgetId" => 1,
            "stateId" => 1,
            "widgetData" => null
        ]
    ]);
    exit;
}

if (preg_match('#^/rest-backend/api/widget.*$#', $uri)) {
    // This seems to be the "list of all available widgets" endpoint used in introduction
    echo json_encode([
        [
            "w_codeName" => "Calendar",
            "w_name" => "Calendar",
            "w_desc" => "A simple calendar",
            "w_id" => 1
        ],
        [
            "w_codeName" => "Todo",
            "w_name" => "Todo List",
            "w_desc" => "Keep track of tasks",
            "w_id" => 2
        ]
    ]);
    exit;
}

// Default to index.php or login.php
if ($uri === '/' || $uri === '/index.php') {
    require 'index.php';
} else {
    // If we're here, it's a 404 or an unhandled route
    // But maybe it's login.php?
    if ($uri === '/login.php') {
        require 'login.php';
    } else {
        http_response_code(404);
        echo "404 Not Found";
    }
}

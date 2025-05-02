<?php

// Default password
$password = "admin";

// Function to start the Library Management System
function startLibrarySystem() {
    global $password;
    echo "Welcome to the Library Management System!\n";
    echo "Please enter the password: ";
    $inputPassword = trim(fgets(STDIN));

    if ($inputPassword === $password) {
        echo "Access Granted!\n\n";
        mainMenu();
    } else {
        echo "Incorrect Password. Exiting...\n";
        exit();
    }
}

// Array to store books
$books = [];

// Main menu
function mainMenu() {
    global $books;

    while (true) {
        echo "Main Menu:\n";
        echo "1. Add Book\n";
        echo "2. Delete Book\n";
        echo "3. Search Book\n";
        echo "4. View All Books\n";
        echo "5. Change Password\n";
        echo "6. Exit\n";
        echo "Enter Your Choice: ";
        $option = trim(fgets(STDIN));

        switch ($option) {
            case 1:
                addBook();
                break;
            case 2:
                deleteBook();
                break;
            case 3:
                searchBook();
                break;
            case 4:
                viewBooks();
                break;
            case 5:
                changePassword();
                break;
            case 6:
                echo "Exiting the system... Goodbye!\n";
                exit();
                break;
            default:
                echo "Invalid option. Please try again.\n";
        }
    }
}

// Function to add a book
function addBook() {
    global $books;
    echo "Select categories:\n";
    echo "1. computer\n";
    echo "2. Civil\n";
    echo "3. Elecrical\n";
    echo "4. Mechanical\n";
    echo "Enter Your Choice: ";
    $categoryOption = trim(fgets(STDIN));

    $categories = ["computer", "Civil", "Elecrical", " Mechanical"];
    $category = isset($categories[$categoryOption - 1]) ? $categories[$categoryOption - 1] : "Unknown";

    echo "Enter book title: ";
    $title = trim(fgets(STDIN));
    echo "Enter author name: ";
    $author = trim(fgets(STDIN));
    echo "Enter publication year: ";
    $year = trim(fgets(STDIN));

    $books[] = ["title" => $title, "author" => $author, "category" => $category, "year" => $year];
    echo "Book added successfully!\n\n";
}

// Function to delete a book
function deleteBook() {
    global $books;
    echo "Enter book title to delete: ";
    $title = trim(fgets(STDIN));

    foreach ($books as $index => $book) {
        if ($book['title'] === $title) {
            unset($books[$index]);
            echo "Book deleted successfully!\n\n";
            return;
        }
    }
    echo "Book not found.\n\n";
}

// Function to search for a book
function searchBook() {
    global $books;
    echo "Enter search term (title/author/category): ";
    $term = trim(fgets(STDIN));

    $results = array_filter($books, function ($book) use ($term) {
        return stripos($book['title'], $term) !== false ||
               stripos($book['author'], $term) !== false ||
               stripos($book['category'], $term) !== false;
    });

    if (count($results) > 0) {
        echo "Search Results:\n";
        foreach ($results as $book) {
            echo "Title: {$book['title']}, Author: {$book['author']}, Category: {$book['category']}, Year: {$book['year']}\n";
        }
        echo "\n";
    } else {
        echo "No books found.\n\n";
    }
}

// Function to view all books
function viewBooks() {
    global $books;

    if (count($books) > 0) {
        echo "Library Books:\n";
        foreach ($books as $book) {
            echo "Title: {$book['title']}, Author: {$book['author']}, Category: {$book['category']}, Year: {$book['year']}\n";
        }
        echo "\n";
    } else {
        echo "No books found.\n\n";
    }
}

// Function to change password
function changePassword() {
    global $password;
    echo "Enter old password: ";
    $oldPassword = trim(fgets(STDIN));

    if ($oldPassword === $password) {
        echo "Enter new password: ";
        $newPassword = trim(fgets(STDIN));
        $password = $newPassword;
        echo "Password changed successfully!\n\n";
    } else {
        echo "Incorrect old password.\n\n";
    }
}

// Start the system
startLibrarySystem();
?>

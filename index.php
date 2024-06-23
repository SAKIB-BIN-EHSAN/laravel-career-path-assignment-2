<?php

$options = [
    "Add income",
    "Add expense",
    "View incomes",
    "View expenses",
    "View savings",
    "View categories",
    "Exit"
];

$categories = [
    [
        "Name" => "Salary",
        "Type" => "Income"
    ],
    [
        "Name" => "Business",
        "Type" => "Income"
    ],
    [
        "Name" => "Tution",
        "Type" => "Income"
    ],
    [
        "Name" => "Rent",
        "Type" => "Expense"
    ],
    [
        "Name" => "Shopping",
        "Type" => "Expense"
    ],
    [
        "Name" => "Travelling",
        "Type" => "Expense"
    ],
];

/**
 *  Print the income and expense categories
 *  @param $categories = income & expense
 *  
 */
function printCategories($categories) {
    echo "---------------------------------------------\n";
    foreach ($categories as $key => $category) {
        echo "Category No. " . $key+1 . " => Category Name: " . $category['Name'] . ", Category Type: " . $category['Type'] . "\n";
    }
    echo "---------------------------------------------\n";
}

/**
 *  Add provided amount to corresponding income or expense category
 *  @param $category = income/expense category
 *  @param $type = income or expense
 *  @param $amount
 */
function addIncomeExpense($category, $type, $amount) {
    $myfile = fopen("income-expenses.txt", "r") or die("Unable to open file!");
    $filename = "income-expenses.txt";
    $incomeExpenses = file($filename, FILE_IGNORE_NEW_LINES);

    foreach($incomeExpenses as $key => $incomeExpense) {

        if ($key+1 == $category) {
            $val = intval($incomeExpense);
            $incomeExpenses[$key] = (string)($val + $amount);
        }
    }
    file_put_contents($filename, join("\n", $incomeExpenses));
    echo "---------------------------------------------\n";
    echo $type . " added successfully.\n";
    echo "---------------------------------------------\n";
}

/**
 *  Show all incomes and expenses based on provided parameters
 *  @param $categories = income & expense
 *  @param $type = income or expense
 */
function showIncomeExpense($categories, $type) {
    $myfile = fopen("income-expenses.txt", "r") or die("Unable to open file!");
    $filename = "income-expenses.txt";
    $incomeExpenses = file($filename, FILE_IGNORE_NEW_LINES);

    echo "---------------------------------------------\n";
    echo "---------------------------------------------\n";
    foreach ($incomeExpenses as $key => $incomeExpense) {

        if ($type == "Income") {
            if ($key+1 <= 3) {
                echo $type . " Category Name -> " . $categories[$key]["Name"] . ", Amount: " . $incomeExpense . "\n";
            }
        }
        else {
            if ($key+1 >= 4) {
                echo $type . " Category Name -> " . $categories[$key]["Name"] . ", Amount: " . $incomeExpense . "\n";
            }
        }
        
    }
    echo "---------------------------------------------\n";
    echo "---------------------------------------------\n";
}

while(true) {
    $i = 1;
    foreach ($options as $value) {
        echo $i++ . ". " . $value . "\n";
    }

    $option = intval(readline("Enter your option: "));

    if ($option == 1) {
        $amount = intval(readline("Enter income amount: "));
        $category = intval(readline("Enter the income category in number(1-3): "));

        if ($category != 1 && $category != 2 && $category != 3) {
            echo "---------------------------------------------\n";
            echo "\nWrong Category! You\'ve to enter the income category from 1 or 2 or 3.\n";
            echo "---------------------------------------------\n";
            continue;
        }

        if ($category == 1) {

            addIncomeExpense($category, "Income", $amount);

        }
        else if ($category == 2) {

            addIncomeExpense($category, "Income", $amount);

        }
        else {

            addIncomeExpense($category, "Income", $amount);
        }
    }
    else if ($option == 2) {

        $amount = intval(readline("Enter expense amount: "));
        $category = intval(readline("Enter the expense category in number(4-6): "));

        if ($category != 4 && $category != 5 && $category != 6) {
            echo "---------------------------------------------\n";
            echo "\nWrong Category! You\'ve to enter the expense category from 4 or 5 or 6.\n";
            echo "---------------------------------------------\n";
            continue;
        }

        if ($category == 4) {

            addIncomeExpense($category, "Expense", $amount);

        }
        else if ($category == 5) {

            addIncomeExpense($category, "Expense", $amount);

        }
        else {

            addIncomeExpense($category, "Expense", $amount);

        }
    }
    else if ($option == 3) {

        showIncomeExpense($categories, "Income");

    }
    else if ($option == 4) {

        showIncomeExpense($categories, "Expense");

    }
    else if ($option == 5) {

        $myfile = fopen("income-expenses.txt", "r") or die("Unable to open file!");
        $filename = "income-expenses.txt";
        $incomeExpenses = file($filename, FILE_IGNORE_NEW_LINES);

        $totalIncome = 0;
        $totalExpense = 0;

        foreach ($incomeExpenses as $key => $incomeExpense) {

            if ($key+1 == 1 || $key+1 == 2 || $key+1 == 3) {
                $totalIncome += intval($incomeExpense);
            }
            else {
                $totalExpense += intval($incomeExpense); 
            }
        }

        if ($totalIncome < $totalExpense) {
            echo "---------------------------------------------\n";
            echo "You\'ve no savings.\n";
            echo "---------------------------------------------\n";
        }
        else {
            echo "---------------------------------------------\n";
            echo "Savings: " . $totalIncome - $totalExpense . "\n";
            echo "---------------------------------------------\n";
        }
    }
    else if ($option == 6) {
        printCategories($categories);
    }
    else if ($option == 7) {
        break;
    }
}
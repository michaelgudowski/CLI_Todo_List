<?php

 // Create array to hold list of todo items
 $items = array();

 // List array items formatted for CLI
 function listItems($list)
 {
    $string = "";
    foreach ($list as $key => $value) {
        $key++;
        $string .= "[{$key}] {$value}\n";
    }    

    return $string;
}

function getInput ($upper = false)
{

    $input = trim(fgets(STDIN));

    if ($upper == true) {
        $input = strtoupper($input);
    }
        
    return $input;
}
     // Return string of list items separated by newlines.
     // Should be listed [KEY] Value like this:
     // [1] TODO item 1
     // [2] TODO item 2 - blah
     // DO NOT USE ECHO, USE RETURN


 // Get STDIN, strip whitespace and newlines,
 // and convert to uppercase if $upper is true
 


 // The loop!
 do {
     // Echo the list produced by the function
     echo listItems($items);

     // Show the menu options
     echo '(N)ew item, (R)emove item, (S)ort (Q)uit : ';

    $input = getInput(true);   

     // Get the input from user
    // getInput($input)
    // {
    
    // }
    // getInput($input);
     // Use trim() to remove whitespace and newlines
     
     // Check for actionable input
    if ($input == 'N') {
         // Ask for entry
         echo 'Enter item: ';
         // Add entry to list array
         $newItem = getInput();

        echo "Do you want the item in the (B)eginning or the (E)nd" . PHP_EOL ;

       $NewInput = getInput(true);

        if ($NewInput == 'B') {
           array_unshift($items, $newItem);

        }
        else{
            array_push($items, $newItem);
        }

    } 


     elseif ($input == 'R') {
         // Remove which item?
         echo 'Enter item number to remove: ';
         // Get array key
         $key = getInput();
         // Remove from array
         $key--;
         unset($items[$key]);
     }
         // Option if user wants to sort
    elseif ($input == 'S'){
        echo '(A)-Z, (Z)-A, (O)rder entered, (R)everse : ';
        $sortinput = trim(fgets(STDIN));
        $sortinput = strtoupper($sortinput);

        if ($sortinput == 'A'){
            asort($items);

        }
        elseif ($sortinput == 'Z'){
            arsort($items);    
        }
        elseif ($sortinput == 'O'){
            ksort($items);    
        }
        elseif ($sortinput == 'R'){
            krsort($items);    
        }

    }
 
    elseif ($input == 'F'){
        array_shift($items);
    }


    elseif ($input == "L"){
        array_pop($items);
    }
}
 // Exit when input is (Q)uit
    while ($input != 'Q');

 // Say Goodbye!
 echo "Goodbye!\n";

 // Exit with 0 errors
 exit(0);
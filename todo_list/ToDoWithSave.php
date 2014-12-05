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

function readlist ($filename)
{
    if (filesize($filename) == 0){
        echo 'file has no contents';
    } 
    else{
        $handle = fopen($filename, 'r');
        $contents = fread($handle, filesize($filename));
        $contentsArray = explode("\n", $contents);
        fclose($handle);
        return $contentsArray;
    }
}



 // The loop!
 do {
     // Echo the list produced by the function
     echo listItems($items);

     // Show the menu options
     echo '(N)ew item, (R)emove item, (S)ort, (O)pen file, s(A)ve, (Q)uit : ';

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

    } elseif ($input == 'R') {
         // Remove which item?
         echo 'Enter item number to remove: ';
         // Get array key
         $key = getInput();
         // Remove from array
         $key--;
         unset($items[$key]);
    } elseif ($input == 'O'){
        //Option to open a .txt file
        echo 'Please enter the file path' . PHP_EOL;
        $filename = trim(fgets(STDIN));
        $listarray = readlist ($filename);
        $items = array_merge($items , $listarray);
    } elseif ($input == 'S'){
        // Option if user wants to sort
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
    } elseif ($input == 'F'){
        array_shift($items);
    } elseif ($input == 'L'){
        array_pop($items);
    // User wants to save the information in the array to a file
    } elseif ($input == 'A'){
        echo "Warning! This action will overwrite the content in the file.\n";
        echo "Would you like to proceed? Y/N\n";
        $userchoice = trim(fgets(STDIN));
        $userchoice = strtoupper($userchoice);
    //User has agreed to save. If not, program goes back to beginning of loop.
        if ($userchoice == "Y"){
            echo "Please enter the path to a file to have it saved.\n";
            $filename = trim(fgets(STDIN));       
            $handle = fopen($filename, 'w');
            if (file_exists($filename)) {
                echo "The file exist or you are creating a new file. Are you ok with this?\n";
                echo "Would you like to proceed? Y/N\n";
                $fileYes = trim(fgets(STDIN));
                $fileYes = strtoupper($fileYes);
            if ($fileYes == "Y"){
                foreach ($items as $item){
                fwrite($handle, PHP_EOL . $item);
            }
                echo "Saving...\n";
                sleep(3);
                echo "File successfully saved!\n";
            }


            }
            else{
                foreach ($items as $item)  {
                fwrite($handle, PHP_EOL . $item);
                }
                echo "Saving...\n";
                sleep(3);
                echo "File successfully saved!\n";
                }



            }
            
        }

    }

 // Exit when input is (Q)uit
while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);

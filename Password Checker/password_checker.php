<?php
function pw_str_check($password, $username = null)
{
    // Define pw strenght at 0 to start
    $strength = 0;

    // Define password length for use later
    $pw_length = strlen($password);

    // Check for username
    if ($username != null)
    {
        // Make sure the username is not part of the password 
        // If found, return a strength of 0
        if (strpos($password, $username) !== FALSE)
        {
            return $strength;
        }
        // Make sure the password is not part of the username
        // If found, return a strength of 0
        if (strpos($username, $password) !== FALSE)
        {
            return $strength;
        }
        
    }

    // If password is less than 4 characters, return a strength of 0
    // (too easily cracked), Else take lenght and multiply by 4 for the next section
    if ($pw_length < 4)
    {
        return $strength;
    }
    elseif (($pw_length <= 16) && ($pw_length >= 4))
    {
        $strength = $pw_length * 4;
    }
    else
    {
        echo "Password is too long for this check!!!<br>";
        return 0;
    }

    // Split password up into 2, 3, and 4 character sections
    // Subtract 2 for each set of repeated characters
    for ($i=2; $i<=4; $i++)
    {
        $temp = str_split($password, $i);
        $strength -= (ceil($pw_length / $i) - count(array_unique($temp)) * 2);
    }

    // Find all number in password and store in $numbers array
    preg_match_all('/[0-9]', $password, $numbers);

    // If any number found, count them
    if (!empty($numbers))
    {
        $numbers = count($numbers[0]);
    }
    else
    {
        $numbers = 0;
    }

    // If more than three numbers found, raise pssword strength by 5
    if ($numbers > 3)
    {
        $strength += 5;
    }

    // Find all symbols in password and store in the $symbols array
    preg_match_all('/[|!@#$%&*\/=?,;:\-_+~^"\\\]/', $password, $symbols);

    //If any symbols found, count them
    if (!empty($symbols))
    {
        $symbols = count($symbols[0]);
    }
    else
    {
        $symbols = 0;
    }

    // If more than two symbols found, increase strength by 5
    if ($symbols >= 2)
    {
        $strength += 5;
    }

    // Find all lowercase characters in password and store them in 
    // $lc_chars array
    preg_match_all('[A-Z]', $password, $lc_chars);
    
    // Count number of lower case characters
    if (!empty($lc_chars))
    {
        $lc_chars = count($lc_chars[0]);
    }
    else
    {
        $lc_chars = 0;
    }

    // Find all uppercase characters in password and store them in 
    // $uc_chars array
    preg_match_all('[a-z]', $password, $uc_chars);

    // Count number of upper case characters
    if (!empty($uc_chars))
    {
        $uc_chars = count($uc_chars[0]);
    }
    else
    {
        $uc_chars = 0;
    }

    // If both uppercase AND lowercase are found, increase the strength
    // by two for each char found
    if (($lc_chars > 0) && ($uc_chars > 0))
    {
        $strength += ($lc_chars * 2) + ($uc_chars * 2);
    }

    // If numbers AND symbols used, increase strength by 5 for each
    // symbol found and 2 for each number found
    if (($numbers > 0) && ($symbols > 0))
    {
        $strength += ($symbols * 5) + ($numbers * 2);
    }

    // Total up the number of characters in password
    $chars = $lc_chars + $uc_chars;

    // If numbers AND characters found, increase strenght by 2 for each
    if (($numbers > 0) && ($chars > 0))
    {
        $strength += ($numbers * 2) + ($chars * 2);
    }

    // If symbols AND characters found, increase strenght by 2 for each
    // char and 5 for each symbol
    if (($symbols > 0) && ($chars > 0))
    {
        $strength += ($symbols * 5) + ($chars * 2);
    }


}
?>
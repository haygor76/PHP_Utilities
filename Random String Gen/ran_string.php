<?php

/********************************************************************************
*  Function to return a random string of characters bosed on a character set    *
*  This function was written by William Winans and is copyright (c) 2006        *
*                                                                               *
*  May not be duplicated or altered without express permission under penalty of *
*  international copyright infringement law.                                    *
********************************************************************************/

function ranString($length, $charset)
{
	/******************************************
	* Character Sets                          *
	* 1 - only numbers                        *
	* 2 - lowercase letters                   *
	* 3 - uppercase letters                   *
	* 4 - lowercase and uppercase letters     *
	* 5 - lowercase, uppercase, and numbers   *
	* 6 - all possible keyboard buttons       *
	******************************************/
	
	$string = "";
	switch($charset)
	{
		case 1:
			// Only Numbers (0-9)
			for ($i=0; $i < $length; $i++)
			{
				$ranchar = rand(0,9);
				$string .= $ranchar;
			}
			break;
		case 2:
			// Lowercase Letters (a - z)
			for ($i=0; $i < $length; $i++)
			{
				$ranchar = rand(97,122);
				$ranchar = chr($ranchar);
				$string .= $ranchar;
			}
			break;
		case 3:
			// Uppercase letters (A - Z)
			for ($i=0; $i < $length; $i++)
			{
				$ranchar = rand(65,90);
				$ranchar = chr($ranchar);
				$string .= $ranchar;
			}
			break;
		case 4:
			// Lower and Upper case letters (a - z, A - Z)
			for ($i=0; $i < $length; $i++)
			{
				$ranchar = rand(1,52);
				if ($ranchar >= 1 && $ranchar <= 26)
				{
					$ranchar += 64;
					$ranchar = chr($ranchar);
				}
				else
				{
					$ranchar += 64;
					$ranchar = chr($ranchar);
				}
				$string .= $ranchar;
			}
			break;
		case 5:
			// Lowercase, Uppercase, and numbers (a - z, A - Z, 0 - 9)
			for ($i=0; $i < $length; $i++)
			{
				$ranchar = rand(1, 62);
				if ($ranchar >= 1 && $ranchar <= 10)
				{
					$ranchar += 47;
				}
				elseif ($ranchar >= 11 && $ranchar <= 36)
				{
					$ranchar += 54;
				}
				else
				{
					$ranchar += 60;
				}
				$ranchar = chr($ranchar);
				$string .= $ranchar;
			}
			break;
		case 6:
			// All possible keyboard buttons excluding
			// Space, ", ', and `
			for ($i=0; $i < $length; $i++)
			{
				$ranchar = rand(1, 91);
				if ($ranchar == 1)
				{
					$ranchar += 32;
				}
				elseif ($ranchar >= 2 && $ranchar <= 5)
				{
					$ranchar += 33;
				}
				elseif ($ranchar >= 6 && $ranchar <= 61)
				{
					$ranchar += 34;
				}
				else
				{
					$ranchar += 35;
				}
				$ranchar = chr($ranchar);
				$string .= $ranchar;
			}
			break;
	}
	return str_shuffle(str_shuffle(str_shuffle($string)));
}

?>
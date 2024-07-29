<?php  

namespace App\Helpers;

class WordHelper {
    public function uniqueLetters($word)
    {
        return count(array_unique(str_split($word)));
    }

    public function isWordPalindrome($word)
    {
        if ($word === strrev($word)) {
            return true;
        }
        return false;
    }
    
    public function isWordAlmostPalindrome($word)
    {
        $almostPalindrome = false;

        for ($i = 0; $i < strlen($word); $i++) {
            $someWord = substr($word, 0, $i) . substr($word, $i + 1);
            if ($someWord === strrev($someWord)) {
                $almostPalindrome = true;
                break;
            }
        }
        return $almostPalindrome;
    }
}

?>


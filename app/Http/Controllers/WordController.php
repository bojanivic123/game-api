<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\WordHelper;
use Illuminate\Support\Facades\Http;
use WordHelper as GlobalWordHelper;

class WordController extends Controller
{
    private $wordHelper;
    public function __construct(WordHelper $wordHelper)
    {
        $this->wordHelper = $wordHelper;
    }
    public function checkWord(Request $request)
    {
        if (!$request->word) {
            return 0;
        }

        $response = Http::get("https://api.dictionaryapi.dev/api/v2/entries/en/$request->word")->json();

        if (!array_key_exists(0, $response)) {
            return 0;
        }   

        $word = $response[0]["word"];
        $score = $this->wordHelper->uniqueLetters($word);

        if ($this->wordHelper->isWordPalindrome($word)) {
            $score += 3;
        } else if ($this->wordHelper->isWordAlmostPalindrome($word)) {
            $score += 2;
        }
        return $score;
    }
}

?>


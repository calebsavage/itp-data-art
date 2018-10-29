<?php
// passthru("node markov.js");
// die;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function pre($txt){
    echo "<pre>";
    echo var_dump($txt); 
    echo "</pre>";
}


    if (file_exists('manner.xml')) {
        $xml = simplexml_load_file('manner.xml');
    }
   
    $c=0;
    // $dict['subjects'] = array();
    // $dict['contents'] = array();
    // $dict['bestanswers'] = array();
    // $dict['answers'] = array();
    $dict['categories'] = array();
    //$katz = array();
    foreach ($xml->vespaadd as $question) {		
    	
        $dict['categories'][(string)$question->document->maincat]['subjects'][] = (string) $question->document->subject;
       
        $dict['categories'][(string)$question->document->maincat]['contents'][] = (string)$question->document->content;

        $dict['categories'][(string)$question->document->maincat]['answers'][] = htmlentities((string)$question->document->bestanswer);


        foreach($question->document->nbestanswers->answer_item as $answer){
            $dict['categories'][(string)$question->document->maincat]['answers'][] = (string)$answer;
        }

       
        // if(!isset($dict['categories'][$question['maincat']][$question['cat'])){
        //     $dict['categories'][$question['maincat']][$question['cat']] = array();
        // }

        // if(!isset($dict['categories'][$question['maincat']][$question['cat'][$question['subcat']])){
        //     $dict['categories'][$question['maincat']][$question['cat']][$question['subcat']] = array();
        // }
 //        $dict['categories'][$question['maincat']][$question['cat']][$question['subcat']] = $question['subcat'];







    $c++;

 if($c == 1000){
    break;
 	}

}
//  //die(json_encode($katz));
$file = fopen('dictionary.json', 'w');
fwrite($file, json_encode($dict));
fclose($file);

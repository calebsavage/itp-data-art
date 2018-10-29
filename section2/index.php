 <?php

    //print_r($_GET);die;
// // passthru("node markov.js");
// // die;
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// function pre($txt){
//     echo "<pre>";
//     echo var_dump($txt); 
//     echo "</pre>";
// }


//     if (file_exists('manner.xml')) {
//         $xml = simplexml_load_file('manner.xml');
//     }
//     $c=0;
//     // $dict['subjects'] = array();
//     // $dict['contents'] = array(); 
//     // $dict['bestanswers'] = array();
//     // $dict['answers'] = array();
//     $dict['categories'] = array();
//     //$katz = array();
//     foreach ($xml->vespaadd as $question) {
//         //pre($question);
//         // if(!in_array((string)$question->document->maincat, $katz)){

//         //      $katz[]=(string)$question->document->maincat;
//         // }
//         $dict['categories'][(string)$question->document->maincat]['subjects'][] = (string) $question->document->subject;
       
//         $dict['categories'][(string)$question->document->maincat]['contents'][] = (string)$question->document->content;

//         $dict['categories'][(string)$question->document->maincat]['answers'][] = htmlentities((string)$question->document->bestanswer);


//         foreach($question->document->nbestanswers->answer_item as $answer){
//             $dict['categories'][(string)$question->document->maincat]['answers'][] = (string)$answer;
//         }

       
//         if(!isset($dict['categories'][$question['maincat']][$question['cat'])){
//             $dict['categories'][$question['maincat']][$question['cat']] = array();
//         }

//         if(!isset($dict['categories'][$question['maincat']][$question['cat'][$question['subcat']])){
//             $dict['categories'][$question['maincat']][$question['cat']][$question['subcat']] = array();
//         }
//         $dict['categories'][$question['maincat']][$question['cat']][$question['subcat']] = $question['subcat'];







//     $c++;

//  if($c == 5000){
//     break;

//  }
// }
//  //die(json_encode($katz));


    
    



    // $file = fopen('test.txt','w');
    // fwrite($file, json_encode($dict));
    // fclose($file);
    // die;
//die(json_encode($dict));


//node markov.js category type numberOfSentences
    function generateQuestionTitle($cat){

            $data = array('category'=>htmlspecialchars($cat), 'type'=>'subjects', 'quantity'=>'1');
            $json_data = json_encode($data);
            $placeholder = "<div class='placeholder hidden'>$json_data</div>";
            return $placeholder;



        // $cat = escapeshellarg($cat);
        // $cmd = "node markov.js $cat subjects 1";
     
        // return passthru($cmd);
    }

    function generateQuestionText($cat){
     
        $data = array('category'=>htmlspecialchars($cat), 'type'=>'contents', 'quantity'=>(string)(rand(1,5)));
            $json_data = json_encode($data);
            $placeholder = "<div class='placeholder hidden'>$json_data</div>";
            return $placeholder;
    }

    function generateAnswer($cat){

        $data = array('category'=>htmlspecialchars($cat), 'type'=>'answers', 'quantity'=>(string)rand(1,6));
            $json_data = json_encode($data);
            $placeholder = "<div class='placeholder hidden'>$json_data</div>";
            return $placeholder;
    }

    function avatar(){
        if(rand() % 2 == 0){
        return "https://web.archive.org/web/20060207103517im_/http://img.avatars.yahoo.com/users/1jT5SzZQfAAEDVIJTsIyd0U38GA==.medium.jpg";

        }

        return "https://web.archive.org/web/20060221005654im_/http://img.avatars.yahoo.com/users/1CsbxgiEhAAICP4E_FItLNJNQk7oC.medium.jpg";
    }

    function generateCategory(){
        $categories = ["Pregnancy & Parenting","Travel","Science & Mathematics","Home & Garden","Education & Reference","Business & Finance","Food & Drink","Cars & Transportation","Politics & Government","Games & Recreation","Society & Culture","Family & Relationships","Entertainment & Music","Sports","Consumer Electronics","Health","Pets","News & Events","Arts & Humanities","Dining Out","Social Science","Beauty & Style","Local Businesses"];
     
        return $_GET['category'] ?? $categories[array_rand($categories)];


    }

    function generateSubcat($cat, $dict){
         // $key = array_rand($dict['categories'][$cat]);
         // return $dict['categories'][$cat][$key];
        return '';
    }


    function username(){
        if(rand() % 2 == 0){
            return "daddysgrl4266";
        }
        if(rand() % 2 == 0){
            return "theDOnald";
        }
        return "dickbag";
    }

    $category = generateCategory();
    $subcategory = '';

    $categories = ["Pregnancy & Parenting","Travel","Science & Mathematics","Home & Garden","Education & Reference","Business & Finance","Food & Drink","Cars & Transportation","Politics & Government","Games & Recreation","Society & Culture","Family & Relationships","Entertainment & Music","Sports","Consumer Electronics","Health","Pets","News & Events","Arts & Humanities","Dining Out","Social Science","Beauty & Style","Local Businesses"];
    //pre($subcategory);


    //die;
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rita/1.3.85/rita-full.min.js"></script>
<script>
    
$(function() {
   
$.get('dictionary.json', function(data){


        const dict = data;

        
     

       $('.placeholder').each(function(){

        console.log($(this).html());
        if($(this).html() != ''){
        var params = JSON.parse($(this).html());
        console.log(params);

        var decodedCat = params.category.replace('&amp;', '&')
        $(this).html(generate(decodedCat, params.type, params.quantity, dict))
        }
        $(this).removeClass('hidden')


       })





});





function generate(category, type, quantity, dict){
    var corpusArray = dict.categories[category][type]
    //console.log(corpusArray);
    //console.log(corpusArray);

    var rm = new RiMarkov(2);
    rm.loadText(corpusArray.join(' '));

    sentences = rm.generateSentences(quantity);

    return(sentences.join(' '))


}
});


</script>

<style>
    .hidden{
        display: none;
    }

</style>



<link rel="stylesheet" type="text/css" href="https://web.archive.org/static/css/banner-styles.css?v=1538596186.0" />
<link rel="stylesheet" type="text/css" href="https://web.archive.org/static/css/iconochive.css?v=1538596186.0" />
<!-- End Wayback Rewrite JS Include -->

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta http-equiv="Content-Style-Type" content="text/css"/>
<meta http-equiv="Content-Script-Type" content="text/javascript"/>
<!--<link rel="stylesheet" href="http://us.i1.yimg.com/us.yimg.com/lib/common/fonts_200502080901.css" />-->
<style type="text/css">
/* <![CDATA[ */
@import "https://web.archive.org/web/20060207103517cs_/http://answers.yahoo.com:80/css/k-search-layout-1_174.css";@import "https://web.archive.org/web/20060207103517cs_/http://answers.yahoo.com:80/css/k-search-blue-styles-1_157.css";/* ]]> */
</style>
<!--[if IE]>
<style type="text/css"> body {word-wrap: break-word;} </style>
<![endif]-->


	<title>Yoohoo! Answers</title>
	<meta name="description" content="Yoohoo! Answers - 10 + 10 = 12 right,but 10 + 10 = 11 how come.u need a lot of thinking for this question.?"/>
<link rel="alternate" type="application/rss+xml" title="Yoohoo! Answers" href=""/>
</head>
<body>
<a name="top"></a>
<div id="y-ks-whole-page">
<div id="y-ks-header" align="center">
<!-- Y! Global -->
<style type="text/css"><!-- @import url("https://web.archive.org/web/20060207103517cs_/http://us.a1.yimg.com/us.yimg.com/lib/hdr/ygma_200506171349.css");body{margin:0px 4px;} --></style><div align="center" id="ygma"><form name="yhdr_form" style="margin:0" action="https://web.archive.org/web/20060207103517/http://srd.yahoo.com/loc=head&amp;st=yahoo/*http://search.yahoo.com/search" target="_blank"><input type="hidden" name="fr" value="ks"><table width="750" cellpadding="0" cellspacing="0" border="0" style="padding-top:2px;"><tr bgcolor="#efefef"><td id="ygmalinks" class="ygmabk" width="100%" colspan="3"><font face="arial,helvetica,sans-serif" size="-2"><a href="https://web.archive.org/web/20060207103517/http://www.yahoo.com/" target="_top"><font color="#000000">Yoohoo!</font></a> &nbsp; <a href="https://web.archive.org/web/20060207103517/http://my.yahoo.com/" target="_top"><font color="#000000">My Yoohoo!</font></a> &nbsp; <a href="https://web.archive.org/web/20060207103517/http://mail.yahoo.com/" target="_top"><font color="#000000">Mail</font></a>

<noscript><img width="1" height="1" alt="" src="https://web.archive.org/web/20060207103517im_/http://bc.us.yahoo.com/b?P=6ZWOeELaS.ZifT5zQwSTRgA02JE2nkM8ab0AABVr&amp;T=13u008n92%2fX%3d1128032701%2fE%3d81121452%2fR%3dnews%2fK%3d5%2fV%3d2.1%2fW%3d8%2fY%3dYAHOO%2fF%3d2098075231%2fQ%3d-1%2fS%3d1%2fJ%3d9FA949D1&amp;U=129om5h7k%2fN%3dEacRBNFJq2g-%2fC%3d-1%2fD%3dHMYYH%2fB%3d-1"></noscript></font></td><td class="ygmatcrn"><spacer type="block" width="1" height="1"></td><td class="ygmabk" rowspan="2"><img src="https://web.archive.org/web/20060207103517im_/http://us.i1.yimg.com/us.yimg.com/i/us/nt/hdr/stw.gif" width="34" height="17" border="0" hspace="4" vspace="2" alt="Search the web"></td><td id="ygmasearch" class="ygmabk" rowspan="2" nowrap><font face="verdana,geneva,sans-serif" size="-2"><input type="text" name="p" size="12" title="Enter search terms here" maxlength="100"> <input class="ygbt" type="submit" value="Search" title="Search"></font></td></tr><tr><td rowspan="2" valign="top"><a href="index.php"><img id="ygmalogo" src="logo.gif" border="0" alt="Yoohoo! Answers"></a></td><td id="ygmagreet" width="100%" rowspan="2"><font face="verdana,geneva,sans-serif" size="-2">
[<a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com/my/login?.page=p1&amp;.intl=us&amp;.src=&amp;.done=http://answers.yahoo.com%2Fquestion%2Findex%3Fqid%3D1006020112442" target="_top">Sign In</a>, 
<a href="https://web.archive.org/web/20060207103517/http://edit.yahoo.com/config/eval_profile?.done=http://answers.yahoo.com%2Fquestion%2Findex%3Fqid%3D1006020112442" target="_top">My Account</a>]
</font></td><td rowspan="2"></td><td class="ygmacrn" width="13" height="14" valign="top" nowrap><spacer type="block" width="13" height="14"></td></tr><tr><td colspan="3" align="right" id="ygmaproplinks" style="padding-right:5px;"><font face="verdana,geneva,sans-serif" size="-2"><a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com/" target="_top">Home</a> - <a href="https://web.archive.org/web/20060207103517/http://help.yahoo.com/l/us/yahoo/answers/">Help</a> - <a href="https://web.archive.org/web/20060207103517/http://messages.next.yahoo.com/next/forumview?bn=SEA-YoohooAnswers">Forum</a><br><a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/info/about" target="_top">What's going on in Answers?</a></font></td></tr></table></form></div>
</div> <!-- /end header -->

<div id="y-ks-mini-banner" align="center">
    <div id="y-ks-header-container">
                
    				
        <div id="y-ks-mini-header-bucket-1" class="y-ks-mini-header-bucket"><a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/question/?link=ask"><img src="https://web.archive.org/web/20060207103517im_/http://us.i1.yimg.com/us.yimg.com/i/geo/advan/spacer.gif" width="236" height="40" border="0"/></a></div>
        <div id="y-ks-mini-header-bucket-2" class="y-ks-mini-header-bucket"><a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/dir/?link=ask&amp;more=y"><img src="https://web.archive.org/web/20060207103517im_/http://us.i1.yimg.com/us.yimg.com/i/geo/advan/spacer.gif" width="236" height="40" border="0"/></a></div>
        <div id="y-ks-mini-header-bucket-3" class="y-ks-mini-header-bucket"><a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/dir/?link=over&amp;more=y"><img src="https://web.archive.org/web/20060207103517im_/http://us.i1.yimg.com/us.yimg.com/i/geo/advan/spacer.gif" width="236" height="40" border="0"/></a></div>

        
        </div>
</div>


<div id="y-ks-header-user-profile">
    <a class="light" href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/question/?link=ask">Ask Your Question</a> | 	<a class="light" href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/my/my">My Q&amp;A</a>

		
    <div id="y-ks-header-user-profile-widget">
        <div id="y-ks-header-user-profile-widget-msg-2" class="hide" style="z-index:1001;"></div>
        <div id="y-ks-header-user-profile-widget-msg-1" class="show" style="z-index:1002;">    
        			            This is not Yahoo Answers. No affiliation with Yahoo or Oath is implied. More Info...
                </div> <!--msg1-->
        <div class="top-only">&nbsp;</div>
        <div class="bottom-only">&nbsp;</div>
    </div>

	
	
</div>

        <!--<div id="banner"><img src="http://us.i1.yimg.com/us.yimg.com/i/us/sch/gr/header.jpg"></div>-->
        
            <div id="y-body-green-knowledge-search">
	    <div id="bread-crumb">
            <!-- breadcrumb path -->
                                <a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/">Home</a></a>                                                 &gt; <a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/dir/?sid=396545122"><?=$category?></a>                                                 &gt; <a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/dir/?sid=396545161"><?=$subcategory?></a>                                                 &gt; Open Question                <!-- /breadcrumb path -->
        </div>
        <div id="header">&nbsp;</div> 
        <div id="content">
        <div id="left">
            	<div id="search-area" class="sidebar-box">
    <h2 class="header">Search for questions &amp; answers</h2>
    <div id="form-wrapper">
    <form action="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/search/search_result" target="_parent">
        <input type="text" name="p" value="" id="search-text"/><input type="submit" id="search-submit" class="alt-button" value="Search" align"right"/>
        <div id="advanced-wrapper"> 
	<a class="subtle" href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/search/search_advance">Advanced Search</a> 
        </div>
    </form>
    </div>
</div>
       	    

<div class="sidebar-box rss-box">
<b>What is going on here?</b>
<br>
This is a project by <a href='http://calebcalebcaleb.com'>Caleb Savage</a> for a Data Art class at NYU ITP.<br><br>
RiTa.js and markov chains are used to generate semi-nonsense after being fed a large dataset of questions and answers circa 2006.
<br><br>
Select a category below to see a generative Q&A based on text from that category.
<br><br><a href="https://github.com/calebsavage/itp-data-art/tree/master/section2">
More info on Github

</a>
</div>
            <h2 class="header">Categories</h2>
            <div id="categories">
                    <div id="cat-undo">
	<ul>	<li><a class="subtle" href=""><!--!-->
        All Categories<!--!--></a></li>	<li class="current-undo"><a class="subtle" href="?category=<?=$category?>">
        <?=$category?></a></li>	</ul>
	</div>    <ul>   




        <?php foreach($categories as $cat):?>
            <li
            <?php if($cat == $category){echo " class='active' ";}?>>
                <a class="subtle" href="?category=<?=urlencode($cat)?>">
                <?=$cat?>
            </a>
            </li>
        <?php endforeach;?>

     </ul>


                </div>
	            </div>
        <div id="middle">
		<h1 class="nohat dkOpen">Open Question</h1>
    <!-- 1st pass view -->        
        
          
        <div class="question-listing">
    <span class="colorDKOpen"><h2>Accepting answers&nbsp;<span class="y-ks-debug-style">q</span></h2></span>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="" style="margin-top:10px;">
    <div style="padding:0!important;"><form name="question_template_form" method="get" action="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/question/act">
    <input type="hidden" name="qid" value="1006020112442"/><input type="hidden" name="link" value=""/><input type="hidden" name=".crumb" value="">
    </form></div>
        <tr><td class="table-left" rowspan="2">
        <a title="View Gay's profile!" href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/my/profile?show=AA10265167"><img class="picture" src="<?=avatar()?>" align="absmiddle" width="48" border="0"></a><br/><a title="View Gay's profile!" href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/my/profile?show=AA10265167"><span><?=userName()?></span></a><br/><small>5 days ago</small><br/>        <p>
        <em>
        <!-- else   -->1 day(s) left to answer.        </em>
                    <p class="abuse-report"><span class="arrow"><a title="Report abuse!" href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/question/accuse_write?qid=1006020112442&amp;kid=AA1d5eq6edqm&amp;s=q&amp;date=2006-02-01+17%3A42%3A38&amp;.crumb=">Report Abuse</a></span></p>
                </p>
        </td>
        <td class="bg-icon-question"><!-- List Question -->
               
                <div style='font-size:14pt'>
               <?=generateQuestionTitle($category)?> 
           </div>
                <p class="insert-margin ks-question-answer-container">
    		    <?=generateQuestionText($category)?>                
            </p>
                                <div style="width:200px;float:right;">
                                </div>
                </td></tr>  
                <tr><td valign="bottom" align="right">
                                    <form name="answerForm" action="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/question/" method="get"><input type="hidden" name="link" value="answer"/>
                        <input type="hidden" name=".crumb" value=""/>
                        <input type="hidden" name="qid" value="1006020112442"/>
                        <input type="hidden" name=".done" value="http%3A%2F%2Fanswers.yahoo.com%2Fquestion%2Findex%3Fqid%3D1006020112442"/>
                       
                        <noscript><input type="submit" value="Answer" class="button"/></noscript>
        		    </form>
		                            </td></tr>
                                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="ks-qa-action-bar">
                    <tr>
                                        <td align="right">
            		<!--<div class="dotted-line"></div>-->
                                        <span class="arrow"><a style="font-weight:bold;" href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/question/?qid=1006020112442&amp;link=mailto">Email Question</a></span>
                                            <span class="arrow"> | <a style="font-weight:bold;" href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/my/my_add_trace_q?qid=1006020112442&amp;expires=1139449358&amp;.crumb=">Add to Watch List</a></span>
                    		                <div class="dotted-line"></div>
                        </td>
                    </tr></table>
                    		    </div> <!-- question-listing -->
        

      <!-- answer-->
    <!-- danswer js 傳送 -->
	<form name="form_ans" method="get" action="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/question/act">
	   <input type="hidden" name="qid" value="">
	   <input type="hidden" name="link" value="owner_dans">
	   <input type="hidden" name=".crumb" value="">
	</form>
	<!-- /danswer js over -->

    <!-- VoteOn js 傳送 -->
	<form name="form_voteon" method="get" action="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/question/act">
	   <input type="hidden" name="qid" value="">
	   <input type="hidden" name="kid" value="">
	   <input type="hidden" name="link" value="vote_on">
	   <input type="hidden" name=".crumb" value="">
    </form>
	<!-- /VoteOn js over -->

    
    <h1 class="question-answer-title">Answers</h1>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-collection-of-items">

<?php for($x=0;$x<rand(1,9);$x++):?>
                    <tr><td class="table-left">

                    <a title="View daddysgrl4266's profile!" href=""><img class="picture" src="<?=avatar()?>" align="absmiddle" width="48" border="0"></a><br/><a title="View daddysgrl4266's profile!" href=""><span><?=username()?></span></a><br/><small>5 days ago</small><br/>                        <br/> 
                                                <p class="abuse-report"><span class="arrow"><a title="Report abuse!" href>Report Abuse</a></span></p>
                                                </td>
                        <td class="bg-icon-answer">
                        <p class="ks-question-answer-container">                               
                            <?=generateAnswer($category)?>     </p>

                                                        </td>
                        </tr style="border-bottom: 1px solid grey">

                 <?php endfor;?>




    	                <form name="answer_template_form" method="get" action="" onsubmit="return doCheckAnswerFormSubmit(this);">
    	                    <input type="hidden" name="qid" value=""/>
    	                    <input type="hidden" name="kid" value=""/>
    	                    <input type="hidden" name="link" value=""/>
    	                    <input type="hidden" name=".crumb" value="">
    	                </form>
                    </table>
                    
                    <div class="dotted-line"></div>
	                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-collection-of-items">
                    
    	                <form name="answer_template_form" method="get" action="" onsubmit="return doCheckAnswerFormSubmit(this);">
    	                    <input type="hidden" name="qid" value=""/>
    	                    <input type="hidden" name="kid" value=""/>
    	                    <input type="hidden" name="link" value=""/>
    	                    <input type="hidden" name=".crumb" value="">
    	                </form>
                    </table>
                 
    
      <!-- new qa -->
    <div id="ks-new-qa">
	 
	<div class="question-listing section-listing">
        <h2>Open questions<span style="font-weight:normal;"> in </span><a href=""><?=$category?></a></h2>
        
         
        
        <ul>
                    
                <?php for($i=0;$i<5;$i++):?>
                <?php $question = generateQuestionTitle($category)?>
                <li><a href="?category=<?=urlencode($category)?>"><?=$question?></a></li>
            
            
            
                    
                        
                
                <?php endfor;?>
            
                </ul>
                
        
        
	</div>
        <!-- /new qa -->
    <!-- new knowledge -->
    <div class="dotted-line" style="margin:18px 0 14px 0;"></div>	      
	<div class="question-listing section-listing">
        <h2>Resolved questions<span style="font-weight:normal;"> in </span><a href=""><?=$category?></a></h2>
        
          
        
        <ul>
	                
                    
                <li><a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/question/?qid=1006020500240">What is an &quot;undefined expression?&quot;?</a></li>
        
            
            
                    
                    
                <li><a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/question/?qid=1006012308028">Help me in solving this?</a></li>
        
            
            
                    
                    
                <li><a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/question/?qid=1006012308037">Can u help me its urgent ?</a></li>
        
            
            
                    
                    
                <li><a href="https://web.archive.org/web/20060207103517/http://answers.yahoo.com:80/question/?qid=1006012308013">Urgent help needed?</a></li>
        
            
            
                </ul>
                
        
	
    </div>
        </div>
	<!-- /new knowledge -->
        <!-- /end -->
</div>
<!-- /end -->
</div><!-- /close center -->
</div><!-- /close content -->

<div id="y-ks-footer">
<div class="dotted-line"></div>
    <div class="spacer" style="height:10px;"></div>
      	<p class="disclosure">
        This is not Yahoo Answers, this is Yoohoo Answers.
    </p>
    <p class="disclosure">
        "You can tell the character of a man by the way he eats his jelly beans" - Ronald Reagan
    </p>
    <p>
        <small>

        </small>
    </p>
</div>
</div> <!--/y-ks-whole-page-->
<div id="y-ks-error-log"></div>
<!-- SpaceID=0 robot -->
</body></html>


<!-- view --><!-- ksw4.search.mud.yahoo.com uncompressed Tue Feb  7 02:35:17 PST 2006 -->
<!--
     FILE ARCHIVED ON 10:35:17 Feb 07, 2006 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 06:42:42 Oct 28, 2018.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
-->
<!--
playback timings (ms):
  LoadShardBlock: 460.318 (3)
  esindex: 0.006
  captures_list: 484.726
  CDXLines.iter: 14.18 (3)
  PetaboxLoader3.datanode: 140.449 (4)
  exclusion.robots: 0.206
  exclusion.robots.policy: 0.19
  RedisCDXSource: 7.152
  PetaboxLoader3.resolve: 33.287
  load_resource: 65.15
-->
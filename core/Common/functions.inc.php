<?php
namespace Common;

function LoadClass($className)
{
  $pieces = explode("\\", $className);
  $fileName = '';
  foreach($pieces AS $piece)
    $fileName .= $piece.'/';
  $fileName[strlen($fileName)-1] = '.';
  $fileName .= 'class.php';
  if(file_exists(NAMESPACE_CUSTOM.$fileName))
    $fileName = NAMESPACE_CUSTOM.$fileName;
  else if(file_exists(MINT_ROOT.$fileName))
    $fileName = MINT_ROOT.$fileName;
  else
    throw new \Exception('Class "'.$className.'" cannot be loaded. File not found.');
  include($fileName);
}

function hash($string)
{
  return \hash('sha512', $string);
}

function Shutdown($renderer, $template, $context, $log)
{
  $context->PageGenerationTime = microtime() - "$context->PageStartTime";
  try
  {
    if($error = error_get_last())
      $log::ErrorHandler($error['type'], $error['message'], $error['file'], $error['line'], array());

    //Fill and output template with data
    $template::Output($renderer, $context);
  }
  catch(\Exception $e)
  {
    $log::ExceptionHandler($e, $context);
    $template::Output($renderer, $context);
  }
  ob_end_flush();
}

function UriToArray(&$Uri)
{
  $pathArray = explode('/', $Uri);
  array_shift($pathArray);
  $tempArray = explode('?', $pathArray[count($pathArray)-1]);
  $pathArray[count($pathArray)-1] = $tempArray[0];
  if(!end($pathArray))
    array_pop($pathArray);
  return $pathArray;
}

function GetLastPhrase(&$Uri)
{
  $pathArray = explode('/', $Uri);
  $tempArray = explode('?', $pathArray[count($pathArray)-1]);
  $pathArray[count($pathArray)-1] = $tempArray[0];

  return end($pathArray);
}

function GetSubDomain()
{
  $array = explode('.', preg_replace('/^(?:([^\.]+)\.)?domain\.com$/', '\1', $_SERVER['SERVER_NAME']));
  array_pop($array);
  return implode('.', $array);
}

/** 
 *  UrlLinker - facilitates turning plaintext URLs into HTML links. 
 * 
 *  Author: Søren Løvborg 
 * 
 *  To the extent possible under law, Søren Løvborg has waived all copyright 
 *  and related or neighboring rights to UrlLinker. 
 *  http://creativecommons.org/publicdomain/zero/1.0/ 
 */ 

/** 
 *  Transforms plain text into valid HTML, escaping special characters and 
 *  turning URLs into links. 
 */ 
function htmlEscapeAndLinkUrls($text) 
{ 
  /* 
   *  Regular expression bits used by htmlEscapeAndLinkUrls() to match URLs. 
   */ 

  $rexProtocol = '(https?://)?'; 
  $rexDomain   = '((?:[-a-zA-Z0-9]{1,63}\.)+[-a-zA-Z0-9]{2,63}|(?:[0-9]{1,3}\.){3}[0-9]{1,3})'; 
  $rexPort     = '(:[0-9]{1,5})?'; 
  $rexPath     = '(/[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]*?)?'; 
  $rexQuery    = '(\?[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?'; 
  $rexFragment = '(#[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?'; 
  $rexUrlLinker = "{\\b$rexProtocol$rexDomain$rexPort$rexPath$rexQuery$rexFragment(?=[?.!,;:\"]?(\s|$))}"; 

  /** 
   *  $validTlds is an associative array mapping valid TLDs to the value true. 
   *  Since the set of valid TLDs is not static, this array should be updated 
   *  from time to time. 
   * 
   *  List source:  http://data.iana.org/TLD/tlds-alpha-by-domain.txt 
   *  Last updated: 2010-09-04 
   */ 
  $validTlds = array_fill_keys(explode(" ", ".ac .ad .ae .aero .af .ag .ai .al .am .an .ao .aq .ar .arpa .as .asia .at .au .aw .ax .az .ba .bb .bd .be .bf .bg .bh .bi .biz .bj .bm .bn .bo .br .bs .bt .bv .bw .by .bz .ca .cat .cc .cd .cf .cg .ch .ci .ck .cl .cm .cn .co .com .coop .cr .cu .cv .cx .cy .cz .de .dj .dk .dm .do .dz .ec .edu .ee .eg .er .es .et .eu .fi .fj .fk .fm .fo .fr .ga .gb .gd .ge .gf .gg .gh .gi .gl .gm .gn .gov .gp .gq .gr .gs .gt .gu .gw .gy .hk .hm .hn .hr .ht .hu .id .ie .il .im .in .info .int .io .iq .ir .is .it .je .jm .jo .jobs .jp .ke .kg .kh .ki .km .kn .kp .kr .kw .ky .kz .la .lb .lc .li .lk .lr .ls .lt .lu .lv .ly .ma .mc .md .me .mg .mh .mil .mk .ml .mm .mn .mo .mobi .mp .mq .mr .ms .mt .mu .museum .mv .mw .mx .my .mz .na .name .nc .ne .net .nf .ng .ni .nl .no .np .nr .nu .nz .om .org .pa .pe .pf .pg .ph .pk .pl .pm .pn .pr .pro .ps .pt .pw .py .qa .re .ro .rs .ru .rw .sa .sb .sc .sd .se .sg .sh .si .sj .sk .sl .sm .sn .so .sr .st .su .sv .sy .sz .tc .td .tel .tf .tg .th .tj .tk .tl .tm .tn .to .tp .tr .travel .tt .tv .tw .tz .ua .ug .uk .us .uy .uz .va .vc .ve .vg .vi .vn .vu .wf .ws .xn--0zwm56d .xn--11b5bs3a9aj6g .xn--80akhbyknj4f .xn--9t4b11yi5a .xn--deba0ad .xn--fiqs8s .xn--fiqz9s .xn--fzc2c9e2c .xn--g6w251d .xn--hgbk6aj7f53bba .xn--hlcj6aya9esc7a .xn--j6w193g .xn--jxalpdlp .xn--kgbechtv .xn--kprw13d .xn--kpry57d .xn--mgbaam7a8h .xn--mgbayh7gpa .xn--mgberp4a5d4ar .xn--o3cw4h .xn--p1ai .xn--pgbs0dh .xn--wgbh1c .xn--xkc2al3hye2a .xn--ygbi2ammx .xn--zckzah .ye .yt .za .zm .zw"), true); 

  $result = ""; 

  $position = 0; 
  while (preg_match($rexUrlLinker, $text, $match, PREG_OFFSET_CAPTURE, $position)) 
  { 
    list($url, $urlPosition) = $match[0]; 

    // Add the text leading up to the URL. 
    $result .= htmlspecialchars(substr($text, $position, $urlPosition - $position)); 

    $domain = $match[2][0]; 
    $port   = $match[3][0]; 
    $path   = $match[4][0]; 

    // Check that the TLD is valid or that $domain is an IP address. 
    $tld = strtolower(strrchr($domain, '.')); 
    if (preg_match('{^\.[0-9]{1,3}$}', $tld) || isset($validTlds[$tld])) 
    { 
      // Prepend http:// if no protocol specified 
      $completeUrl = $match[1][0] ? $url : "http://$url"; 

      // Add the hyperlink. 
      $result .= '<a href="' . htmlspecialchars($completeUrl) . '" rel="nofollow" target="_blank">' 
        . htmlspecialchars("$domain$port$path") 
        . '</a>'; 
    } 
    else 
    { 
      // Not a valid URL. 
      $result .= htmlspecialchars($url); 
    } 

    // Continue text parsing from after the URL. 
    $position = $urlPosition + strlen($url); 
  } 

  // Add the remainder of the text. 
  $result .= htmlspecialchars(substr($text, $position)); 
  return $result; 
} 
?>

<?php
 
$wgExtensionCredits['parserhook'][] = array(
        'path' => __FILE__,
        'name' => "Parser function to check if a user is registered",
        'description' => "Returns nonempty string if current user is logged in, and an empty string otherwise",
        'version' => "0.1",
        'author' => "Pavel Shved",
        'url' => "http://example.com/"
);
 
// Specify the function that will initialize the parser function.
$wgHooks['ParserFirstCallInit'][] = 'efPropiska_Initialize';
// Specify the function that will register the magic words for the parser function.
$wgHooks['LanguageGetMagic'][] = 'efPropiska_RegisterMagicWords';
 
// Tell MediaWiki that the parser function exists.
function efPropiska_Initialize(&$parser) {
        // Create a function hook associating the "revealEmail" magic word with the
        // efPropiska_Render() function.
        $parser->setFunctionHook('propiska', 'efPropiska_Render');
        // Return true so that MediaWiki continues to load extensions.
        return true;
}
 
// Tell MediaWiki which magic words can invoke the parser function.
function efPropiska_RegisterMagicWords(&$magicWords, $langCode) {
        // If the first element of the array is 0, the magic word is case insensitive.
        // If the first element of the array is 1, the magic word is case sensitive.
        // The remaining elements in the array are "synonyms" for the magic word.
        $magicWords['propiska'] = array(0, 'propiska');
        // Return true so that MediaWiki continues to load extensions.
        return true;
}
 
// Render the output of the parser function.
function efPropiska_Render($parser, $username = '') {
	global $wgUser;
        #$user = User::newFromName($username);
        if (! $wgUser->getId()) {
          $output = "";
        }
        else {
          $output = "yes";
        }
        return $output;
}
// eof

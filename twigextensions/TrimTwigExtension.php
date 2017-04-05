<?php
/**
 * Trim plugin for Craft CMS
 *
 * Trim Twig Extension
 *
 * @author    HutSix
 * @copyright Copyright (c) 2017 HutSix
 * @link      https://hutsix.com.au
 * @package   Trim
 * @since     1.0.0
 */

namespace Craft;

class TrimTwigExtension extends \Twig_Extension
{
    /**
     * @return string The extension name
     */
    public function getName()
    {
        return 'Trim';
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            'trimit' => new \Twig_Filter_Method($this, 'trim'),
        );
    }

    /**
    * @return array
     */
    public function getFunctions()
    {
        return array(
            'trimit' => new \Twig_Function_Method($this, 'trim'),
        );
    }

    /**
     * @param $text
     * @param int $length
     * @param bool $word
     * @param string $ellipsis
     * @param bool $spacing
     * @param bool $removeDoubleSpacing
     * @return string
     */
    public function trim($text, $length = 100, $word = true, $ellipsis = "...", $removeDoubleSpacing = true)
    {
        $length = (!is_numeric($length)) ? 100 : $length;

        $text = $this->_strip_html_tags($text);

        if ($removeDoubleSpacing) {
            $text = $this->_strip_double_whitespace($text);
        }

        if(strlen($text) > $length)
        {
            $text = ( ($word) ? $this->_truncateByWord($text, $length) : substr($text,0,$length) ).$ellipsis;
        }

        return $text;
    }

    private function _truncateByWord($str, $length)
    {
        // Truncate text to ending of last word before length limit is reached
        $str = substr($str, 0, $length);
        $str = substr($str, 0, strrpos($str," "));

        // Removes puncuation if included on the last word
        return preg_replace("/\.\W*$/", "", $str);
    }

    private function _strip_double_whitespace($text)
    {
        return preg_replace("/[^\S\n]{2,}/", " ", $text);
    }

    private function _strip_html_tags($text)
    {
        $text = htmlspecialchars_decode($text);
        $text = trim(str_replace("&nbsp;", " ", $text));
        $text = preg_replace(
            array(
                // Remove invisible content
                '@<head[^>]*?>.*?</head>@siu',
                '@<style[^>]*?>.*?</style>@siu',
                '@<script[^>]*?.*?</script>@siu',
                '@<object[^>]*?.*?</object>@siu',
                '@<embed[^>]*?.*?</embed>@siu',
                '@<applet[^>]*?.*?</applet>@siu',
                '@<noframes[^>]*?.*?</noframes>@siu',
                '@<noscript[^>]*?.*?</noscript>@siu',
                '@<noembed[^>]*?.*?</noembed>@siu',
                // Add line breaks before and after blocks
                '@</?((address)|(blockquote)|(center)|(del))@iu',
                '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
                '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
                '@</?((table)|(th)|(td)|(caption))@iu',
                '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
                '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
                '@</?((frameset)|(frame)|(iframe))@iu',
                '@</?((article)|(section)|(address)|(header)|(footer)|(figure)|(nav)|(aside))@iu',
            ),
            array(
                ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
                "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
                "\n\$0", "\n\$0", "\n\$0",
            ),
            $text );
        return strip_tags($text);
    }
}
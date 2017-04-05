<?php
/**
 * Trim plugin for Craft CMS
 *
 * Smart truncating based on Roi Kingon Trimmer
 *
 * @author    HutSix
 * @copyright Copyright (c) 2017 HutSix
 * @link      https://hutsix.com.au
 * @package   Trim
 * @since     1.0.0
 */

namespace Craft;

class TrimPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
         return Craft::t('Trim');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('Smart truncating based on Roi Kingon Trimmer');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return 'https://github.com/hut6/trim/blob/master/README.md';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/hut6/trim/master/releases.json';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'HutSix';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'https://hutsix.com.au';
    }

    /**
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function addTwigExtension()
    {
        Craft::import('plugins.trim.twigextensions.TrimTwigExtension');

        return new TrimTwigExtension();
    }
}
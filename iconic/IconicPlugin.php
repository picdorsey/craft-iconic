<?php
/**
 * Iconic plugin for Craft CMS
 *
 * Adds Font Awesome Icons to Redactor II
 *
 * @author    Nicholas O'Donnell
 * @copyright Copyright (c) 2016 Nicholas O'Donnell
 * @link      http://nicholasodo.com
 * @package   Iconic
 * @since     1.0.0
 */

namespace Craft;

class IconicPlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init()
    {
        parent::init();
        if (craft()->request->isCpRequest()) {
            $this->_renderCSS();
            $this->_renderJS();
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
         return Craft::t('Iconic');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return Craft::t('Adds Font Awesome Icons to Redactor II.');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return 'https://github.com/nicholasodo/craft-iconic/blob/master/README.md';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/nicholasodo/craft-iconic/master/releases.json';
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
    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'Nicholas O\'Donnell';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'http://nicholasodo.com';
    }

    /**
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }

    /**
     */
    public function onBeforeInstall()
    {
    }

    /**
     */
    public function onAfterInstall()
    {
    }

    /**
     */
    public function onBeforeUninstall()
    {
    }

    /**
     */
    public function onAfterUninstall()
    {
    }

    /**
     * @return array
     */
    protected function defineSettings()
    {
        return [
            'cdnLink' => [
                AttributeType::Mixed,
                'label' => 'CDN Link',
                'default' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'
            ],
            'icons' => [
                AttributeType::Mixed,
                'label' => 'Icons',
                'default' => '[["html","<i class=\"fa fa-code\" aria-hidden=\"true\"><\/i>"],["format","<i class=\"fa fa-paragraph\" aria-hidden=\"true\"><\/i>"],["lists","<i class=\"fa fa-list\" aria-hidden=\"true\"><\/i>"],["link","<i class=\"fa fa-link\" aria-hidden=\"true\"><\/i>"],["horizontalrule","<i class=\"fa fa-minus\" aria-hidden=\"true\"><\/i>"],["image","<i class=\"fa fa-picture-o\" aria-hidden=\"true\"><\/i>"],["video","<i class=\"fa fa-video-camera\" aria-hidden=\"true\"><\/i>"],["file","<i class=\"fa fa-paperclip\" aria-hidden=\"true\"><\/i>"],["table","<i class=\"fa fa-table\" aria-hidden=\"true\"><\/i>"],["alignment","<i class=\"fa fa-align-left\" aria-hidden=\"true\"><\/i>"]]'
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function getSettingsHtml()
    {
       return craft()->templates->render('iconic/Iconic_Settings', array(
           'settings' => $this->getSettings()
       ));
    }

    /**
     * @param mixed $settings  The Widget's settings
     *
     * @return mixed
     */
    public function prepSettings($settings)
    {
        // Modify $settings here...

        return $settings;
    }

    /**
     * Renders CP css
     */
    private function _renderCSS()
    {
        $cdnLink = $this->getSettings()->cdnLink;

        craft()->templates->includeCssFile($cdnLink);
    }

    /**
     * Renders CP JS
     */
    private function _renderJS()
    {
        $icons = $this->getSettings()->icons;

        // var_dump(json_encode($icons));
        // die();

        craft()->templates->includeJs('
            var iconsFromSettings = ' . json_encode($icons) . ';
            var icons = [];
            iconsFromSettings.forEach(function (element, index, array) {
                icons[element[0]] = element[1];
            });
        ');
        craft()->templates->includeJsResource('iconic/js/script.js');
    }

}
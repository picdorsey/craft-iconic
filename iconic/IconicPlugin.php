<?php
/**
 * Iconic plugin for Craft CMS
 *
 * Adds Font Awesome Icons to Redactor II
 *
 * @author    Piccirilli Dorsey, Inc. (Nicholas O'Donnell)
 * @copyright Copyright (c) 2016 Piccirilli Dorsey, Inc. (Nicholas O'Donnell)
 * @link      http://picdorsey.com
 * @package   Iconic
 * @since     1.0.3
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
        return Craft::t('Replaces Redactor II toolbar words with Font Awesome icons.');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return 'https://github.com/picdorsey/craft-iconic/blob/master/readme.md';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/picdorsey/craft-iconic/master/releases.json';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.3';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1.0.1';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'Piccirilli Dorsey, Inc.';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'http://picdorsey.com';
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
     * Renders CP JS
     */
    private function _renderJS()
    {
        $icons = $this->getSettings()->icons;

        craft()->templates->includeJs('
            var iconsFromSettings = ' . json_encode($icons) . ';
            var icons = [];
            iconsFromSettings.forEach(function (element, index, array) {
                icons[element[0]] = element[1];
            });
        ');
        craft()->templates->includeJsResource('iconic/js/iconic_script.js');
    }

}

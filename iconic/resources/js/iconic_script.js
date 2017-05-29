/**
 * Iconic plugin for Craft CMS
 *
 * Iconic JS
 *
 * @author    Piccirilli Dorsey, Inc. (Nicholas O'Donnell)
 * @copyright Copyright (c) 2016 Piccirilli Dorsey, Inc. (Nicholas O'Donnell)
 * @link      http://picdorsey.com
 * @package   Iconic
 * @since     1.0.4
 */

if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.iconic = function() { return {
    /**
     * Redactor plugin initialization
     */
    init: function () {
        if (!icons) return;
        setTimeout(this.iconic.replaceWithIcons.bind(this), 10); // we have to wait for every other plugins..
    },

    replaceWithIcons: function () {

        $("a", this.$toolbar).each(function(i, a) {
            var $a = $(a), actionKey = $a.attr("rel");

            if (icons[actionKey]) {
                $a.html(icons[actionKey]);
            }
        });
    }
}; };

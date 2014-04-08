<?php

class SSViewerExtention extends DataExtension {
    
    /**
     * 
     * @param type $folder
     * @param type $contain a string that must be part of the return files name.
     * @return type Array A list of pathes to template files in the given folder.
     */
    static function getTemplates($folder = null, $contain = null) {
        if ($contain) {
            $FileNamePattern = "*$contain*.ss";
        } else {

            $FileNamePattern = "*.ss";
        }
        if ($folder) {
            $pattern = THEMES_PATH . "/" . self::CurrentTheme() . "/templates/$folder/$FileNamePattern";
        } else {
            $pattern = THEMES_PATH . "/" . self::CurrentTheme() . "/templates/$FileNamePattern";
        }
        $templates = glob($pattern);
        return $templates;

    }

    static function getTemplatesForDropdown($folder = null, $contain = null) {
        $map = array();
        $templates = self::getTemplates($folder, $contain);
        foreach ($templates as $value) {
            $template = basename($value, '.ss');

            $map[$template] = str_replace('_', ' : ', $template);
        }
//        debug::dump($map);
        return $map;

    }

    public static function CurrentTheme() {
        if ($CurrentTheme = SiteConfig::current_site_config()->Theme) {
            
        } else {
            $CurrentTheme = SSViewer::current_theme();
        }
        return $CurrentTheme;

    }

}
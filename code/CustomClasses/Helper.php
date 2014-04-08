<?php

class Helper extends DataObject {

    /**
     *  public static function findOrMakePageByURLSegment($URLSegment = Null, $ClassName = 'Page', $array = array())
     * @param type $URLSegment  
     * @param type $ClassName   
     * 
     */
    public static function findOrMakePageByURLSegment($URLSegment = Null, $ClassName = 'Page', $array = array()) {
        if (ClassInfo::exists($ClassName)) {
            $Page = Page::get_by_link($URLSegment);
            if (!$Page) {
                self::makePage($URLSegment, $ClassName, 0, $array);
            }
            return $Page;
        }
        return false;

    }

    /**
     *  public static function findOrMakePageByTitle($Title = Null, $ClassName = 'Page', $array = array()) {
     * @param type $URLSegment  
     * @param type $ClassName    
     * ToDO : better use of $array
     */
    public static function findOrMakePageByTitle($Title = Null, $ClassName = 'Page', $ParentID = 0, $array = array()) {
        if (ClassInfo::exists($ClassName)) {
            $Page = Page::get()->filter(array("Title" => $Title))->first();
            if (!$Page) {
                self::makePage($Title, $ClassName, $ParentID, $array);
            }

            return $Page;
        }
        return false;

    }

    /**
     * findOrMakePageByTitle($Title = Null, $ClassName = 'Page', $array = array()) 
     * Find a page with the same title and change classname if needed or create a page to match the arguments.
     * @param type $URLSegment  
     * @param type $ClassName    
     *  ToDO : better use of $array
     */
    public static function getPageByTitleAndClass($Title = Null, $ClassName = 'Page', $ParentID = 0, $array = array()) {
        if (ClassInfo::exists($ClassName)) {
            $Page = Page::get()->filter(array("Title" => $Title))->first();
//            Debug::dump($Page);
            if ($Page) {
                $Page = self::changeClassName($Page, $ClassName);
                $Page = self::updatePageContent($Page, array('ParentID' => $ParentID));
                DB::alteration_message("<b>$Title</b> : PageID = " . $Page->ID . " and ParentID = $ParentID");
            } else {
                $Page = self::makePage($Title, $ClassName, $ParentID, $array);
            }
            return $Page;
        }
        return false;

    }

    /**
     * 
     * @param type $Title
     * @param type $ClassName
     * @param type $ParentID
     * @param array $array
     * @return type
     */
    public static function getPage($Title = Null, $ClassName = 'Page', $ParentID = 0, $array = array()) {
        return self::getPageByTitleAndClass($Title, $ClassName, $ParentID, $array = array());

    }

    public static function findPage($URLSegment = Null) {
        $Page = Page::get_by_link($URLSegment);
        if ($Page) {

            return $Page;
        }
        return false;

    }

    /**
     * Change the ClassName of a givin page.
     * 
     * Description:
     *     
     * @param var $URLSegment
     *      Used:
     *      + In get_by_link()  to get the page
     * @param var $ClassName
     *      Used:
     *      + It will only change the class name if its differnt from the old one.
     * 
     */
    public static function changeClassName($URLSegmentOrObject = Null, $ClassName = Null) {
        if (ClassInfo::exists($ClassName)) {
            if (is_object($URLSegmentOrObject)) {
                $Page = $URLSegmentOrObject;
            } else {
                $URLSegment = $URLSegmentOrObject;
                $Page = Page::get_by_link($URLSegment);
            }

            if ($Page && ($Page->ClassName != $ClassName)) {
                $Page = $Page->newClassInstance($ClassName);
                $Page->write();
                $Page->publish("Stage", "Live");
            }

            return $Page;
        } else {
            
        }

    }

    /**
     *  Delete a single Page Object passed in through the $Page Param.
     * 
     * @param  $Page DataObject Must be a Page object.
     */
    public static function deletePage($Page = Null) {
        if ($Page) {
            DB::alteration_message("Page : PageName = $Page->Title , PageID = $Page->ID , 
                ClassName = $Page->ClassName , ParentID = $Page->ParentID  
                   was Deleted", "deleted");
//            $Page->deleteFromStage('Published');
            $Page->deleteFromStage('Live');
            $Page->deleteFromStage('Stage');
            $Page->delete();
            $Page->destroy();
        }

    }

    /**
     *  Delete Pages passed in as array
     * 
     * @param  $Pages ArrayList  Must be an ArrayList of pages.
     */
    public static function deletePages($Pages = Null) {

        foreach ($Pages as $Page) {
            self::deletePage($Page);
//            DB::alteration_message("page Delete LOOP");
        }

    }

    /**
     *  Remove all pages by $ClassName
     * 
     * Description:
     *      + deletePagesByClass($ClassName=Null)
     * 
     */
    public static function deletePagesByClass($ClassName = Null) {
        $getPagesByClass = DataObject::get('SiteTree')->filter(array('ClassName' => $ClassName));
        foreach ($getPagesByClass as $Page) {
            self::deletePage($Page);
        }

    }

    /**
     *   public static function makePage($PageTitle = Null, $ClassName = Null, $ParentID = 0, $array = array()) 
     * @param type $PageTitle
     * @param type $ClassName
     * @param type $ParentID
     * @param array $array = array to be passed to the page created. 
     * @return Object Return the page created.
     */
    public static function makePage($PageTitle = Null, $ClassName = Null, $ParentID = 0) {
        $Page = new $ClassName();
        $Page->Title = $PageTitle;
        $Page->ParentID = $ParentID;
        $Page->write();
        $Page->publish("Stage", "Live");
        DB::alteration_message("Page : PageName = $PageTitle , PageID = $Page->ID , 
                ClassName = $ClassName , ParentID = $ParentID  
                   was Created", "created");
        return $Page;

    }

    public static function makePages($PageTitle = Null, $ClassName = Null, $ParentID = 0, $Copies = 1) {
        $Pages = array();
        for ($i = 0; $Copies > $i; $i++) {
            $Page = self::makePage($PageTitle, $ClassName, $ParentID);
            $Pages[] = $Page;
        }
        return $Pages;

    }

    /**
     * 
     * @param type $Page Page Must be a page DataObject
     * @param type $array
     */
    public static function updatePageContent($Page = null, $array = array()) {
        if ($Page && $array) {
            if (is_object($Page)) {
                foreach ($array as $key => $value) {
                    if ($Page->$key != $value) {
                        $Page->$key = $value;
                    }
                }
                $Page->publish("Stage", "Live");
                $Page->write();
            }
            return $Page;
        }

    }

    //**********************************************
    /**
     * @var Demo::cleanDomain()
     * @var Director::absoluteBaseURL()
     * @return string
     */
    public static function getCleanDomain() {
        return self::cleanDomain(Director::absoluteBaseURL());
//         return self::cleanDomain('https://www.designerx.com.au/test/other/then/some');

    }

    /**
     * Removes  ('https://www.', 'http://www.', 'www.', 'http://', 'https://',) from a given domain.
     * 
     * @return string
     */
    public static function cleanDomain($url) {
        $var = parse_url($url);
        $url = $var['host'];
        $disallowed = array('https://www.', 'http://www.', 'www.', 'http://', 'https://',);
        foreach ($disallowed as $d) {
            if (strpos($url, $d) === 0) {
                return str_replace($d, '', $url);
            }
        }
        return $url;

    }

    //**********************************************
    /**
     *  Quickly create a member and add to group
     * 
     * Description:
     *      + here
     * @param var $PermisstionCodes string|array
     * @param var $MemberClassName Optional , Default 'Member'
     */
    public static function createMember($Name = Null, $Email = Null, $Password = Null, $PermisstionCodes = Null, $MemberClassName = 'Member') {

        $Member = Member::get()->filter(array('Email' => $Email))->first();
        $getGroups = Group::get()->filter(array('Code' => $PermisstionCodes));
        if (!$Member) {
            $Member = new $MemberClassName();
            $Member->FirstName = $Name;
            $Member->Email = $Email;
            $Member->Password = $Password;
            $Member->write();
            foreach ($getGroups as $getGroup) {
                $Member->Groups()->add($getGroup->ID);
            }
            DB::alteration_message("Member created : $Email", "created");
        } else {
            DB::alteration_message("This member already exixts.", "error");
        }
        return $Member;

    }

    //**********************************************
    /**
     * 
     * @param string $path 
     * @param boolean $relativeToCurrentTheme boolean
     * @param string $contains Return all templates that have $contains as part of the file name .
     * @return array() List of templates <b>without</b> the .ss at the end.
     */
    static function getTemplatesByPath($path = null, $contains = null, $relativeToCurrentTheme = true) {
        $files = array();
        $fileExt = '.ss';
//         $CurrentTheme = SiteConfig::current_site_config()->Theme;
//            $CurrentTheme = 'Base1';
        if ($relativeToCurrentTheme) {
            $opendirPath = "../themes/" . self::CurrentTheme() . "/" . $path;
        } else {
            $opendirPath = "../" . $path;
        }
        if ($handle = opendir($opendirPath)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && strpos($entry, $fileExt)) {
                    $entry = str_replace($fileExt, '', $entry);
                    if ($contains) {
                        $strpos = strpos($entry, $contains);
                        if ($strpos === 0 || $strpos > 0) {
                            $files[$entry] = "$entry";
                        }
                    } else {
                        $files[$entry] = "$entry";
                    }//end   if ($contains)
                }
            }//end while( )
            closedir($handle);
        }//end  if ($handle = opendir($opendirPath))
        return $files;

    }

    public static function CurrentTheme() {
        if ($CurrentTheme = SiteConfig::current_site_config()->Theme) {
            
        } else {
            $CurrentTheme = SSViewer::current_theme();
        }
        return $CurrentTheme;

    }

}
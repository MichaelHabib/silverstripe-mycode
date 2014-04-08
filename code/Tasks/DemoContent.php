<?php

/**
 * Create Demo Pages & Objects .
 * 
 * Description:
 * 	+ Create Demo Pages & pupulate with $defaults .
 * 	+ Input fields & label can be set using an array
 * 
 */
class DemoContent extends BuildTask {

    protected $title = 'Demo Content';
    protected $description = 'Auto create pages & content for a quick demo.';
    protected $enabled = true;

    function run($request) {
//        $Pages = Page::get();
//        Helper::deletePages($Pages);




        /*
         * --------------------------------------------
         * Create Group(s)
         * --------------------------------------------
         *  */

//            $Group = new Group();
//            $Group->Code = 'forum';
//            $Group->Title = _t('Group.DefaultGroupTitleContentAuthors', 'Content Authors');
//            $Group->Sort = 1;
//            $Group->write();
//            Permission::grant($Group->ID, 'CMS_ACCESS_CMSMain');
//            Permission::grant($Group->ID, 'CMS_ACCESS_AssetAdmin');
//            Permission::grant($Group->ID, 'CMS_ACCESS_ReportAdmin');
//            Permission::grant($Group->ID, 'SITETREE_REORGANISE');


        /*
         * --------------------------------------------
         * Create Member(s)
         * --------------------------------------------
         *  */
        $Domain = Helper::getCleanDomain();
        $addToGroups = array('adminstrator');
        $MemberEmail = 'admin@' . $Domain;
        $NewMember = Helper::createMember($MemberEmail, $MemberEmail, 'temppass', $addToGroups);
        $MemberEmail = 'contact@' . $Domain;
        $NewMember = Helper::createMember($MemberEmail, $MemberEmail, 'temppass', $addToGroups);
        $MemberEmail = 'info@' . $Domain;
        $NewMember = Helper::createMember($MemberEmail, $MemberEmail, 'temppass', $addToGroups);

        /*
         * --------------------------------------------
         * Create Main Pages
         * --------------------------------------------
         *  */
        $Page = Helper::getPage('Home', 'HomePage');
        $Page = Helper::getPage('ABOUT', 'LoadedPage');

        //ContactUs Page
        if (class_exists('UserDefinedForm')) {
            $ContactUs = Helper::getPage('Contact Us', 'UserDefinedForm');
            $MakeObjects = 1;
            $DeleteThenMakeObjects = 0;
            if ($DeleteThenMakeObjects == 1) {
                $ContactUs_FormFields = EditableFormField::get()->filter(array('ParentID' => "$ContactUs->ID"));
                foreach ($ContactUs_FormFields as $ContactUs_FormField) {
                    $ContactUs_FormField->delete();
                }
            }
            $ContactUs_FormFields = EditableFormField::get()->filter(array('ParentID' => "$ContactUs->ID"));
            $Page = $ContactUs;
            if ($MakeObjects && !$ContactUs_FormFields) {
                $FormField = new EditableTextField();
                $FormField->ParentID = $Page->ID;
                $FormField->write();
                $FormField->Title = 'Name';
                $FormField->Required = 1;
                $FormField->Name = $FormField->ClassName . '' . $FormField->ID;
                $FormField->write();

                $FormField = new EditableTextField();
                $FormField->ParentID = $Page->ID;
                $FormField->write();
                $FormField->Title = 'Phone';
                $FormField->Required = 1;
                $FormField->Name = 'EditableTextField' . $FormField->ID;
                $FormField->write();

                $FormField_Email = new EditableEmailField();
                $FormField_Email->ParentID = $Page->ID;
                $FormField_Email->write();
                $FormField_Email->Title = 'Email';
                $FormField_Email->Required = 1;
                $FormField_Email->Name = $FormField_Email->ClassName . '' . $FormField_Email->ID;
                $FormField_Email->write();

                $FormField = new EditableTextField();
                $FormField->ParentID = $Page->ID;
                $FormField->write();
                $FormField->Title = 'Message';
                $FormField->Required = 1;
                $FormField->setSetting('Rows', '8');
                $FormField->Name = 'EditableTextField' . $FormField->ID;
                $FormField->write();
            }
        }

        $ParentPage = Helper::getPage('Parent Page', 'LoadedPage');
        $Page = Helper::getPage('Child Page 1', 'LoadedPage', $ParentPage->ID);
        $Page = Helper::getPage('Child Page 2', 'LoadedPage', $ParentPage->ID);
        $Page = Helper::getPage('Child Page 3', 'LoadedPage', $ParentPage->ID);
        $Page = Helper::getPage('Child Page 4', 'LoadedPage', $ParentPage->ID);
        $Page = Helper::getPage('Child Page 5', 'LoadedPage', $ParentPage->ID);

        $Page = Helper::getPage('FAQ', 'LoadedPage');

         if (class_exists('BasicGallery')) {
             $BasicGallery = new BasicGallery();
             $BasicGallery->Title = 'BasicGallery1';
             
         }
    }

// End run()

}
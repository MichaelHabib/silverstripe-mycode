<?php
Object::add_extension('DataObject', 'DataObjectExtension');
Object::add_extension('Image', 'ImageExtension');
Object::add_extension('Page', 'PageExtension');
Object::add_extension('Page_Controller', 'Page_ControllerExtension');
/*
 * --------------------------------------------
 * PageExtension_PageAttachments
 * --------------------------------------------
 *  */
Object::add_extension('Page', 'PageExtension_PageAttachments');
Object::add_extension('Page_Controller', 'PageExtension_PageAttachments_ControllerExtension');
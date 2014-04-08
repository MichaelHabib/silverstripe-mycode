<?php
Object::add_extension('Page', 'Gadgets_PageExtension');
Object::add_extension('Page_Controller', 'Gadgets_Page_ControllerExtension');

Gadget::set_showEditLink(TRUE);
GadgetsArea::set_showEditLink(TRUE);

ShortcodeParser::get('default')->register('sitetree_link', array('Gadget', 'link_shortcode_handler'));
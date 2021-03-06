<?php
/**
 * WP_Nav_Menu_Widget
 */
class VeCore_VeWpNavMenu extends Ve_Element implements VE_Element_Interface{
    function __construct(){
        $id_base='ve_wp_nav';
        $name='Nav Menu';
        $options=array(
            'title'=>'Nav Menu',
            'description'=>'Nav Menu description',
            'icon'=>'ve-row.png',
            'icon_class' => 'fa fa-compass',
            'container'=>false,
            'has_content'=>false,
            'group'=>'wp',
            'defaults'=>array(),

        );
        parent::__construct($id_base,$name,$options);
        $this->setWpWidget('WP_Nav_Menu_Widget');

    }

}
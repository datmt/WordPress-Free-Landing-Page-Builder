<?php
/**
 * WP_Widget_Categories
 */
class VeCore_VeWpCategories extends Ve_Element implements VE_Element_Interface{
    function __construct(){
        $id_base='ve_wp_categories';
        $name='Categories';
        $options=array(
            'title'=>'Categories',
            'description'=>'Categories description',
            'icon'=>'ve-row.png',
            'icon_class' => 'fa fa-suitcase',
            'container'=>false,
            'has_content'=>false,
            'group'=>'wp',
            'defaults'=>array(),

        );
        parent::__construct($id_base,$name,$options);
        $this->setWpWidget('WP_Widget_Categories');

    }

}
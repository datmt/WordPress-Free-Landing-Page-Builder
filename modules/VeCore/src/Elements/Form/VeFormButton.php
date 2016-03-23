<?php
class VeCore_VeFormButton extends Ve_Element implements VE_Element_Interface{
    /**
     * @var VE_Post_Manager
     */
    var $post_manager;

    /**
     * @var VE_Popup_Manager
     */
    var $popup_manager;
    function __construct(){
        $id_base='ve_form_button';
        $name='Form Button';
        $options=array(
            'title'=>'Form Button',
            'description'=>'Button description',
            'icon_class'=>"fa fa-caret-square-o-right",
            'container'=>false,
            'has_content'=>false,
            'group'=>'form',
            'defaults'=>array('value'=>'a button'),

        );
        parent::__construct($id_base,$name,$options);
    }
    function init(){
        $this->support('CssEditor');
        //$this->post_manager=$this->getVeManager()->getPostManager();
        //$this->popup_manager=$this->getVeManager()->getPopupManager();
        $this->getVeManager()->getResourceManager()->addCss('el-button',dirname(__FILE__).'/../../view/css/elements/buttons.css');
        //$this->enqueue_js('el-button',dirname(__FILE__).'/../../view/js/elements/ve-button.js');
        //$this->ready('ve_front.button.start();');
    }
    function element($instance,$content=''){
        $instance=shortcode_atts(array(
            'icon'=>'',
            'icon_right'=>'',
            'class'=>'',
            'value'=>'',
            'style'=>'',
            'size'=>'',
            'color'=>'',
            'shape'=>'',
            'type'=>'submit',
        ),$instance);
        $this->addClass($instance['class']);
        $btnClass=array('ve-button');
        $style=$instance['style'];
        $size=$instance['size'];
        $color=$instance['color'];
        $shape=$instance['shape'];
        if($style){
            $btnClass[]='ve-button-'.$style;
        }
        if($shape){
            $btnClass[]='ve-button-'.$shape;
        }
        if($size){
            $btnClass[]='ve-button-'.$size;
        }
        if($color){
            $btnClass[]='ve-button-'.$color;
        }
        $btnClass[]=$instance['class'];
        $btnClass=join(' ',$btnClass);



        //Move padding inside
        $paddingNames = array('padding-top','padding-bottom','padding-left','padding-right');
        $paddingAttrs = array();
        foreach($paddingNames as $patt){
            if($padding=$this->css($patt)){

                $paddingAttrs[]=sprintf('%s:%s;',$patt,$padding);
                $this->css($patt,'');
            }
        }
        $paddingAttrs = esc_attr(join(' ',$paddingAttrs));
        $btnType=$instance['type'];

        $value_with_icon=$instance['value'];
        if($instance['icon']){
            $icon_class='ve-button-icon fa fa-'.$instance['icon'];
            $icon=sprintf('<i class="%s"></i>',$icon_class);
            if($instance['icon_right']){
                $value_with_icon=$value_with_icon.$icon;
            }else{
                $value_with_icon=$icon.$value_with_icon;
            }

        }
        printf('<button style="%4$s" class="ve_el-button %1$s" value="%2$s" type="%3$s">%5$s</button>',$btnClass,$instance['value'],$btnType, $paddingAttrs,$value_with_icon);

    }

    function form($instance,$content=''){
        $instance=shortcode_atts(array(
            'class'=>'',
            'value'=>'',
            'style'=>'',
            'color'=>'',
            'shape'=>'',
            'size'=>'',
            'icon'=>'',
            'icon_right'=>'',
            'type'=>'submit',
        ),$instance);

        $button_styles=array(
            ''=>'Default',
            '3d'=>'3d',
            'raised'=>'raised',
            'glow'=>'glow',
            'wrap'=>'wrap',
        );
        $button_shapes=array(
            ''=>'Default',
            'rounded'=>'rounded',
            'square'=>'square',
            'box'=>'box',
            'circle'=>'circle',

        );

        $button_colors=array(
            ''=>'Default',
            'primary'=>'primary',
            'action'=>'action',
            'highlight'=>'highlight',
            'caution'=>'caution',
            'royal'=>'royal',
        );
        $button_sizes=array(
            ''=>'Default',
            'tiny'=>'tiny',
            'small'=>'small',
            'large'=>'Large',
            'jumbo'=>'Large',
            'giant'=>'giant',
            'block'=>'Full',
        );
        $button_types=array(
            'submit'=>'submit',
            'reset'=>'reset',
            'button'=>'button',
        );
        $type=$instance['type'];
        $style=$instance['style'];
        $size=$instance['size'];
        $color=$instance['color'];
        $shape=$instance['shape'];

        ?>
        <div class="ve_input_block">
            <label for="<?php echo $this->get_field_id('value');?>">Text:</label>
            <input class="medium" type="text" value="<?php echo $instance['value'];?>" name="<?php echo $this->get_field_name('value');?>" id="<?php echo $this->get_field_id('value');?>">
        </div>

        <div class="ve_input_block">
            <label for="<?php $this->field_id('icon');?>">Icon:</label>
            <select id="<?php $this->field_id('icon');?>" name="<?php $this->field_name('icon');?>">
                <?php $icons=get_awesome_icon_list();
                $icons=$icons['filters'];
                foreach($icons as $icon=>$filter){
                    ?>
                    <option value="<?php echo $icon;?>"<?php selected($icon,$instance['icon']);?>><?php echo $icon;?></option>
                    <?php
                }
                ?>

            </select>
            <script type="application/javascript">
                (function($) {
                    var icons=<?php echo json_encode($icons);?>;
                    var last_search;
                    var matched=[];
                    var formatState=function (state) {
                        if (!state.id) {
                            return state.text;
                        }
                        return $(
                            '<span><i class="fa fa-' + state.element.value.toLowerCase() + '"></i> ' + state.text + '</span>'
                        );

                    };
                    $("#<?php $this->field_id('icon');?>").select2({
                        width:120,
                        matcher: function (params, data) {
                            // If there are no search terms, return all of the data
                            if ($.trim(params.term) === '') {
                                return data;
                            }

                            // `params.term` should be the term that is used for searching
                            // `data.text` is the text that is displayed for the data object

                            if(params.term!=last_search) {//new search
                                matched=[];
                                $.each(icons, function (icon, filter) {
                                    if (filter.indexOf(params.term) > -1) {
                                        matched.push(icon);
                                    }
                                });
                                last_search=params.term;
                            }
                            if(matched.indexOf(data.text)>-1){
                                return data;
                            }


                            // Return `null` if the term should not be displayed
                            return null;
                        },
                        templateResult: formatState,
                        allowClear: true,
                        placeholder: "Select an icon",
                        templateSelection: formatState
                    });
                })(jQuery);
            </script>
            <label><input name="<?php $this->field_name('icon_right');?>" value="1" type="checkbox"<?php checked($instance['icon_right']);?>> Right</label>
        </div>

        <div class="ve_input_block">
            <label for="<?php $this->field_id('type');?>">
                Button Type:
            </label>
            <select class="medium" id="<?php $this->field_id('type');?>" name="<?php $this->field_name('type');?>">
                <?php foreach($button_types as $o_value=>$o_title){
                    $o_title=ucfirst($o_title);
                    printf('<option value="%s"%s>%s</option>',$o_value,selected($o_value,$type,false),$o_title);
                }?>
            </select>
        </div>
        <div class="ve_input_block">
            <label for="<?php $this->field_id('style');?>">
                Button Style:
            </label>
            <select class="medium" id="<?php $this->field_id('style');?>" name="<?php $this->field_name('style');?>">
                <?php foreach($button_styles as $o_value=>$o_title){
                    $o_title=ucfirst($o_title);
                    printf('<option value="%s"%s>%s</option>',$o_value,selected($o_value,$style,false),$o_title);
                }?>
            </select>
        </div>

        <div class="ve_input_block">
            <label for="<?php $this->field_id('shape');?>">
                Button Shape:
            </label>
            <select class="medium" id="<?php $this->field_id('shape');?>" name="<?php $this->field_name('shape');?>">
                <?php foreach($button_shapes as $o_value=>$o_title){
                    $o_title=ucfirst($o_title);
                    printf('<option value="%s"%s>%s</option>',$o_value,selected($o_value,$shape,false),$o_title);
                }?>
            </select>
        </div>

        <div class="ve_input_block">
            <label for="<?php $this->field_id('color');?>">
                Button Color:
            </label>
            <select class="medium" id="<?php $this->field_id('color');?>" name="<?php $this->field_name('color');?>">
                <?php foreach($button_colors as $o_value=>$o_title){
                    $o_title=ucfirst($o_title);
                    printf('<option value="%s"%s>%s</option>',$o_value,selected($o_value,$color,false),$o_title);
                }?>
            </select>
        </div>

        <div class="ve_input_block">
            <label for="<?php $this->field_id('size');?>">
                Button size:
            </label>
            <select class="medium" id="<?php $this->field_id('size');?>" name="<?php $this->field_name('size');?>">
                <?php foreach($button_sizes as $o_value=>$o_title){
                    $o_title=ucfirst($o_title);
                    printf('<option value="%s"%s>%s</option>',$o_value,selected($o_value,$size,false),$o_title);
                }?>
            </select>
        </div>



        <div class="ve_element_preview" style="right: 20px;
position: absolute;
top: 80px;
width: auto;"></div>

        <p><label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Extra class:'); ?></label>
            <input class="medium" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" type="text" value="<?php echo esc_attr($instance['class']); ?>" /></p>

        <?php
    }
}

<?php
/**
 * @package    Joomla.Component.Builder
 *
 * @created    30th April, 2015
 * @author     Llewellyn van der Merwe <http://www.joomlacomponentbuilder.com>
 * @github     Joomla Component Builder <https://github.com/vdm-io/Joomla-Component-Builder>
 * @copyright  Copyright (C) 2015 - 2018 Vast Development Method. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');
$componentParams = JComponentHelper::getParams('com_componentbuilder');
?>
<script type="text/javascript">
	// waiting spinner
	var outerDiv = jQuery('body');
	jQuery('<div id="loading"></div>')
		.css("background", "rgba(255, 255, 255, .8) url('components/com_componentbuilder/assets/images/import.gif') 50% 15% no-repeat")
		.css("top", outerDiv.position().top - jQuery(window).scrollTop())
		.css("left", outerDiv.position().left - jQuery(window).scrollLeft())
		.css("width", outerDiv.width())
		.css("height", outerDiv.height())
		.css("position", "fixed")
		.css("opacity", "0.80")
		.css("-ms-filter", "progid:DXImageTransform.Microsoft.Alpha(Opacity = 80)")
		.css("filter", "alpha(opacity = 80)")
		.css("display", "none")
		.appendTo(outerDiv);
	jQuery('#loading').show();
	// when page is ready remove and show
	jQuery(window).load(function() {
		jQuery('#componentbuilder_loader').fadeIn('fast');
		jQuery('#loading').hide();
	});
</script>
<div id="componentbuilder_loader" style="display: none;">
<form action="<?php echo JRoute::_('index.php?option=com_componentbuilder&layout=edit&id='. (int) $this->item->id . $this->referral); ?>" method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">

	<?php echo JLayoutHelper::render('site_view.details_above', $this); ?>
<div class="form-horizontal">
	<div class="span9">

	<?php echo JHtml::_('bootstrap.startTabSet', 'site_viewTab', array('active' => 'details')); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'site_viewTab', 'details', JText::_('COM_COMPONENTBUILDER_SITE_VIEW_DETAILS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('site_view.details_left', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('site_view.details_right', $this); ?>
			</div>
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('site_view.details_fullwidth', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'site_viewTab', 'custom_buttons', JText::_('COM_COMPONENTBUILDER_SITE_VIEW_CUSTOM_BUTTONS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('site_view.custom_buttons_left', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('site_view.custom_buttons_right', $this); ?>
			</div>
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('site_view.custom_buttons_fullwidth', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'site_viewTab', 'javascript_css', JText::_('COM_COMPONENTBUILDER_SITE_VIEW_JAVASCRIPT_CSS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('site_view.javascript_css_fullwidth', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'site_viewTab', 'php', JText::_('COM_COMPONENTBUILDER_SITE_VIEW_PHP', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('site_view.php_fullwidth', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'site_viewTab', 'linked_components', JText::_('COM_COMPONENTBUILDER_SITE_VIEW_LINKED_COMPONENTS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('site_view.linked_components_fullwidth', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php if ($this->canDo->get('core.delete') || $this->canDo->get('core.edit.created_by') || $this->canDo->get('core.edit.state') || $this->canDo->get('core.edit.created')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'site_viewTab', 'publishing', JText::_('COM_COMPONENTBUILDER_SITE_VIEW_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('site_view.publishing', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('site_view.publlshing', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php if ($this->canDo->get('core.admin')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'site_viewTab', 'permissions', JText::_('COM_COMPONENTBUILDER_SITE_VIEW_PERMISSION', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<fieldset class="adminform">
					<div class="adminformlist">
					<?php foreach ($this->form->getFieldset('accesscontrol') as $field): ?>
						<div>
							<?php echo $field->label; echo $field->input;?>
						</div>
						<div class="clearfix"></div>
					<?php endforeach; ?>
					</div>
				</fieldset>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php echo JHtml::_('bootstrap.endTabSet'); ?>

	<div>
		<input type="hidden" name="task" value="site_view.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	</div>
</div><div class="span3">
	<?php echo JLayoutHelper::render('site_view.details_rightside', $this); ?>
</div>

<div class="clearfix"></div>
<?php echo JLayoutHelper::render('site_view.details_under', $this); ?>
</form>
</div>

<script type="text/javascript">

// #jform_add_php_view listeners for add_php_view_vvvvvyq function
jQuery('#jform_add_php_view').on('keyup',function()
{
	var add_php_view_vvvvvyq = jQuery("#jform_add_php_view input[type='radio']:checked").val();
	vvvvvyq(add_php_view_vvvvvyq);

});
jQuery('#adminForm').on('change', '#jform_add_php_view',function (e)
{
	e.preventDefault();
	var add_php_view_vvvvvyq = jQuery("#jform_add_php_view input[type='radio']:checked").val();
	vvvvvyq(add_php_view_vvvvvyq);

});

// #jform_add_php_jview_display listeners for add_php_jview_display_vvvvvyr function
jQuery('#jform_add_php_jview_display').on('keyup',function()
{
	var add_php_jview_display_vvvvvyr = jQuery("#jform_add_php_jview_display input[type='radio']:checked").val();
	vvvvvyr(add_php_jview_display_vvvvvyr);

});
jQuery('#adminForm').on('change', '#jform_add_php_jview_display',function (e)
{
	e.preventDefault();
	var add_php_jview_display_vvvvvyr = jQuery("#jform_add_php_jview_display input[type='radio']:checked").val();
	vvvvvyr(add_php_jview_display_vvvvvyr);

});

// #jform_add_php_jview listeners for add_php_jview_vvvvvys function
jQuery('#jform_add_php_jview').on('keyup',function()
{
	var add_php_jview_vvvvvys = jQuery("#jform_add_php_jview input[type='radio']:checked").val();
	vvvvvys(add_php_jview_vvvvvys);

});
jQuery('#adminForm').on('change', '#jform_add_php_jview',function (e)
{
	e.preventDefault();
	var add_php_jview_vvvvvys = jQuery("#jform_add_php_jview input[type='radio']:checked").val();
	vvvvvys(add_php_jview_vvvvvys);

});

// #jform_add_php_document listeners for add_php_document_vvvvvyt function
jQuery('#jform_add_php_document').on('keyup',function()
{
	var add_php_document_vvvvvyt = jQuery("#jform_add_php_document input[type='radio']:checked").val();
	vvvvvyt(add_php_document_vvvvvyt);

});
jQuery('#adminForm').on('change', '#jform_add_php_document',function (e)
{
	e.preventDefault();
	var add_php_document_vvvvvyt = jQuery("#jform_add_php_document input[type='radio']:checked").val();
	vvvvvyt(add_php_document_vvvvvyt);

});

// #jform_add_css_document listeners for add_css_document_vvvvvyu function
jQuery('#jform_add_css_document').on('keyup',function()
{
	var add_css_document_vvvvvyu = jQuery("#jform_add_css_document input[type='radio']:checked").val();
	vvvvvyu(add_css_document_vvvvvyu);

});
jQuery('#adminForm').on('change', '#jform_add_css_document',function (e)
{
	e.preventDefault();
	var add_css_document_vvvvvyu = jQuery("#jform_add_css_document input[type='radio']:checked").val();
	vvvvvyu(add_css_document_vvvvvyu);

});

// #jform_add_javascript_file listeners for add_javascript_file_vvvvvyv function
jQuery('#jform_add_javascript_file').on('keyup',function()
{
	var add_javascript_file_vvvvvyv = jQuery("#jform_add_javascript_file input[type='radio']:checked").val();
	vvvvvyv(add_javascript_file_vvvvvyv);

});
jQuery('#adminForm').on('change', '#jform_add_javascript_file',function (e)
{
	e.preventDefault();
	var add_javascript_file_vvvvvyv = jQuery("#jform_add_javascript_file input[type='radio']:checked").val();
	vvvvvyv(add_javascript_file_vvvvvyv);

});

// #jform_add_js_document listeners for add_js_document_vvvvvyw function
jQuery('#jform_add_js_document').on('keyup',function()
{
	var add_js_document_vvvvvyw = jQuery("#jform_add_js_document input[type='radio']:checked").val();
	vvvvvyw(add_js_document_vvvvvyw);

});
jQuery('#adminForm').on('change', '#jform_add_js_document',function (e)
{
	e.preventDefault();
	var add_js_document_vvvvvyw = jQuery("#jform_add_js_document input[type='radio']:checked").val();
	vvvvvyw(add_js_document_vvvvvyw);

});

// #jform_add_css listeners for add_css_vvvvvyx function
jQuery('#jform_add_css').on('keyup',function()
{
	var add_css_vvvvvyx = jQuery("#jform_add_css input[type='radio']:checked").val();
	vvvvvyx(add_css_vvvvvyx);

});
jQuery('#adminForm').on('change', '#jform_add_css',function (e)
{
	e.preventDefault();
	var add_css_vvvvvyx = jQuery("#jform_add_css input[type='radio']:checked").val();
	vvvvvyx(add_css_vvvvvyx);

});

// #jform_add_php_ajax listeners for add_php_ajax_vvvvvyy function
jQuery('#jform_add_php_ajax').on('keyup',function()
{
	var add_php_ajax_vvvvvyy = jQuery("#jform_add_php_ajax input[type='radio']:checked").val();
	vvvvvyy(add_php_ajax_vvvvvyy);

});
jQuery('#adminForm').on('change', '#jform_add_php_ajax',function (e)
{
	e.preventDefault();
	var add_php_ajax_vvvvvyy = jQuery("#jform_add_php_ajax input[type='radio']:checked").val();
	vvvvvyy(add_php_ajax_vvvvvyy);

});

// #jform_add_custom_button listeners for add_custom_button_vvvvvyz function
jQuery('#jform_add_custom_button').on('keyup',function()
{
	var add_custom_button_vvvvvyz = jQuery("#jform_add_custom_button input[type='radio']:checked").val();
	vvvvvyz(add_custom_button_vvvvvyz);

});
jQuery('#adminForm').on('change', '#jform_add_custom_button',function (e)
{
	e.preventDefault();
	var add_custom_button_vvvvvyz = jQuery("#jform_add_custom_button input[type='radio']:checked").val();
	vvvvvyz(add_custom_button_vvvvvyz);

});

// #jform_button_position listeners for button_position_vvvvvza function
jQuery('#jform_button_position').on('keyup',function()
{
	var button_position_vvvvvza = jQuery("#jform_button_position").val();
	vvvvvza(button_position_vvvvvza);

});
jQuery('#adminForm').on('change', '#jform_button_position',function (e)
{
	e.preventDefault();
	var button_position_vvvvvza = jQuery("#jform_button_position").val();
	vvvvvza(button_position_vvvvvza);

});



jQuery(function() {
	jQuery('#open-libraries').html('<a href="index.php?option=com_componentbuilder&view=libraries"><?php echo JText::_('COM_COMPONENTBUILDER_LIBRARIES'); ?></a>');
});
jQuery('#jform_snippet').closest('.input-append').addClass('jform_snippet_input_width');
jQuery('#jform_main_get').closest('.input-append').addClass('jform_main_get_input_width');
jQuery('#jform_dynamic_get').closest('.input-append').addClass('jform_dynamic_get_input_width');
<?php $fieldNrs = range(1,7,1); ?>
<?php foreach($fieldNrs as $nr): ?>jQuery('#jform_custom_button_modal').on('change', 'select[name="icomoon-<?php echo $nr; ?>"]',function (e) {
	// update the icon if changed
	var vala_<?php echo $nr; ?> = jQuery('select[name="icomoon-<?php echo $nr; ?>"] option:selected').val();
	// build new span
	var span = '<span id="icon_custom_button_fields_icomoon_<?php echo $nr; ?>" class="icon-'+vala_<?php echo $nr; ?>+'"></span>';
	// remove old one 
	jQuery('#icon_custom_button_fields_icomoon_<?php echo $nr; ?>').remove();
	// add the new icon
	jQuery('#jform_custom_button_fields_icomoon_<?php echo $nr; ?>_chzn').closest("td").append(span);
});

jQuery(document).ready(function() {
jQuery('input.form-field-repeatable').on('row-add', function (e) {
	// show the icon if set
	var vala_<?php echo $nr; ?> = jQuery('#jform_custom_button_fields_icomoon-<?php echo $nr; ?>').val();
	// build new span
	var span = '<span id="icon_custom_button_fields_icomoon_<?php echo $nr; ?>" class="icon-'+vala_<?php echo $nr; ?>+'"></span>';
	// remove old one 
	jQuery('#icon_custom_button_fields_icomoon_<?php echo $nr; ?>').remove();
	// add the new icon
	jQuery('#jform_custom_button_fields_icomoon_<?php echo $nr; ?>_chzn').closest("td").append(span);
});
});
<?php endforeach; ?>
jQuery(function() {
    jQuery("code").click(function() {
        jQuery(this).selText().addClass("selected");
    });
});
jQuery('#adminForm').on('change', '#jform_libraries',function (e) {
	e.preventDefault();
	getSnippets();
});

jQuery.fn.selText = function() {
    var obj = this[0];
    if (jQuery.browser.msie) {
        var range = obj.offsetParent.createTextRange();
        range.moveToElementText(obj);
        range.select();
    } else if (jQuery.browser.mozilla || $.browser.opera) {
        var selection = obj.ownerDocument.defaultView.getSelection();
        var range = obj.ownerDocument.createRange();
        range.selectNodeContents(obj);
        selection.removeAllRanges();
        selection.addRange(range);
    } else if (jQuery.browser.safari) {
        var selection = obj.ownerDocument.defaultView.getSelection();
        selection.setBaseAndExtent(obj, 0, obj, 1);
    }
    return this;
}

jQuery('#adminForm').on('change', '#jform_snippet',function (e) {
	e.preventDefault();
	// get type value
	var snippetId = jQuery("#jform_snippet option:selected").val();
	getSnippetDetails(snippetId);
});

jQuery(document).ready(function() {
	// get type value
	var snippetId = jQuery("#jform_snippet option:selected").val();
	getSnippetDetails(snippetId);
});

jQuery('#adminForm').on('change', '#jform_dynamic_get',function (e) {
	e.preventDefault();
	// get type value
	var dynamicId = jQuery("#jform_dynamic_get option:selected").val();
	getDynamicValues(dynamicId);
});

jQuery(document).ready(function() {
	// get type value
	var dynamicId = jQuery("#jform_dynamic_get option:selected").val();
	getDynamicValues(dynamicId);
});

jQuery(document).ready(function() {
	// get type value
	getLayoutDetails(9999);
	getTemplateDetails(9999);
});
// some lang strings
var select_a_snippet = '<?php echo JText::_('COM_COMPONENTBUILDER_SELECT_A_SNIPPET'); ?>';
var create_a_snippet = '<?php echo JText::_('COM_COMPONENTBUILDER_CREATE_A_SNIPPET'); ?>';

// nice little dot trick :)
jQuery(document).ready( function($) {
  var x=0;
  setInterval(function() {
	var dots = "";
	x++;
	for (var y=0; y < x%8; y++) {
		dots+=".";
	}
	$(".loading-dots").text(dots);
  } , 500);
}); 
</script>

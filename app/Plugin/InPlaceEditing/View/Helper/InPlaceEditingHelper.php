<?php

/*
 * ----------------------------------------------------------------------------
 * Package:     CakePHP InPlaceEditing Plugin
 * Version:     0.0.1
 * Date:        2012-12-31
 * Description: CakePHP plugin for in-place-editing functionality of any 
 *				form element.
 * Author:      Karey H. Powell
 * Author URL:  http://kareypowell.com/
 * Repository:  http://github.com/kareypowell/CakePHP-InPlace-Editing
 * ----------------------------------------------------------------------------
 * Copyright (c) 2012 Karey H. Powell
 * Dual licensed under the MIT and GPL licenses.
 * ----------------------------------------------------------------------------
 */

class InPlaceEditingHelper extends AppHelper {
	
	/*
	 * Returns a script which contains a html element (type defined in a parameter) with the field contents. 
	 * And includes a script required for the inplace update ajax request logic.
	 */
	public function input($modelName, $fieldName, $id, $settings = null)
	{
		$value			= $this->__extractSetting($settings, 'value',			'');
		$actionName		= $this->__extractSetting($settings, 'actionName',		'inPlaceEditing');
		$type			= $this->__extractSetting($settings, 'type',			'textarea');
		$rows			= $this->__extractSetting($settings, 'rows',			'1');
		$cols			= $this->__extractSetting($settings, 'cols',			'');
		$cancelText		= $this->__extractSetting($settings, 'cancelText',		'Cancel');
		$submitText		= $this->__extractSetting($settings, 'submitText',		'Save');
		$cancelBtnClass	= $this->__extractSetting($settings, 'cancelBtnClass',	'btn btn-danger btn-xs');
		$submitBtnClass	= $this->__extractSetting($settings, 'submitBtnClass',	'btn btn-success btn-xs');		
		$toolTip		= $this->__extractSetting($settings, 'toolTip',			'Click to edit.');
		$containerType	= $this->__extractSetting($settings, 'containerType',	'div');
		$containerClass	= $this->__extractSetting($settings, 'containerClass',	'');
		$selectOptions	= $this->__extractSetting($settings, 'selectOptions',	'');
		
		$script = "
			<$containerType id=\"inplace_$fieldName$id\" class=\"$containerClass\">$value</$containerType>
			<script type=\"text/javascript\">
				$(
					function()
					{
						$('#inplace_$fieldName$id').editable
						(
							'$actionName/$id',
							{
								name      : 'data[$modelName][$fieldName]',
								type      : '$type',
								rows      : '$rows',
								cols      : '$cols',
								data      : '$selectOptions',
								cancel    : '$cancelText',
								submit    : '$submitText',
								tooltip   : '$toolTip',
								cancelBtnClass : '$cancelBtnClass',
								submitBtnClass : '$submitBtnClass',
								
							}
						);
					}
				);
			</script>
		";

		return $script;
	}

	/*
	 * Extracts a setting under the provided key if possible, otherwise, returns a provided default value.
	 */
	public function __extractSetting($settings, $key, $defaultValue = '') {
		if(!$settings && empty($settings))
			return $defaultValue;

		if(isset($settings[$key]))
			return $settings[$key];
		else
			return $defaultValue;
	}

}
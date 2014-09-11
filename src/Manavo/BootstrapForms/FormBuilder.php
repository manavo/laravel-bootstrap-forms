<?php

namespace Manavo\BootstrapForms;

use Illuminate\Html\FormBuilder as IlluminateFormBuilder;

class FormBuilder extends IlluminateFormBuilder {

	/**
	 * An array containing the currently opened form groups.
	 *
	 * @var array
	 */
	protected $groupStack = array();

	/**
	 * Open a new form group.
	 *
	 * @param  string  $name
	 * @param  mixed   $label
	 * @param  array   $options
	 * @return string
	 */
	public function openGroup($name, $label = null, $options = array())
	{
		$options = $this->appendClassToOptions('form-group', $options);

		// Append the name of the group to the groupStack.
		$this->groupStack[] = $name;

		if ($this->hasErrors($name))
		{
			// If the form element with the given name has any errors,
			// apply the 'has-error' class to the group.
			$options = $this->appendClassToOptions('has-error', $options);
		}

		// If a label is given, we set it up here. Otherwise, we will just
		// set it to an empty string.
		$label = $label ? $this->label($name, $label) : '';

		return '<div'.$this->html->attributes($options).'>'.$label;
	}

	/**
	 * Close out the last opened form group.
	 *
	 * @return string
	 */
	public function closeGroup()
	{
		// Get the last added name from the groupStack and
		// remove it from the array.
		$name = array_pop($this->groupStack);

		// Get the formatted errors for this form group.
		$errors = $this->getFormattedErrors($name);

		// Append the errors to the group and close it out.
		return $errors.'</div>';
	}

	/**
	 * Create a form input field.
	 *
	 * @param  string  $type
	 * @param  string  $name
	 * @param  string  $value
	 * @param  array   $options
	 * @return string
	 */
	public function input($type, $name, $value = null, $options = array())
	{
		$options = $this->appendClassToOptions('form-control', $options);

		// Call the parent input method so that Laravel can handle
		// the rest of the input set up.
		return parent::input($type, $name, $value, $options);
	}

	/**
	 * Create a select box field.
	 *
	 * @param  string  $name
	 * @param  array   $list
	 * @param  string  $selected
	 * @param  array   $options
	 * @return string
	 */
	public function select($name, $list = array(), $selected = null, $options = array())
	{
		$options = $this->appendClassToOptions('form-control', $options);

		// Call the parent select method so that Laravel can handle
		// the rest of the select set up.
		return parent::select($name, $list, $selected, $options);
	}

	/**
	 * Create a plain form input field.
	 *
	 * @param  string  $type
	 * @param  string  $name
	 * @param  string  $value
	 * @param  array   $options
	 * @return string
	 */
	public function plainInput($type, $name, $value = null, $options = array())
	{
		return parent::input($type, $name, $value, $options);
	}

	/**
	 * Create a plain select box field.
	 *
	 * @param  string  $name
	 * @param  array   $list
	 * @param  string  $selected
	 * @param  array   $options
	 * @return string
	 */
	public function plainSelect($name, $list = array(), $selected = null, $options = array())
	{
		return parent::select($name, $list, $selected, $options);
	}

	/**
	 * Create a checkable input field.
	 *
	 * @param  string  $type
	 * @param  string  $name
	 * @param  mixed   $value
	 * @param  bool    $checked
	 * @param  array   $options
	 * @return string
	 */
	protected function checkable($type, $name, $value, $checked, $options)
	{
		$checked = $this->getCheckedState($type, $name, $value, $checked);

		if ($checked) $options['checked'] = 'checked';

		return parent::input($type, $name, $value, $options);
	}

	/**
	 * Create a checkbox input field.
	 *
	 * @param  string  $name
	 * @param  mixed   $value
	 * @param  mixed   $label
	 * @param  bool    $checked
	 * @param  array   $options
	 * @return string
	 */
	public function checkbox($name, $value = 1, $label = null, $checked = null, $options = array())
	{
		$checkable = parent::checkbox($name, $value, $checked, $options);

		return $this->wrapCheckable($label, 'checkbox', $checkable);
	}

	/**
	 * Create a radio button input field.
	 *
	 * @param  string  $name
	 * @param  mixed   $value
	 * @param  mixed   $label
	 * @param  bool    $checked
	 * @param  array   $options
	 * @return string
	 */
	public function radio($name, $value = null, $label = null, $checked = null, $options = array())
	{
		$checkable = parent::radio($name, $value, $checked, $options);

		return $this->wrapCheckable($label, 'radio', $checkable);
	}

	/**
	 * Create an inline checkbox input field.
	 *
	 * @param  string  $name
	 * @param  mixed   $value
	 * @param  mixed   $label
	 * @param  bool    $checked
	 * @param  array   $options
	 * @return string
	 */
	public function inlineCheckbox($name, $value = 1, $label = null, $checked = null, $options = array())
	{
		$checkable = parent::checkbox($name, $value, $checked, $options);

		return $this->wrapInlineCheckable($label, 'checkbox', $checkable);
	}

	/**
	 * Create an inline radio button input field.
	 *
	 * @param  string  $name
	 * @param  mixed   $value
	 * @param  mixed   $label
	 * @param  bool    $checked
	 * @param  array   $options
	 * @return string
	 */
	public function inlineRadio($name, $value = null, $label = null, $checked = null, $options = array())
	{
		$checkable = parent::radio($name, $value, $checked, $options);

		return $this->wrapInlineCheckable($label, 'radio', $checkable);
	}

	/**
	 * Create a textarea input field.
	 *
	 * @param  string  $name
	 * @param  string  $value
	 * @param  array   $options
	 * @return string
	 */
	public function textarea($name, $value = null, $options = array())
	{
		$options = $this->appendClassToOptions('form-control', $options);

		return parent::textarea($name, $value, $options);
	}

	/**
	 * Create a plain textarea input field.
	 *
	 * @param  string  $name
	 * @param  string  $value
	 * @param  array   $options
	 * @return string
	 */
	public function plainTextarea($name, $value = null, $options = array())
	{
		return parent::textarea($name, $value, $options);
	}

	/**
	 * Append the given class to the given options array.
	 *
	 * @param  string  $class
	 * @param  array   $options
	 * @return array
	 */
	private function appendClassToOptions($class, array $options = array())
	{
		// If a 'class' is already specified, append the 'form-control'
		// class to it. Otherwise, set the 'class' to 'form-control'.
		$options['class'] = isset($options['class']) ? $options['class'].' ' : '';
		$options['class'] .= $class;

		return $options;
	}

	/**
	 * Determine whether the form element with the given name
	 * has any validation errors.
	 *
	 * @param  string  $name
	 * @return bool
	 */
	private function hasErrors($name)
	{
		if (is_null($this->session) || ! $this->session->has('errors'))
		{
			// If the session is not set, or the session doesn't contain
			// any errors, the form element does not have any errors
			// applied to it.
			return false;
		}

		// Get the errors from the session.
		$errors = $this->session->get('errors');

		// Check if the errors contain the form element with the given name.
		// This leverages Laravel's transformKey method to handle the
		// formatting of the form element's name.
		return $errors->has($this->transformKey($name));
	}

	/**
	 * Get the formatted errors for the form element with the given name.
	 *
	 * @param  string  $name
	 * @return string
	 */
	private function getFormattedErrors($name)
	{
		if ( ! $this->hasErrors($name))
		{
			// If the form element does not have any errors, return
			// an emptry string.
			return '';
		}

		// Get the errors from the session.
		$errors = $this->session->get('errors');

		// Return the formatted error message, if the form element has any.
		return $errors->first($this->transformKey($name), '<p class="help-block">:message</p>');
	}

	/**
	 * Wrap the given checkable in the necessary wrappers.
	 *
	 * @param  mixed   $label
	 * @param  string  $type
	 * @param  string  $checkable
	 * @return string
	 */
	private function wrapCheckable($label, $type, $checkable)
	{
		return '<div class="'.$type.'"><label>'.$checkable.' '.$label.'</label></div>';
	}

	/**
	 * Wrap the given checkable in the necessary inline wrappers.
	 *
	 * @param  mixed   $label
	 * @param  string  $type
	 * @param  string  $checkable
	 * @return string
	 */
	private function wrapInlineCheckable($label, $type, $checkable)
	{
		return '<div class="'.$type.'-inline">'.$checkable.' '.$label.'</div>';
	}

}

<?php

class FormBuilder {

	protected $html;
	protected $url;
	protected $csrfToken;
	protected $session;
	protected $model;
	protected $labels = array();
	protected $reserved = array('method', 'url', 'route', 'action', 'files');
	protected $skipValueTypes = array('file', 'password', 'checkbox', 'radio');
	
	public function __construct(){}

	public function open(array $options = array())
	{	
		$attributes['action'] = $this->getAction($options);
		$attributes['accept-charset'] = 'UTF-8';
		$attributes['method'] = $this->getMethod($options);
                $attributes['data-type']= $this->getDataType($options);
                
		if (isset($options['files']) && $options['files'])
		{
			$options['enctype'] = 'multipart/form-data';
		}

		if (! isset($options['class']))
			$attributes['class']='bootstrap-modal-form form-horizontal';
		else
			$attributes['class']=$options['class'];
		
		$attributes = $this->attributes($attributes);

		return '<form'.$attributes.'>';
	}

	public function close()
	{
		$this->labels = array();

		$this->model = null;

		return '</form>';
	}
	
	protected function getAction(array $options)
	{
		if (isset($options['url']))
		{
			return $options['url'];
		}
		
		elseif (isset($options['action']))
		{
			return $options['action'];
		}

		return $this->url;
	}
	
	protected function getMethod(array $options)
	{
		if (isset($options['method']))
		{
			return $options['method'];
		}
		
		elseif (isset($options['action']))
		{
			return $options['action'];
		}
		
		else 
			return "post";
	}
        
        protected function getDataType(array $options)
	{
		if (isset($options['data-type']))
		{
			return $options['data-type'];
		}
		
		else 
                    return "json";
	}
	
	public function attributes($attributes)
	{
		$html = array();

		foreach ((array) $attributes as $key => $value)
		{
			$element = $this->attributeElement($key, $value);

			if ( ! is_null($element)) 
				$html[] = $element;
		}

		return count($html) > 0 ? ' '.implode(' ', $html) : '';
	}
	
	protected function attributeElement($key, $value)
	{
		if (is_numeric($key)) $key = $value;

		if ( ! is_null($value)) return $key.'="'.$value.'"';
	}
	
	public function label($name, $value = null, $options = array())
	{
		$this->labels[] = $name;

		if (! isset($options['class']))
			$options['class']="control-label col-xs-2";
			
		$options = $this->attributes($options);
		
		if ($value!=null)
			$value = $this->formatLabel($name, $value);
		else
			$value='';
		
		return '<label for="'.$name.'"'.$options.'>'.$value.'</label>';
	}
	
	public function hidden($name, $value = null, $options = array())
	{
		if ( isset($value)) 
			$options['value'] = $value;
		
		if ( ! isset($options['name'])) 
			$options['name'] = $name;
		
		if ( ! isset($options['id'])) 
			$options['id'] = $name;
		
		return '<input type=hidden'.$this->attributes($options).'>';
	}
	
	public function inputForm($type, $name, $value = null, $options = array(), $optionsDIV = array())
	{
		if ( isset($options['label']))
			$label='<label for="'.$name.'">'.$options['label'].'</label>';
		else
			$label='';

		if ( isset($value))
			$options['value'] = $value;

		if ( isset($type))
			$options['type'] = $type;

		if ( ! isset($options['name']))
			$options['name'] = $name;

		if ( ! isset($options['id']))
			$options['id'] = $name;

		if (! isset($optionsDIV['class']))
			$optionsDIV['class']="form-group form-field col-xs-10";

		if (! isset($options['class']))
			$options['class']="form-control";

		return '<div class="'.$optionsDIV['class'].'">'.$label.'<input'.$this->attributes($options).'></div>';
	}

	protected function isSelected($value)
	{
		return in_array($value, (array) $this->selected);
	}

	protected function renderOption($selected, $value, $label)
	{
		$option = '<option ';
		$option .= 'value="' . $value . '"';
		$option .= $selected==$value ? ' selected' : '';
		$option .= '>';
		$option .= $label;
		$option .= '</option>';
		return $option;
	}

	public function selectForm($name, $selected = null, $values = array(), $options = array(), $optionsDIV = array()){
		if ( isset($options['label']))
			$label='<label for="'.$name.'">'.$options['label'].'</label>';
		else
			$label='';

		if ( ! isset($options['name']))
			$options['name'] = $name;

		if ( ! isset($options['id']))
			$options['id'] = $name;

		if (! isset($options['class']))
			$options['class']="form-control";

		if (! isset($optionsDIV['class']))
			$optionsDIV['class']="form-group form-field col-xs-10";

		if (! isset($options['style']))
			;

		if (! isset($selected))
			$selected=0;

		$selectOpt='';

		if ( isset($values)) {
			foreach ($values as $value => $v) {
				$selectOpt .= $this->renderOption($selected, $value, $v);
			}
		}

		return '<div class="'.$optionsDIV['class'].'">'.$label.'<select'.$this->attributes($options).'>'.$selectOpt.'</select></div>';
	}

	public function submit($name, $options = array(), $optionsDIV = array())
	{
		if ( ! isset($options['type'])) 
			$options['type'] = 'submit';
		
		if ( ! isset($options['id'])) 
			$options['id'] = $name;
		
		if (! isset($optionsDIV['class']))
			$optionsDIV['class']="form-group form-field col-xs-10";
		
		if (! isset($options['class']))
			$options['class']="btn btn-primary";
		
		return '<div class="'.$optionsDIV['class'].'"><button'.$this->attributes($options).'>'.$name.'</button></div>';
	}
	
	public function textarea($name, $value = null, $options = array(), $optionsDIV = array()){

		if ( isset($options['label']))
			$label='<label for="'.$name.'">'.$options['label'].'</label>';
		else
			$label='';

		if ( ! isset($options['name']))
			$options['name'] = $name;

		if ( ! isset($options['id']))
			$options['id'] = $name;

		if (! isset($optionsDIV['class']))
			$optionsDIV['class']="form-group form-field col-xs-10";

		if (! isset($options['class']))
			$options['class']="form-control";

		return '<div class="'.$optionsDIV['class'].'">'.$label.'<textarea'.$this->attributes($options).'>'. $value.'</textarea></div>';

	}

	protected function formatLabel($name, $value)
	{
		return $value ?: ucwords(str_replace('_', ' ', $name));
	}
}

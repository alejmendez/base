<?php
	$name_label = str_replace("_", " ", $name);
	$attr_label = [];

	if (!isset($attributes['id'])){
		$attributes['id'] = $name;
	}

	$class_cont = 'col-lg-3 col-md-4 col-sm-6 col-xs-12';
	if (isset($attributes['class_cont'])){
		$class_cont = $attributes['class_cont'];
		unset($attributes['class_cont']);
	}

	if (isset($attributes['label'])){
		$name_label = $attributes['label'];
		unset($attributes['label']);
	}

	$name_label = ucwords($name_label);

	if (!isset($attributes['placeholder'])){
		$attributes['placeholder'] = $name_label;
	}

	if (isset($attributes['required'])){
		//$name_label .= ' <i class="fa fa-asterisk requerido"></i>';
		$attr_label['class'] = 'requerido';
	}
?>
<div class="form-group {{ $class_cont }}">
    {{ Form::label($name, $name_label, $attr_label) }}
    {{ Form::textarea($name, $value, array_merge(['class' => 'form-control', 'rows' => 5], $attributes)) }}
</div>
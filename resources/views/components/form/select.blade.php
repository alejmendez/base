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

	$name_label = ucwords($name_label);

	if (isset($attributes['label'])){
		$name_label = $attributes['label'];
		unset($attributes['label']);
	}

	if (!isset($attributes['placeholder'])){
		$attributes['placeholder'] = '- Seleccione';
	}

	if (isset($attributes['required'])){
		//$name_label .= ' <i class="fa fa-asterisk requerido"></i>';
		$attr_label['class'] = 'requerido';
	}

	if (isset($attributes['multiple'])){
		unset($attributes['placeholder']);
		$name = trim($name, '[]') . '[]';
	}
?>
<div class="form-group {{ $class_cont }}">
    {{ Form::label($name, $name_label, $attr_label) }}
    {{ Form::select($name, $value, $default, array_merge(['class' => 'form-control'], $attributes)) }}
</div>
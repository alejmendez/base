<?php

if(PHP_OS == 'WINNT'){
    return [
        'pdf'=>[
            'enabled' => true,
            'binary'  => '"C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe"',
            'options' => [],
        ],
        'image'=>[
            'enabled' => true,
            'binary'  => '"C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltoimage.exe"',
            'options' => [],
        ]
    ];
}else{
    return array(
        'pdf' => array(
            'enabled' => true,
            'binary'  => 'wkhtmltopdf',
            'options' => array(),
        ),
        'image' => array(
            'enabled' => true,
            'binary'  => 'wkhtmltoimage',
            'options' => array(),
        ),
    );
}
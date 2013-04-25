<?php

/*
Example setting:

  array(
    'id'        => 'thumbnail-container-background-color',                  // arbitrary selector for the setting in the form
    'target'    => '.vimeography-grid .vimeography-thumbnail-container', // target elements to affect, separated by commas
    'attribute' => 'color',
    'label'     => __('Thumbnail Container Background Color'),              // setting field label text
    'value'     => '#232323',                                               // target attribute value
    'type'      => 'colorpicker',                                           // vimeography setting type
    ),
*/

$settings        = array(
  array(
    'id'        => 'active-thumbnail-border-color',
    'target'    => '.vimeography-grid .vimeography-thumbnails .slides li.vimeography-grid-active-slide img',
    'attribute' => 'borderColor',
    'label'     => __('Active Thumbnail Border Color'),
    'value'     => '#0088CC',
    'type'      => 'colorpicker',
    ),
  array(
    'id'        => 'inactive-thumbnail-border-color',
    'target'    => '.vimeography-grid .vimeography-thumbnails .slides li img',
    'attribute' => 'borderColor',
    'label'     => __('Inactive Thumbnail Border Color'),
    'value'     => '#0088CC',
    'type'      => 'colorpicker',
    ),
  array(
    'id'        => 'prev-arrow-color',
    'target'    => '.vimeography-grid .vimeography-grid-direction-nav a.vimeography-grid-prev span',
    'attribute' => 'borderRightColor',
    'label'     => __('Previous Arrow Color'),
    'value'     => '#000000',
    'type'      => 'colorpicker',
    ),
  array(
    'id'        => 'next-arrow-color',
    'target'    => '.vimeography-grid .vimeography-grid-direction-nav a.vimeography-grid-next span',
    'attribute' => 'borderLeftColor',
    'label'     => __('Next Arrow Color'),
    'value'     => '#000000',
    'type'      => 'colorpicker',
    ),
  array(
    'id'        => 'loader-color',
    'target'    => '.vimeography-grid .vimeography-main .spinner div div',
    'attribute' => 'backgroundColor',
    'label'     => __('Loader Color - must type !important after'),
    'value'     => '#000000',
    'type'      => 'colorpicker',
    ),
);
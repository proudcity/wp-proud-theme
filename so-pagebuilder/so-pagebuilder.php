<?php

add_filter('siteorigin_panels_prebuilt_layouts', 'proud_prebuilt_layouts', 20, 2);


function proud_prebuilt_layouts($layouts)
{

  $files = [
    'action-layout-template',
    'quick-action',
  ];

  foreach ($files as $file) {
    $panels_data = json_decode(file_get_contents(__DIR__ . "/$file.json"), true);
    //      error_log(__DIR__ . "/$file.json");
    $layouts["$file-page"] = $panels_data;
  }

  return $layouts;
}

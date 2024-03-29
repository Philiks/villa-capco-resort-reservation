<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Snappy PDF / Image Configuration
    |--------------------------------------------------------------------------
    |
    | This option contains settings for PDF generation.
    |
    | Enabled:
    |    
    |    Whether to load PDF / Image generation.
    |
    | Binary:
    |    
    |    The file path of the wkhtmltopdf / wkhtmltoimage executable.
    |
    | Timout:
    |    
    |    The amount of time to wait (in seconds) before PDF / Image generation is stopped.
    |    Setting this to false disables the timeout (unlimited processing time).
    |
    | Options:
    |
    |    The wkhtmltopdf command options. These are passed directly to wkhtmltopdf.
    |    See https://wkhtmltopdf.org/usage/wkhtmltopdf.txt for all options.
    |
    | Env:
    |
    |    The environment variables to set while running the wkhtmltopdf process.
    |
    */
    
    'pdf' => [
        'enabled' => true,
        // Uncomment below if the OS is linux-based.
        // 'binary' => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        // Uncomment below if the OS is windows.
        // Note: Be sure to install the `wkhtmltopdf` from https://wkhtmltopdf.org/downloads.html.
        'binary' => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf"',
        'timeout' => false,
        'options' => ['enable-local-file-access' => true],
        'env'     => [],
    ],
    
    'image' => [
        'enabled' => true,
        // Uncomment below if the OS is linux-based.
        // 'binary' => base_path('vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64'),
        // Uncomment below if the OS is windows.
        // Note: Be sure to install the `wkhtmltopdf` from https://wkhtmltopdf.org/downloads.html.
        'binary' => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltoimage"',
        'timeout' => false,
        'options' => ['enable-local-file-access' => true],
        'env'     => [],
    ],

];

<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Ini
    |--------------------------------------------------------------------------
    |
    | Contains settings related to ini.
    |
    | settings: INI settings.
    |   
    |     Example: [upload_max_filesize => "10M"]
    |
    */

    # Upload Settings
    'file_uploads'                     => '', # "1"
    'post_max_size'                    => '', # "8M"
    'upload_max_filesize'              => '', # "2M"
    'upload_tmp_dir'                   => '', # NULL
    'max_input_nesting_level'          => '', # 64
    'max_input_vars'                   => '', # 1000
    'max_file_uploads'                 => '', # 20
    'max_input_time'                   => '', # "-1"
    'max_execution_time'               => '',  # "30"

    # Session Settings
    'session.save_path'                => '', # NULL
    'session.name'                     => '', # PHPSESSID
    'session.save_handler'             => '', # files
    'session.auto_start'               => '', # 0
    'session.gc_probability'           => '', # 1
    'session.gc_divisor'               => '', # 100
    'session.gc_maxlifetime'           => '', # 1440
    'session.serialize_handler'        => '', # php
    'session.use_strict_mode'          => '', # 0
    'session.use_cookies'              => '', # 1
    'session.referer_check'            => '', # NULL
    'session.entropy_file'             => '', # NULL
    'session.entropy_length'           => '', # 0
    'session.cache_limiter'            => '', # nocache
    'session.cache_expire'             => '', # 180
    'session.use_trans_sid'            => '', # 0
    'session.hash_function'            => '', # 0
    'session.hash_bits_per_character'  => '', # 4

    # Session Upload Progress Settings
    'session.upload_progress.enabled'  => '', # 1
    'session.upload_progress.cleanup'  => '', # 1
    'session.upload_progress.prefix'   => '', # upload_progress
    'session.upload_progress.name'     => '', # PHP_SESSION_UPLOAD_PROGRESS
    'session.upload_progress.freq'     => '', # 1%
    'session.upload_progress.min_freq' => '', # 1

    # Cookie Settings
    'session.cookie_lifetime'          => '', # 0
    'session.cookie_path'              => '', # /
    'session.cookie_domain'            => '', # NULL
    'session.cookie_secure'            => '', # NULL
    'session.cookie_httponly'          => ''  # NULL
];

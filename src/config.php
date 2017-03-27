<?php

include_once(__DIR__ . "/packages/log4php/Logger.php");

Logger::configure(array(
    'rootLogger' => array(
        'appenders' => array('default'),
    ),
    'appenders' => array(
        'default' => array(
            'class' => 'LoggerAppenderRollingFile',            
            'layout' => array(
                'class' => 'LoggerLayoutPattern',
                'params' => array(
                    'conversionPattern' => '%date{d.m.Y H:i:s} %-5level %msg<br/>%n')
            ),
            'params' => array(
                'file' => __DIR__ . '/log/log.html',
                'maxFileSize' => '1MB',
                'maxBackupIndex' => 5,
                'append' => true
            )
        )
    )
));

$logger = Logger::getLogger("default");

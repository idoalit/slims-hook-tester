<?php

/**
 * File: config.inc.php                                                        *
 * Project: hook-tester                                                        *
 * Created Date: Monday, April 14th 2025, 9:42:37 pm                           *
 * Author: Waris Agung Widodo <ido.alit@gmail.com>                             *
 * -----                                                                       *
 * Last Modified: Mon Apr 14 2025                                              *
 * Modified By: Waris Agung Widodo                                             *
 * -----                                                                       *
 * Copyright (c) 2025 Waris Agung Widodo                                       *
 * -----                                                                       *
 * HISTORY:                                                                    *
 * Date      	By	Comments                                                   *
 * ----------	---	---------------------------------------------------------  *
 */

use SLiMS\Plugins;

return [
    'log_file' => __DIR__ . '/../../files/test.log',
    'hooks' => [
        // Plugins::ADMIN_SESSION_AFTER_START,
        // Plugins::CONTENT_BEFORE_LOAD,
        // Plugins::CONTENT_AFTER_LOAD,
        // Plugins::BIBLIOGRAPHY_INIT,
        // Plugins::BIBLIOGRAPHY_BEFORE_UPDATE,
        Plugins::BIBLIOGRAPHY_AFTER_UPDATE,
        // Plugins::BIBLIOGRAPHY_BEFORE_SAVE,
        Plugins::BIBLIOGRAPHY_AFTER_SAVE,
        // Plugins::BIBLIOGRAPHY_BEFORE_DELETE,
        Plugins::BIBLIOGRAPHY_AFTER_DELETE,
        // Plugins::BIBLIOGRAPHY_CUSTOM_FIELD_DATA,
        // Plugins::BIBLIOGRAPHY_CUSTOM_FIELD_FORM,
        Plugins::CIRCULATION_AFTER_SUCCESSFUL_TRANSACTION,
        // Plugins::MEMBERSHIP_INIT,
        // Plugins::MEMBERSHIP_BEFORE_UPDATE,
        // Plugins::MEMBERSHIP_AFTER_UPDATE,
        // Plugins::MEMBERSHIP_BEFORE_SAVE,
        // Plugins::MEMBERSHIP_AFTER_SAVE,
        // Plugins::OVERDUE_NOTICE_INIT,
    ]
];

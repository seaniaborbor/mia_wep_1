<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'noreply@myapp.test';
    public string $fromName   = 'MIA - Database';
    public string $recipients = '';

    public string $userAgent = 'CodeIgniter';

    /**
     * Use SMTP for MailHog
     */
    public string $protocol = 'smtp';

    /**
     * Sendmail not used
     */
    public string $mailPath = '';

    /**
     * MailHog SMTP host
     */
    public string $SMTPHost = '127.0.0.1';

    /**
     * MailHog does NOT require auth
     */
    public string $SMTPUser = '';
    public string $SMTPPass = '';

    /**
     * MailHog SMTP port
     */
    public int $SMTPPort = 1025;

    /**
     * No encryption for MailHog
     */
    public string $SMTPCrypto = '';

    public int $SMTPTimeout = 30;
    public bool $SMTPKeepAlive = false;

    public bool $wordWrap = true;
    public int $wrapChars = 76;

    public string $mailType = 'html';
    public string $charset  = 'UTF-8';

    public bool $validate = false;
    public int $priority = 3;

    public string $CRLF = "\r\n";
    public string $newline = "\r\n";

    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;

    public bool $DSN = false;
}

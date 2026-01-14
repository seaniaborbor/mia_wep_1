<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'tarnuepb@gmail.com';  // Changed to your email
    public string $fromName   = 'MIA - Database';
    public string $recipients = '';

    public string $userAgent = 'CodeIgniter';

    /**
     * Use SMTP for Gmail
     */
    public string $protocol = 'smtp';

    /**
     * Sendmail not used
     */
    public string $mailPath = '';

    /**
     * Gmail SMTP host
     */
    public string $SMTPHost = 'smtp.gmail.com';  // Changed to Gmail SMTP

    /**
     * Gmail requires authentication with App Password
     */
    public string $SMTPUser = 'tarnuepb@gmail.com';  // Your email
    public string $SMTPPass = 'whenwtfbidgvsjbh';    // Your app password

    /**
     * Gmail SMTP port for TLS
     */
    public int $SMTPPort = 587;  // Changed to 587 for TLS

    /**
     * TLS encryption for Gmail
     */
    public string $SMTPCrypto = 'tls';  // Changed to TLS

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
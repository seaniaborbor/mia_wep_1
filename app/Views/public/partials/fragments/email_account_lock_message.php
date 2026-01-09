<h2>Account Locked – Action Required</h2>
<p>Dear <?= esc($user['userFullName']) ?>,</p>
<p>Your account has been locked due to multiple failed login attempts.</p>

<p><strong>Your secure unlock code:</strong></p>
<div style="font-size:24px; background:#f0f0f0; padding:15px; text-align:center; letter-spacing:3px; font-family:monospace;">
    <?= esc($activationCode) ?>
</div>

<p>Or unlock instantly by clicking below:</p>
<p>
    <a href="<?= esc($unlockLink) ?>" style="background:#0066cc; color:white; padding:12px 20px; text-decoration:none; border-radius:5px;">
        Unlock My Account Now
    </a>
</p>

<p>This code expires in 24 hours.</p>
<p>If you did not try to log in, contact the Head Office immediately.</p>

<hr>
<small>Ministry of Internal Affairs – Republic of Liberia</small>
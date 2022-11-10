<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1>Welcome !</h1>
                        <p>Thanks for trying <?= $store->title ?>.Your store is ready to use. To get the most out of <?= $store->title ?>, Go to your store admin portal.</p>
                        <!-- Action -->
                        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td align="center">
                                 
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                        <tr>
                                            <td align="center">
                                                <a href="<?= $store_portal ?>/admin" class="f-fallback button" target="_blank">Clcknshop Portal</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <p>For reference, here's your login information:</p>
                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="attributes_content">
                                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                    <strong>Store Url:</strong> <?= $store_portal ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                    <strong>Management Url:</strong> <?= $store_portal ?>/admin
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                    <strong>Username:</strong> <?= $email ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                    <strong>Password:</strong> <?= $password ?>
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <p>You've started a 30 day trial. You can upgrade to a paying account or cancel any time.</p>
                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="attributes_content">
                                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                    <strong>Trial Start Date:</strong> <?= date("d-M-y") ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                    <strong>Trial End Date:</strong> <?= date('d-M-y', strtotime('next month')) ?>
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <p>If you have any questions, feel free to <a href="mailto:clcknshop@infosoftbd.com">email our customer success team</a>. (We're lightning quick at replying.) We also offer Phone call/Whatsapp <a href="https://wa.me/<?= $store->phone ?>/?text=Hello"><?= $store->phone ?></a>
                            during business hours.</p>
                        <p>Thanks,
                            <br>Support and the Clcknshop Team
                        </p>
                        <p><strong>P.S.</strong> Need immediate help getting started? Check out our <a href="http://<?= $store->web ?>/docs">help documentation</a>. Or, just reply to this email, the [Product Name] support team is always ready to help!</p>
                        <!-- Sub copy -->
                        <table class="body-sub" role="presentation">
                            <tr>
                                <td>
                                    <p class="f-fallback sub">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
                                    <p class="f-fallback sub"><?= $store_portal ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>
        <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="content-cell" align="center">
                    <p class="f-fallback sub align-center">&copy; 2021 <?= $store->title ?>. All rights reserved.</p>
                    <p class="f-fallback sub align-center">
                        <?= $store->title ?>
                        <br><?= $store->address ?>
                        <br><?= $store->area ?>,<?= $store->city ?>
                        <br>Phone: <?= $store->phone ?>
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>
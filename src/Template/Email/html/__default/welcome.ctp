
<!-- Email Body -->
<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1>Welcome, <?= $customer->first_name . " " . $customer->last_name ?>!</h1>
                        <p>Thanks for trying <?= $store->title ?>. We’re thrilled to have you on board.</p>
                        <!-- Action -->
                        <p>For reference, here's your login information:</p>
                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="attributes_content">
                                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tr>
                                            <td class="attributes_item">
                                                      <span class="f-fallback">
                                                      <strong>Login Page:</strong> <?= $this->Url->build('login', true) ?>
                                                      </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="attributes_item">
                                                      <span class="f-fallback">
                                                      <strong>Username:</strong> <?= $customer->username ?>
                                                      </span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <p>If you have any questions, feel free to <a style="color: #15c;" href="mailto:{{support_email}}">email our customer success team</a>. (We're lightning quick at replying.) We also offer <a style="color: #15c;"  href="{{live_chat_url}}">live chat</a> during business hours.</p>

                        <p><strong>P.S.</strong> Need immediate help getting started? Check out our <a style="color: #15c;"  href="{{help_url}}">help documentation</a>. Or, just reply to this email, the <?= $store->title ?> support team is always ready to help!</p>
                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>

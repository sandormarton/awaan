<?php
/*
 * Copyright © 2016 DOTCOM Offshore, All Rights Reserved
 *
 * [This is the page ID ]
 * $id: login_modal.php
 * Created:        @wissamsabbagh    Apr 17, 2016 | 12:40:39 AM
 * Last Update:    @wissamsabbagh    Apr 17, 2016 | 12:40:39 AM
 */
?>
<div class="modal awaan-user-section-modal fade" id="feedbackModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="ion-close-round"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 feedback-wrapper">
                    <div class="site-logo">
                        <a href="#"><img src="<?=asset("images/logo.png")?>" alt="AWAAN" class="img-responsive center-block" /></a>
                    </div>
                    <div class="form-wrapper">
                        <form class="feedback-form" method="post">
                            <div class="form-group">
                                <label for="feed_email" style="display: none;">email</label>
                                <input id="feed_email" type="email" name="email" class="form-control" title="البريد الإلكتروني" placeholder="البريد الإلكتروني" />
                            </div>
                            <div class="form-group">
                                <label for="subject" style="display: none;">subject</label>
                                <textarea id="subject" title="subject" name="subject" class="form-control" placeholder=""></textarea>
                            </div>                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <button type="submit" class="btn btn-block btn-blue">إرسال</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
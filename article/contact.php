<?php include ('header.php'); ?>
<div class="content contact">
    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            CONTACT US
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="wrap-follow">
                        <h4 class="title">FOLLOW US</h4>
                        <ul>
                            <li>
                                <img src="assets/icon/fb.png" width="40px"> <a
                                    href="<?php getFollowNews('header', 'Facebook'); ?>" width="40px"> <a
                                        href="<?php getFollowNewsUrl('Facebook'); ?>">Facebook</a>
                            </li>
                            <li>
                                <img src="assets/icon/yt.png" width="40px"> <a
                                    href="<?php getFollowNews('header', 'Youtube'); ?>" width="40px"> <a
                                        href="<?php getFollowNewsUrl('Youtube'); ?>">Youtube</a>
                            </li>
                            <li>
                                <img src="assets/icon/ig.jfif" width="40px"> <a
                                    href="<?php getFollowNews('header', 'Instagram'); ?>" width="40px"> <a
                                        href="<?php getFollowNewsUrl('Instagram'); ?>">Instagram</a>
                            </li>
                            <li>
                                <img src="assets/icon/telegram.png" width="40px"> <a
                                    href="<?php getFollowNews('header', 'Telegram'); ?>" width="40px"> <a
                                        href="<?php getFollowNewsUrl('Telegram'); ?>">Telegram</a>
                            </li>
                            <li>
                                <img src="assets/icon/gmail-1.png" width="40px"> <a
                                    href="<?php getFollowNews('header', 'Email'); ?>" width="40px"> <a
                                        href="<?php getFollowNewsUrl('Email'); ?>">Email</a>
                            </li>
                            <li>
                                <img src="assets/icon/tiktok.png" width="40px"> <a
                                    href="<?php getFollowNews('header', 'TikTok'); ?>" width="40px"> <a
                                        href="<?php getFollowNewsUrl('TikTok'); ?>">Tok Tok</a>
                            </li>
                            <li>
                                <img src="assets/icon/phone.jpg" width="40px"> <a
                                    href="<?php getFollowNews('header', 'Phone'); ?>" width="40px"> <a
                                        href="<?php getFollowNewsUrl('Phone'); ?>">088 41 91 757</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-8">
                    <div class="wrap-contact">
                        <h4 class="title">FEEDBACK TO US</h4>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="label">Username</div>
                                    <input type="text" name="username" class="box" placeholder="Username" required>
                                </div>
                                <div class="col-6">
                                    <div class="label">Email</div>
                                    <input type="email" name="email" class="box" placeholder="Email" required>
                                </div>
                                <div class="col-6">
                                    <div class="label">Telephone</div>
                                    <input type="tel" name="telephone" class="box" placeholder="Telephone" required
                                        minlength="9" maxlength="10">
                                </div>
                                <div class="col-6">
                                    <div class="label">Address</div>
                                    <input type="text" name="address" class="box" placeholder="Address" required>
                                </div>
                                <div class="col-12">
                                    <div class="label">Message</div>
                                    <textarea cols="30" name="message" rows="10" placeholder="Message Here"
                                        required></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="wrap-btn">
                                        <button type="submit" name="btn_message"><i
                                                class="fab fa-telegram-plane"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include ('footer.php'); ?>
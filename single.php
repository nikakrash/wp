<?
require "parts/head.php";
?>

<?
require "parts/header.php";
?>


<section class="section-top section-top_inner-page section-top_inner-page_blog section_line_bottom">
    <div class="container">
        <div class="top-main top-main_blog-inner top-main_inner-page">
            <div class="top-main__text top-main__text_blog-inner top-main__text_inner-page top-main__text_inner">
                <h1 class="h1_inner-page h1_inner-page_blog"><?= get_the_title(); ?><span class="dott"></span></h1>
            </div>
            <div class="top-main__info-text top-main__info-text_blog-inner">
                <span class="blog-time top-main__time"><?= get_the_date(); ?></span>
                <span class="blog-view">
                    <span class="blog-item__ico ico ico-eye ico-eye_color_pink"></span>
                    <span><?= (get_post_meta($post->ID, 'views', true)) ? get_post_meta($post->ID, 'views', true) : "0"; ?></span>
                </span>
            </div>
        </div>
    </div>
</section>

<section class="section text">
    <div class="container">
        <div class="text-container">
            <?php
                the_post();
                the_content();
            ?>
        </div>
    </div>
</section>

    <div class="footer" id="contacts">
        <div class="content">
            <div class="footer__info">
                <div class="info__icon">
                    <img src="img/telephone.svg" class="info__icon_phone">
                    <div class="info__desc info__desc_phone">
                        <a href="tel:+798776598076">8 (987) 765-98076</a><br>
                        <a href="tel:+798776598076">8 (987) 765-98076</a>
                    </div>
                </div>
            </div>
            <div class="footer__info">
                <div class="info__icon">
                    <img src="img/mark.svg" class="info__icon_mark">
                    <div class="info__desc">
                        г. Москва,<br>ул. Будайский проезд,<br>д. 11
                    </div>
                </div>
            </div>
            <div class="footer__info">
                <div class="info__icon">
                    <img src="img/mail.svg" class="info__icon_phone">
                    <a href="mailto:" class="info__desc info__desc_mail">
                        @gidroisolation.ru
                    </a>
                </div>
            </div>
            <div class="footer__info">
                <div class="info__icon info__icon_arrow">
                    <a href="#header">
                        <img src="img/arrow_app.svg">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalWindow" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <form class="form">
                        <div class="form__caption">Оставьте контакты и мы вам перезвоним</div>
                        <div class="form__elem _horizont">
                            <label for="in2">Ваше имя:</label>
                            <input type="text" name="name" placeholder="Имя" class="formname" autocomplete="off" id="in2">
                        </div>
                        <div class="form__elem _horizont">
                            <label for="in4">Ваш телефон:</label>
                            <input type="text" name="phone" placeholder="+_ (___) ___-____" class="formphone" autocomplete="off" id="in4">
                        </div>
                        <div class="form__elem">
                            <label for="in3">Ваш Email:</label>
                            <input type="text" name="email" placeholder="Email" class="formemail" autocomplete="off" id="in3">
                        </div>
                        <div class="form__elem _horizont">
                            <button type="submit" class="button js-send button_modal">Заказать обратный звонок</button>
                        </div>
                        <div class="form__elem _horizont form__politic">
                            <span class="form__politic">Нажимая "Заказать обратный звонок", я принимаю </span><a href="/politics.docx">Пользовательское соглашение</a>
                        </div>
                        <input type="hidden" name="type" value="Обратный звонок">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade in" id="thanks" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="form__ok"></div>
                    <div class="form__caption">Заявка успешно отправлена!
                    </div>
                    <p>Пожалуйста, проверьте номер телефона, который вы указали: <br><span class="send-phone" style="font-weight: 700;"></span></p>
                    <p>Если номер неверный, пожалуйста, отправьте заявку повторно</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/jquery.maskedinput.min.js"></script>
    <script src="js/custom.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(function(){
            $('.header__menu_mobile').click(function(){
                $('.menu-mobile').toggleClass('visible');
            });
            $('.menu-mobile__closer').click(function(){
                $('.menu-mobile').toggleClass('visible');
            });
        });
    </script>
</body>
</html>
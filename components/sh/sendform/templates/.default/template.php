<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>

<form class="mainForm footer-form js-footer-form" action="/test/" method="POST">
    <?=bitrix_sessid_post()?>
    <div class="mainForm__wrap">
        <div class="mainForm__request">
            <h3 class="mainForm__title mainForm__title_small"><?=$arParams["FORM_TITLE"]?></h3>
            <div class="error_message">
                <?=(!empty($arResult["ERROR_MESSAGE"]["NAME"])? $arResult["ERROR_MESSAGE"]["NAME"]:'');?>
                <?=(!empty($arResult["ERROR_MESSAGE"]["CITY"])? $arResult["ERROR_MESSAGE"]["CITY"]:'');?>
                <?=(!empty($arResult["ERROR_MESSAGE"]["EMAIL"])? $arResult["ERROR_MESSAGE"]["EMAIL"]:'');?>
                <?=(!empty($arResult["ERROR_MESSAGE"]["PHONE"])? $arResult["ERROR_MESSAGE"]["PHONE"]:'');?>
                <?=(!empty($arResult["ERROR_MESSAGE"]["CONFIRM"])? $arResult["ERROR_MESSAGE"]["CONFIRM"]:'');?>
            </div>
            <input class="mainForm__input <?=(!empty($arResult["ERROR_MESSAGE"]["NAME"])?'error':'');?>" type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>" placeholder="<?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>">
            <input class="mainForm__input <?=(!empty($arResult["ERROR_MESSAGE"]["CITY"])?'error':'');?>" type="text" name="user_city" value="<?=$arResult["CITY"]?>" placeholder="<?=GetMessage("MFT_CITY")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("CITY", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>">
            <div class="mainForm__input-wrap">
                <input class="mainForm__input <?=(!empty($arResult["ERROR_MESSAGE"]["EMAIL"])?'error':'');?>" type="email" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>" placeholder="<?=GetMessage("MFT_EMAIL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>" >
                <input class="mainForm__input <?=(!empty($arResult["ERROR_MESSAGE"]["PHONE"])?'error':'');?>" type="tel" name="user_phone" value="<?=$arResult["AUTHOR_PHONE"]?>" placeholder="<?=GetMessage("MFT_PHONE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>">
            </div>
            <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
            <?if($arParams["USE_CAPTCHA"] == "Y"):?>
                <div class="mainForm__capcha">
                    <span><?=GetMessage("MFT_CAPTCHA_CODE")?></span>
                    <div class="mainForm__capcha-wrap">
                        <div class="captcha_image">
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"])?>" border="0" />
                            <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"])?>" />
                            <div class="captcha_reload"></div>
                        </div>
                        <div class="captcha_input">
                            <input type="text" class="inputtext captcha" name="captcha_word" size="30" maxlength="50" value="" required />
                        </div>
                    </div>
                </div>
            <?endif;?>

            <div class="mainForm__data">
                <div class="mainForm__checkbox">
                    <input class="mainForm__input-check" type="checkbox" name="conf" id="conf" checked>
                    <label class="mainForm__label-check" for="conf"></label>
                </div><span>Даю согласие на обработку <a href="https://bcslife.ru/upload/iblock/71c/71cd6c9d4203ba94c38a74184d6cf7be.pdf" target="_blank">персональных данных</a></span>
            </div>
        </div>
        <div class="mainForm__info-wrap">
            <div class="mainForm__info">
                <h2 class="mainForm__title">
                    <? $APPLICATION->IncludeFile("/include/priority/mainForm-title.php", [], ["MODE" => "html", "NAME" => "Текст "]); ?>
                </h2>
                <? $APPLICATION->IncludeFile("/include/priority/mainForm-text.php", [], ["MODE" => "html", "NAME" => "Текст "]); ?>
            </div>
            <div class="btn-wrap">
                <input class="main-btn main-btn_hover" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
                <!--<button class="main-btn main-btn_hover js-open-footer" type="button">Оформить заявку</button>-->
            </div>
        </div>
    </div>
</form>

<? if (strlen($arResult["OK_MESSAGE"]) > 0): ?>
    <div class="modal_landing modal_blue js-footer-modal">
        <div class="modal__wrap">
            <div class="modal__big-img"><img src="/local/templates/aspro-priority/images/landing/blue.svg" alt=""></div>
            <div class="modal__success-done"><span class="modal__close js-close-modal"></span>
                <div class="modal__success">
                    <h3 class="modal__succ-title"><?= $arResult["OK_MESSAGE"] ?></h3>
                </div>
                <div class="modal__info">
                    <h3>Благодарим за интерес к компании БКС Страхование жизни.</h3>
                    <p>В течение суток, с вами свяжется представитель нашей компании, чтобы подтвердить заявку и договориться о встрече для оформления страховки.</p>
                </div><span class="main-btn js-close-modal">Отлично!</span>
                <p class="modal__sub-info">По всем вопросам можно обращаться на номер 8 (800) 500-50-21 (звонок бесплатный)</p>
            </div>
        </div>
    </div>
    <script>
        var footerForm = document.querySelector('.js-footer-form');
        var modalFooter = document.querySelector('.js-footer-modal');

        $(modalFooter).addClass('active');
        $(footerForm).addClass('active');

        $('.js-close-modal').on('click', function () {
            $(modalFooter).removeClass('active');
            $(footerForm).removeClass('active');
        });


    </script>
<? endif; ?>

<script>
    BX.showWait = function(node, msg) {};
</script>
<script type="text/javascript" async="" src="<?= $templateFolder ?>/script.js"></script>

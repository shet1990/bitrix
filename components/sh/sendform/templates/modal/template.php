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
<div class="mask js-mask"></div>
<div class="modal_landing js-modal">
    <div class="modal__content">
        <span class="modal__close js-close"></span>
        <h2 class="modal__title"><?=$arParams["FORM_TITLE"]?></h2>
        <form class="mainForm" action="/test/" method="POST">
            <?=bitrix_sessid_post()?>
            <div class="error_message">
                <?=(!empty($arResult["ERROR_MESSAGE"]["NAME"])? $arResult["ERROR_MESSAGE"]["NAME"]:'');?>
                <?=(!empty($arResult["ERROR_MESSAGE"]["CITY"])? $arResult["ERROR_MESSAGE"]["CITY"]:'');?>
                <?=(!empty($arResult["ERROR_MESSAGE"]["EMAIL"])? $arResult["ERROR_MESSAGE"]["EMAIL"]:'');?>
                <?=(!empty($arResult["ERROR_MESSAGE"]["PHONE"])? $arResult["ERROR_MESSAGE"]["PHONE"]:'');?>
                <?=(!empty($arResult["ERROR_MESSAGE"]["CONFIRM"])? $arResult["ERROR_MESSAGE"]["CONFIRM"]:'');?>
            </div>
            <div class="mainForm__wrap">
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
                <input class="main-btn main-btn_hover" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
            </div>
        </form>
    </div>
</div>

<? if (strlen($arResult["OK_MESSAGE"]) > 0): ?>
    <div class="modal_landing js-thanks">
        <div class="modal__content">
            <span class="modal__close js-close"></span>
            <div class="modal__success">
                <div class="modal__succ-img"><img src="/local/templates/aspro-priority/images/landing/success.svg" alt=""></div>
                <h3 class="modal__succ-title"><?= $arResult["OK_MESSAGE"] ?></h3>
            </div>
            <div class="modal__info">
                <h3>Благодарим за интерес к компании БКС Страхование жизни.</h3>
                <p>В течение суток, с вами свяжется представитель нашей компании, чтобы подтвердить заявку и договориться о встрече для оформления страховки.</p>
            </div><span class="main-btn js-close">Отлично!</span>
            <p class="modal__sub-info">По всем вопросам можно обращаться на номер 8 (800) 500-50-21 (звонок бесплатный)</p>
        </div>
    </div>
    <script>
        $('.js-mask').addClass('active');
        $('header').css('position', 'relative');
        $('.js-thanks').addClass('active');

        $('.js-open-modal').on('click', function () {
            $('.js-modal').addClass('active');
            $('.js-mask').addClass('active');
            $('header').css('position', 'relative');
        });
        $('.js-close').on('click', function () {
            $('.js-modal').removeClass('active');
            $('.js-mask').removeClass('active');
            $('.js-thanks').removeClass('active');
            $('header').css('position', 'fixed');
        });
    </script>
<? endif; ?>

<script>
    BX.showWait = function(node, msg) {};
</script>
<script type="text/javascript" async="" src="<?= $templateFolder ?>/script.js"></script>

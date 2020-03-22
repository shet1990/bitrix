<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule("iblock");

$dbIBlockType = CIBlockType::GetList(
	array("sort" => "asc"),
	array("ACTIVE" => "Y")
);
while ($arIBlockType = $dbIBlockType->Fetch())
{
	if ($arIBlockTypeLang = CIBlockType::GetByIDLang($arIBlockType["ID"], LANGUAGE_ID))
		$arIblockType[$arIBlockType["ID"]] = "[".$arIBlockType["ID"]."] ".$arIBlockTypeLang["NAME"];
}


$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$eventName = "FEEDBACK_FORM";
if($arParams["EVENT_NAME"])
	$eventName = $arParams["EVENT_NAME"];

$arFilter = Array("TYPE_ID" => $arParams["EVENT_NAME"], "ACTIVE" => "Y");
if($site !== false)
	$arFilter["LID"] = $site;

$arEvent = Array();
$dbType = CEventMessage::GetList($by="ID", $order="DESC", $arFilter);
while($arType = $dbType->GetNext())
	$arEvent[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];

$arComponentParameters = array(
	"PARAMETERS" => array(
        "FORM_TITLE" => Array(
            "NAME" => GetMessage("MFP_FORM_TITLE"),
            "TYPE" => "STRING",
            "DEFAULT" => GetMessage("MFP_FORM_TITLE_DEFAULT"),
            "PARENT" => "BASE",
        ),
		"REQUIRED_FIELDS" => Array(
			"NAME" => GetMessage("MFP_REQUIRED_FIELDS"),
			"TYPE"=>"LIST",
			"MULTIPLE"=>"Y",
			"VALUES" => Array("NONE" => GetMessage("MFP_ALL_REQ"), "NAME" => GetMessage("MFP_NAME"), "EMAIL" => "Email", "PHONE" => GetMessage("MFP_PHONE"), "CITY" => GetMessage("MFP_CITY"),"CONFIRM" => GetMessage("MFP_CONFIRM"), "MESSAGE" => GetMessage("MFP_MESSAGE")),
			"DEFAULT"=>"",
            "SIZE"=>5,
			"PARENT" => "BASE",
		),
        "EMAIL_TO" => Array(
            "NAME" => GetMessage("MFP_EMAIL_TO"),
            "TYPE" => "STRING",
            "DEFAULT" => htmlspecialcharsbx(COption::GetOptionString("main", "email_from")),
            "PARENT" => "BASE",
        ),
        "FORM_SAVE" => Array(
            "NAME" => GetMessage("MFP_FORM_SAVE"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
            "PARENT" => "BASE",
        ),
        /*"FORM_IBLOCK_ID" => Array(
            "NAME" => GetMessage("MFP_FORM_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
            "DEFAULT"=>"",
			"VALUES" => $arIblockType,
            "PARENT" => "BASE",
        ),*/
		"FORM_IBLOCK_ID" => Array(
			"NAME" => GetMessage("MFP_FORM_IBLOCK"),
			"TYPE" => "NUMBER",
			"DEFAULT"=>"",
			"PARENT" => "BASE",
		),
		"EVENT_NAME" => Array(
			"NAME" => GetMessage("MFP_EVENT_NAME"),
			"TYPE" => "STRING",
			"PARENT" => "BASE",
			"REFRESH" => "Y"
		),
		"EVENT_MESSAGE_ID" => Array(
			"NAME" => GetMessage("MFP_EMAIL_TEMPLATES"),
			"TYPE"=>"LIST",
			"VALUES" => $arEvent,
			"DEFAULT"=>"",
			"MULTIPLE"=>"Y",
			"PARENT" => "BASE",
		),
        "OK_TEXT" => Array(
            "NAME" => GetMessage("MFP_OK_MESSAGE"),
            "TYPE" => "STRING",
            "DEFAULT" => GetMessage("MFP_OK_TEXT"),
            "PARENT" => "BASE",
        ),
        "USE_CAPTCHA" => Array(
            "NAME" => GetMessage("MFP_CAPTCHA"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
            "PARENT" => "BASE",
        ),

	)
);
?>

<?
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("CheckFieldsEvents", "OnBeforeIBlockElementUpdateHandler"));

class CheckFieldsEvents {
    
    function OnBeforeIBlockElementUpdateHandler(&$arFields) {

        $iblockProductsId = 2; // Указываем ID инфоблока "Продукция" здесь
        $iblockId = $arFields["IBLOCK_ID"];
        $elementId = $arFields["ID"];
        $isActive = $arFields["ACTIVE"];
        
        $resElement = CIBlockElement::GetByID($elementId);
        $arElement = $resElement->GetNext();
        $viewsCounter = intVal($arElement['SHOW_COUNTER']);

        if ($iblockId == $iblockProductsId && $isActive == "N" && $viewsCounter > 2) {
            global $APPLICATION;
            $APPLICATION->throwException("Товар невозможно деактивировать, у него " . $viewsCounter . " просмотров");
            return false;
        }
        
    }
    
}

?>
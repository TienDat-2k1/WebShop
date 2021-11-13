<?php
function isHaveInfor($id) {
        $guestWhereQuery = "SELECT * FROM guest WHERE guest.id = $id";
        $guestWhereData = executeSingleResult($guestWhereQuery);
        if ($guestWhereData != null) {
            return true;
        }
        return false;
    }
    ?>
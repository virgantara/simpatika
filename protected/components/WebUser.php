<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebUser
 *
 * @author andy
 */
class WebUser extends CWebUser {
    const R_SA = '1';
    const R_BAAK = '2';
    const R_PRODI = '3';
    const R_NILAI = '4';
    const R_ADM = '5';
    const R_AKPAM = '6';
    const R_TAHFIDZ = '7';

    /**
     * this method is used for checking user right access
     * @param <string> $operation
     * @param <array> $params
     * @return <boolean>
     */
    public function checkAccess($operation, $params=array(), $allowCaching = true) {
        /*if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }*/
        $role = $this->getState("level");

        
		if(is_array($operation)){
			return in_array($role,$operation);
		}
		else{
			return ($operation === $role);
		}
    }
}
?>

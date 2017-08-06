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

    /**
     * this method is used for checking user right access
     * @param <string> $operation
     * @param <array> $params
     * @return <boolean>
     */
    public function checkAccess($operation, $params=array()) {
        /*if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }*/
        $role = $this->getState("LEVEL");

        
		if(is_array($operation)){
			return in_array($role,$operation);
		}
		else{
			return ($operation === $role);
		}
    }
}
?>

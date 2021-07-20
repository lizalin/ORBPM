<?php
/* 
 * File Name         	: addSlInner.php.
 * Description		: This is used to add update secondary Link.
 * Devloped By          : T Ketaki Debadarshini
 * Devloped On		: 29-Aug-2015
 * Update History		  : <Updated by>		<Updated On>		<Remarks>
 * Class Used		: clsGlobalLink
 * Functions Used	: viewPLDetails(),saveMenuItems()
 */
        $objGl          = new clsGlobalLink; 
        $viewPl		= $objGl->viewPLDetails('VA',0);
        $linkType       = 'secondaryLink';
        $menuType 		= 1;
        if(isset($_POST['btnSaveMainMenu']))
        {
            /* For main menu */            
            $parentIds	= $_REQUEST['chkPLId'];
            foreach($parentIds as $plIds)
            {
                    $outMsg  = $objGl->saveMenuItems($plIds,$menuType,$linkType,$plIds);
            }			
          	
        } 

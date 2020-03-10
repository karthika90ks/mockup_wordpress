<?php

//List Items builder.
function abcfsl_cnt_list( $tplateOptns, $optns, $menu, $filters ){

    $pfix = $optns['pfix'];
    $grpID = $optns['grpID'];
    $grpType = $optns['grpType'];   
    $parentID = $optns['tplateID']; 

    $lstItemDefaultCls = $pfix . 'PadBMB30';

    $colL = isset( $tplateOptns['_lstCols'] ) ? esc_attr( $tplateOptns['_lstCols'][0] ) : '6';
    $colR = (12 - $colL);
    //$vAid = isset( $tplateOptns['_vAid'] ) ? esc_attr( $tplateOptns['_vAid'][0] ) : 'N';
    //$lstItemCustomCls = isset( $tplateOptns['_lstItemCls'] ) ? esc_attr( $tplateOptns['_lstItemCls'][0] ) : $lstItemDefaultCls;
    //$lstItemStyle = isset( $tplateOptns['_lstItemStyle'] ) ? esc_attr( $tplateOptns['_lstItemStyle'][0] ) : '';
    //$sPageUrl = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';
    $noDataMsgT = isset( $tplateOptns['_noDataMsg'] ) ? esc_attr( $tplateOptns['_noDataMsg'][0] ) : '';

    //== PG ==============================================
    $defaultParts = abcfsl_util_pg_cnt_parts_defaults( $noDataMsgT, $menu['noDataMsg'] );

    //Get staff members IDs. Used alawas, paginator or not.
    $out = abcfsl_paginator_post_ids( $optns, $menu, $filters );
    $totalQty = $out['totalQty'];
    if( $totalQty == 0 ) { return $defaultParts; }
    $postIDs = $out['postIDs'];
    //================================================
    $itemPar['pfix'] = $pfix;
    $itemPar['parentID'] = $parentID;
    $itemPar['grpID'] = $grpID;
    //$itemPar['vAid'] = isset( $tplateOptns['_vAid'] ) ? esc_attr( $tplateOptns['_vAid'][0] ) : 'N';
    $itemPar['vAid'] = 'N';
    $itemPar['lstItemCustomCls'] = isset( $tplateOptns['_lstItemCls'] ) ? esc_attr( $tplateOptns['_lstItemCls'][0] ) : $lstItemDefaultCls;
    $itemPar['lstItemStyle'] = isset( $tplateOptns['_lstItemStyle'] ) ? esc_attr( $tplateOptns['_lstItemStyle'][0] ) : '';
    $itemPar['sPageUrl'] = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';
    $itemPar['colL'] = $colL;
    $itemPar['colR'] = $colR;    
    //================================================

    $itemsHTML  = '';
    $itemsSD  = array(); //SDATA

    if ( $grpID > 0 ) {              
        $groupsData = abcfsl_cnt_groups_all_groups_all_parts( 'L', $grpType, $postIDs, $tplateOptns, $itemPar, '', '' );
        $itemsHTML = $groupsData['itemsHTML'];
        $itemsSD = $groupsData['sdProperties']; //SDATA                  
    }
    else{     
        $gridData = abcfsl_cnt_list_all_parts( $postIDs, $tplateOptns, $itemPar );
        $itemsHTML = $gridData['itemsHTML'];
        $itemsSD = $gridData['sdProperties']; 
    }

    $outParts = abcfsl_util_pg_cnt_parts( $tplateOptns, $totalQty, $optns['pageNo'], $itemsHTML, $itemsSD, $pfix, $optns['ajax'], $optns['top'] );
    return $outParts;
}

//List. No groups. HTML + SD structured data. 
function abcfsl_cnt_list_all_parts( $postIDs, $tplateOptns, $itemPar ){    

    $out['itemsHTML'] = '';
    $out['sdProperties'] = array();
    $itemsHTML = '';
    $sdProperties  = array();

    foreach ( $postIDs as $itemID ) {
        $outItems = abcfsl_cnt_list_item_cntr( $itemID, $postIDs, $tplateOptns, $itemPar );
        $itemsHTML .= $outItems['itemCntr'];
        $sdProperties[] = $outItems['sdProperties']; //SDATA
    }    

    $out['itemsHTML'] = $itemsHTML;
    $out['sdProperties'] =  $sdProperties;

    return $out;
}

//-- LIST ITEM ---------------------------------------------
//List Item container: image left, text right.
function abcfsl_cnt_list_item_cntr( $itemID, $postIDs, $tplateOptns, $itemPar ){  
    
    $pfix = $itemPar['pfix'];
    $vAid = $itemPar['vAid'];
    $lstItemCustomCls = $itemPar['lstItemCustomCls'];
    $lstItemStyle = $itemPar['lstItemStyle'];

    $vAidCls = '';
    $vAidClsImgCntr = '';
    if( $vAid == 'Y' ) {
        $vAidCls = ' ' . $pfix . 'VAidBorder';
        $vAidClsImgCntr = ' ' . $pfix . 'VAidBorderR';
    }

    $div = abcfsl_cnt_list_item_cntr_div( $lstItemCustomCls . $vAidCls, $lstItemStyle, $pfix );
    $itemOptns = get_post_custom( $itemID );

    $par['pgLayout'] = 1;
    $par['itemID'] = $itemID;
    $par['colL'] = $itemPar['colL'];
    $par['colR'] = $itemPar['colR'];
    $par['clsPfix'] = $pfix;
    $par['vAidCls'] = $vAidClsImgCntr;
    $par['sPageUrl'] = $itemPar['sPageUrl'];
    $par['isSingle'] = false;
    $par['vAid'] = $vAid;
    $par['center'] = 'Center575';
    $par['txtCntrCls'] = 'TxtCntrLst';
    $par['colWrapBaseCls'] = 'TxtColLst';
    $par['custCls'] = '';

    $imgCntr = abcfsl_cnt_img_cntr( $tplateOptns, $itemOptns, $par );
    $txtSection = abcfsl_cnt_txt_cntr( $tplateOptns, $itemOptns, $par );

    //SDATA
    $out['itemCntr'] = $div['itemCntrS'] . $imgCntr . $txtSection . $div['itemCntrE'];
    $out['sdProperties'] = abcfsl_struct_data_item_grid( $tplateOptns, $itemOptns, $itemID );

    return $out;
}

function abcfsl_cnt_list_item_cntr_div( $customCls, $lstItemStyle, $pfix ){

    $itemCls = '';
    if(!empty($customCls)){ $customCls = ' ' . $customCls; }

    //Item container DIV
    $div['itemCntrS'] = abcfl_html_tag( 'div', '', $pfix . 'ItemCntrLst' . $customCls . ' abcfClrFix' . $itemCls, $lstItemStyle );
    $div['itemCntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

//=========================================================
//== LIST - GROUPS - START ==============================
//Grid B - CAT. ALL groups. Header + HTML + SD.
function abcfsl_cnt_list_all_groups_all_parts_cat( $postIDs, $tplateOptns, $itemPar ){

    $grpID = $itemPar['grpID'];
    $outGroup = array();
    $itemsHTML = '';
    $sdProperties  = array();
    $groupSDProperties = array();

    $groupsData['itemsHTML'] = '';
    $groupsData['itemsSD'] = array();

    //-----------------------------  
    $groupsData = abcfsl_cnt_groups_data_categories( $postIDs, $grpID );
    //Slug > Category name pairs. Included only saved slugs. [faculty] => Faculty
    $slugNamePairs = $groupsData['slugNamePairs'];
    //Staff IDs grouped by slugs. Includes none group.
    $groupedIDs = $groupsData['groupedIDs'];
    //-----------------------------    

    //Slug > Category name pairs. Included only saved slugs. [faculty] => Faculty
    foreach ( $slugNamePairs as $slug => $grpName  ) {

        if (array_key_exists( $slug, $groupedIDs ))  { 
                $groupIDs = $groupedIDs[$slug];
                $outGroup = abcfsl_cnt_list_single_group_all_parts( $groupIDs, $grpName, $tplateOptns, $itemPar );
                $itemsHTML .= $outGroup['itemsHTML'];
            
                $groupSDProperties = $outGroup['groupSDProperties'];
                foreach ($groupSDProperties as $value) {
                    $sdProperties[] = $value;
                    //$itemsSD[] = $value;
                } 
        } 
    }

    $groupsData['itemsHTML'] = $itemsHTML;
    $groupsData['sdProperties'] = $sdProperties;

    return $groupsData;
}

//LIST - TXT. ALL groups. Header + HTML + SD.
function abcfsl_cnt_list_all_groups_all_parts_txt( $grpType, $postIDs, $tplateOptns, $itemPar ){

    $parentID = $itemPar['parentID'];
    $grpID = $itemPar['grpID'];

    $outGroup = array();
    $itemsHTML = '';
    $sdProperties  = array();
    $groupSDProperties = array();

    $groupsData['itemsHTML'] = '';
    $groupsData['itemsSD'] = array();

    //-----------------------------  
    $groupsData = abcfsl_cnt_groups_data_txt( $grpType, $postIDs, $grpID, $parentID, $tplateOptns, $itemPar );
    //Slug > Category name pairs. Included only saved slugs. [faculty] => Faculty
    $grpNames = $groupsData['grpNames'];
    //Staff IDs grouped by slugs. Includes none group.
    $groupedIDs = $groupsData['groupedIDs'];
    //-----------------------------  
    
    //Slug > Category name pairs. Included only saved slugs. [faculty] => Faculty
    foreach ( $grpNames as $grpName  ) {        

        if ( array_key_exists( $grpName, $groupedIDs ) )  { 
                $groupIDs = $groupedIDs[$grpName];
                $outGroup = abcfsl_cnt_list_single_group_all_parts( $groupIDs, $grpName, $tplateOptns, $itemPar );
                $itemsHTML .= $outGroup['itemsHTML'];
            
                $groupSDProperties = $outGroup['groupSDProperties'];
                foreach ($groupSDProperties as $value) {
                    $sdProperties[] = $value;
                    //$itemsSD[] = $value;
                } 
        } 
    }

    $groupsData['itemsHTML'] = $itemsHTML;
    $groupsData['sdProperties'] = $sdProperties;

    return $groupsData;    
}

//LIST. Single group. Header + HTML + SD.                 
function abcfsl_cnt_list_single_group_all_parts( $groupIDs, $grpName, $tplateOptns, $itemPar ){

    $itemsHTML = '';
    $itemsSD  = array(); //SDATA
    $outGroup = [];
    $outItem = '';
    $grpID = $itemPar['grpID'];
    $pfix = $itemPar['pfix'];
    //Group container
    $grpCntrS = abcfl_html_tag( 'div', '', $pfix . 'GrpCntr', '' );

    //[0] => 6371
    foreach ( $groupIDs as $itemID ) {
        $out = abcfsl_cnt_list_item_cntr( $itemID, $groupIDs, $tplateOptns, $itemPar );
        $itemsHTML .= $out['itemCntr'];
        $itemsSD[] = $out['sdProperties']; //SDATA
    }

    //Group container
    $itemsHTML = $grpCntrS . $itemsHTML . abcfl_html_tag_end( 'div');
    $grpHeader = abcfsl_cnt_groups_grp_header( $grpID, $grpName, $pfix );

    $outGroup['itemsHTML'] = $grpHeader . $itemsHTML;    
    //Array of sdProperties.
    $outGroup['groupSDProperties'] = $itemsSD;

    return $outGroup;
}
//== LIST - GROUPS - END ========================================
//===============================================================

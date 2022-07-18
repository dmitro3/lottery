<?php
namespace App\Commissions;
use App\Models\{
    CommissionTree
};
class Tree
{
    public static function addNode($userRefId,$user)
    {
        $oldTreeNode = CommissionTree::getExactlyNode($userRefId,$user->id);
        if (isset($oldTreeNode)) return false;
    	$treeParent = CommissionTree::getTreeNode($userRefId);
    	$listParentId = [];
    	$level = 1;
    	if (isset($treeParent)) {
    		$listParentId = explode(',',$treeParent->list_parent);
    		if (!in_array($userRefId,$listParentId)) {
    			array_push($listParentId,$userRefId);
    		}
    		if (!in_array($treeParent->user_introduce_id,$listParentId)) {
    			array_push($listParentId,$treeParent->user_introduce_id);
    		}
    		$level = $treeParent->level + 1;
    	}else {
    		array_push($listParentId,$userRefId);
    	}
    	sort($listParentId);
    	$strParentId = implode(',',$listParentId);
    	$strParentId = trim($strParentId,',');
        $affiliateTree = new CommissionTree;
        $affiliateTree->user_introduce_id= $userRefId;
        $affiliateTree->user_id= $user->id;
        $affiliateTree->level 	= $level;
        $affiliateTree->list_parent = $strParentId;
    	$affiliateTree->save();
		return true;
    }
	public static function getListParentNode($userId,$maxLevelGet){
		$treeNode = CommissionTree::getTreeNode($userId);
		if (!isset($treeNode)) {
			return [];
		}
		$listUserParentId = explode(',',$treeNode->list_parent);
		$listParents = CommissionTree::whereIn('user_id',$listUserParentId)
									->whereHas('user')
									->with('user')
									->where('level','>=',$treeNode->level - $maxLevelGet)
									->get();
		$ret = [];
		foreach ($listParents as $itemParent) {
			$dataAdd = [];
			$dataAdd['user'] = $itemParent->user;
			$dataAdd['level_deviant'] = $treeNode->level - $itemParent->level;
			array_push($ret,$dataAdd);
		}
		return $ret;
	}
}

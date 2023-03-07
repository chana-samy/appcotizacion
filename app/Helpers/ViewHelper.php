<?php
namespace App\Helpers;

use Session;

class ViewHelper
{
	public static function renderPagination($urlPage, $quantityPage, $currentPage, $searchParameter)
	{
		$searchParameter=($searchParameter!='' && $searchParameter!=null) ? '&'.$searchParameter : '';

		$paginationSection=''
			.'<div class="divPagination">'
				.'<span><a class="divPaginationJump" onclick="_globalFunction.clickLink(\''.$urlPage.'?page='.(($currentPage-1)<=0 ? 1 : ($currentPage-1)).$searchParameter.'\');"></a></span>'
				.'<a onclick="_globalFunction.clickLink(\''.$urlPage.'?page=1'.$searchParameter.'\');" class="divPaginationPageNumber" '.(1==$currentPage ? 'style="background-color: #6195ce;color: #ffffff;"' : '').'>1</a>';
		if($currentPage-2>1)
		{
			$paginationSection.='..';
		}
		
		for($i=($currentPage-2<=1 ? 2 : $currentPage-2); $i<=($quantityPage<($currentPage+2) ? $quantityPage : $currentPage+2); $i++)
		{
			$paginationSection.='<a onclick="_globalFunction.clickLink(\''.$urlPage.'?page='.$i.$searchParameter.'\');" class="divPaginationPageNumber" '.($i==$currentPage ? 'style="background-color: #6195ce;color: #ffffff;"' : '').'>'.$i.'</a>';
		}
		if($quantityPage>($currentPage+2))
		{
			$paginationSection.='..'
				.'<a onclick="_globalFunction.clickLink(\''.$urlPage.'?page='.$quantityPage.$searchParameter.'\');" class="divPaginationPageNumber" '.($quantityPage==$currentPage ? 'style="background-color: #6195ce;color: #ffffff;"' : '').'>'.$quantityPage.'</a>';
		}
		
		$paginationSection.='<span><a class="divPaginationJump" onclick="_globalFunction.clickLink(\''.$urlPage.'?page='.(($currentPage+1)>$quantityPage ? $quantityPage : ($currentPage+1)).$searchParameter.'\');"></a></span>'
			.'</div>';

		return $paginationSection;
	}
}
?>
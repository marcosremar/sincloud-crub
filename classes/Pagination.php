<?php
/**
 * Class Pagination
 */

class Pagination{
    private $total;
    private $itemsPerPage;
    private $currentPage;
    private $amountVisiblePages;
    private $_params;
    public function setParams($params)
    {
        $this->_params = $params;
    }
    private function _getNoLink()
    {
        return 'javascript:void(0);';
    }
    public function setAmountVisiblePages($amountVisiblePages)
    {
        $this->amountVisiblePages = $amountVisiblePages;
    }
    public function getAmountVisiblePage()
    {
        return $this->amountVisiblePages;
    }
    public function setTotal($total)
    {
        $this->total = $total;
    }
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;
    }
    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
    }
    public function getNumberPages()
    {
        return ceil($this->total / $this->itemsPerPage);
    }
    public function getCurrentPage()
    {
        return isset($this->_params['page']) ? $this->_params['page'] : 1;
    }
    public function getOffset()
    {
        return ($this->getCurrentPage() == 1) ? 0 : ($this->getCurrentPage()-1) * $this->itemsPerPage;
    }
    public function getLinkByPage($page){
        return $this->_getUrlParam(['page'], ['page'=>$page]);
    }
    public function isPreviousEnabled()
    {
        return ($this->getCurrentPage() > 1);
    }
    public function getPreviousLink()
    {
        if($this->getCurrentPage() > 1)
            return $this->_getUrlParam(['page'], ['page' => intval($this->currentPage)-1]);
        return $this->_getNoLink();
    }
    public function isFirstEnabled()
    {
        return ($this->getCurrentPage() > 1);
    }
    public function getFirstLink()
    {
        if($this->getCurrentPage() > 1)
            return $this->_getUrlParam(['page'], ['page'=>1]);
        return $this->_getNoLink();
    }
    public function getNextLink()
    {
        if($this->getNumberPages() > $this->getCurrentPage())
            return $this->_getUrlParam(['page'], ['page'=>$this->getCurrentPage() + 1]);
        return $this->_getNoLink();
    }
    public function getLastLink()
    {
        if($this->getNumberPages() > $this->getCurrentPage())
            return $this->_getUrlParam(['page'], ['page'=>$this->getNumberPages()]);
        return $this->_getNoLink();
    }
    public function isNextEnabled()
    {
        return $this->getCurrentPage() < $this->getNumberPages();
    }
    public function isLastEnabled()
    {
        return $this->getCurrentPage() < $this->getNumberPages();
    }
    private function _getInitPage()
    {
        $half = floor($this->getAmountVisiblePage()/2);
        if(($this->getCurrentPage()-$half) < 1)
            return 1;
        return $this->getCurrentPage()-$half;
    }
    private function _getEndPage()
    {
        if($this->_getInitPage() + $this->amountVisiblePages < $this->getNumberPages())
            return $this->_getInitPage() + $this->amountVisiblePages;

        return $this->getNumberPages() + 1;
    }
    public function fetchAllVisiblePages()
    {
        $visiblePages = [];
        for($i = $this->_getInitPage(); $i < $this->_getEndPage(); $i++)
            $visiblePages[] = $i;

        return $visiblePages;
    }
    private function _getUrlParam($excludeArr, $addArr)
    {
//        $tmp_params = $this->_params;
//        foreach($excludeArr as $item)
//            unset($tmp_params[$item]);
//        $get_params = array_merge($tmp_params, $addArr);
//        $get_params_str = '';
//        foreach($get_params as $key=>$val)
//            if(!empty($val))
//                $get_params_str .= '&'.$key.'='.$val;
//
//        return '?'.substr($get_params_str, 1);
        return '?'.getToUrlParam($excludeArr, $addArr);
    }
    public function getOrderByLink($field)
    {
        $orderByValue = isset($this->_params['order_by']) && $this->_params['order_by'] == $field ? $field.' DESC' : $field;
        return $this->_getUrlParam(['order_by'], ['order_by' => $orderByValue]);
    }

    /**
     * -1 column isn't selected
     * 1 column is selected in asc
     * 2 column is selected in desc
     *
     * @param $field
     * @return int
     */
    public function isOrderActiveBy($field)
    {
        if(!isset($this->_params['order_by']) || $field != str_replace(' DESC', '', $this->_params['order_by']))
            return -1;

        return ($this->_params['order_by'] == $field) ? 1 : 2;
    }
}
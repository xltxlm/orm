<?php

namespace xltxlm\orm;

/**
 * 分页类，根据参数，计算出分页结构
 * Class page.
 */
final class PageObject
{
    /** @var int 显示的最小分页条数目 */
    private $min = 1;
    /** @var int 显示的最大分页条数目 */
    private $max = 1;

    /** @var int 数据条目开始的偏移量 */
    protected $from = 0;

    /** @var int 传递过来指明当前第几页 */
    protected $pageID = 1;
    /** @var int 每页显示多少条 */
    protected $prepage = 10;
    /** @var int 一共可分多少页 */
    private $pages = 1;

    /** @var int 一共有多少条数据 */
    protected $total = 0;
    /** @var string 追加的SQL */
    private $limitSql = '';

    /**
     * 当前条数从第几条开始算起.
     *
     * @return int
     */
    public function getFrom()
    {
        return $this->from = ($this->pageID - 1) * $this->prepage;
    }

    /**
     * @return mixed
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return mixed
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return int
     */
    public function getPageID(): int
    {
        return $this->pageID;
    }

    /**
     * @param float $pageID
     *
     * @return PageObject
     */
    public function setPageID(float $pageID): PageObject
    {
        $this->pageID = $pageID;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentpage(): int
    {
        return $this->pageID;
    }

    /**
     * @return int
     */
    public function getPrepage(): int
    {
        return $this->prepage;
    }

    /**
     * @param int $prepage
     *
     * @return PageObject
     */
    public function setPrepage(int $prepage): PageObject
    {
        $this->prepage = $prepage;

        return $this;
    }

    /**
     * @return int
     */
    public function getPages(): int
    {
        return $this->pages;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     *
     * @return PageObject
     */
    public function setTotal(int $total): PageObject
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return string
     */
    public function getgetFrom(): string
    {
        return $this->limitSql;
    }

    /**
     * @param string $sql
     *
     * @return PageObject
     */
    private function setLimitSql(string $sql): PageObject
    {
        $this->limitSql = $sql;

        return $this;
    }

    /**
     * @desc   分页计算
     *
     *
     * @return $this
     */
    public function __invoke()
    {
        $total = intval($this->total);
        $this->pages = (int)max(1, abs(ceil(($total / $this->prepage))));
        $this->pageID = (int)min(max($this->pageID, 1), $this->pages); //2
        $pageadd = 5;
        //每次最多显示多少页目
        $num = ceil($pageadd / 2);
        $this->max = min(max($this->pageID + $num, $pageadd), $this->pages);
        $this->min = max(min($this->pageID - $num, $this->pages - $pageadd), 1);

        $this->setLimitSql(' LIMIT '.$this->getFrom().", $this->prepage ");

        return $this;
    }
}

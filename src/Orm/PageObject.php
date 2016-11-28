<?php

namespace Orm;

/**
 * out:分页类
 * Class page.
 */
final class PageObject
{
    protected $min;
    protected $max;

    /** @var int 传递过来指明当前第几页 */
    protected $pageID;
    /** @var double 每页显示多少条 */
    protected $prepage = 10;
    /** @var double 一共可分多少页 */
    protected $pages;
    /** @var int 一共有多少条数据 */
    protected $total;
    /** @var string 追加的SQL */
    protected $limitSql = '';
    /** @var object[] 数据 */
    protected $data = [];

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param object[] $data
     *
     * @return PageObject
     */
    public function setData(array $data): PageObject
    {
        $this->data = $data;

        return $this;
    }

    /**
     * 当前条数从第几条开始算起.
     *
     * @return int
     */
    public function shiftNum()
    {
        return ($this->pageID - 1) * $this->prepage;
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
     * @param int $pageID
     *
     * @return PageObject
     */
    public function setPageID(int $pageID): PageObject
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
    public function getLimitSql(): string
    {
        return $this->limitSql;
    }

    /**
     * @param string $sql
     *
     * @return PageObject
     */
    private function setSql(string $sql): PageObject
    {
        $this->limitSql = $sql;

        return $this;
    }

    /**
     * @desc   分页计算
     *
     * @author 夏琳泰 mailto:xialintai@qiyi.com
     *
     * @since  2012-04-02 09:58:12
     *
     * @return $this
     */
    public function __invoke()
    {
        $total = intval($this->total);
        $this->pages = max(1, abs(ceil(($total / $this->prepage))));
        $this->pageID = min(max((int) $this->pageID, 1), $this->pages); //2
        $pageadd = 5;
        //每次最多显示多少页目
        $num = ceil($pageadd / 2);
        $this->max = min(max($this->pageID + $num, $pageadd), $this->pages);
        $this->min = max(min($this->pageID - $num, $this->pages - $pageadd), 1);

        $num_1 = ($this->pageID - 1) * $this->prepage;
        $this->setSql(" LIMIT $num_1, $this->prepage ");

        return $this;
    }
}
